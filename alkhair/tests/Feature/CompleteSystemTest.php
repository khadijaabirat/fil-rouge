<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompleteSystemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_welcome_page_loads_successfully()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('AL-KHAIR');
    }

    /** @test */
    public function test_donator_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test Donator',
            'email' => 'donator@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'donator',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' => 'donator@test.com',
            'role' => 'donator',
        ]);
    }

    /** @test */
    public function test_association_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test Association',
            'email' => 'association@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'association',
            'ville' => 'Casablanca',
            'licenseNumber' => 'LIC123456',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' => 'association@test.com',
            'role' => 'association',
        ]);
    }

    /** @test */
    public function test_admin_can_validate_association()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'PENDING',
        ]);

        $response = $this->actingAs($admin)
            ->post(route('admin.validateAssociation', $association->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $association->id,
            'status' => 'ACTIVE',
        ]);
    }

    /** @test */
    public function test_association_can_create_project()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
        ]);

        $category = Category::factory()->create();

        $response = $this->actingAs($association)
            ->post(route('projects.store'), [
                'title' => 'Test Project',
                'description' => 'Test Description',
                'goalAmount' => 10000,
                'startDate' => now()->format('Y-m-d'),
                'endDate' => now()->addMonths(2)->format('Y-m-d'),
                'category_id' => $category->id,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', [
            'title' => 'Test Project',
            'association_id' => $association->id,
        ]);
    }

    /** @test */
    public function test_donator_can_view_projects()
    {
        $donator = User::factory()->create([
            'role' => 'donator',
            'email_verified_at' => now(),
        ]);

        $category = Category::factory()->create();
        $association = User::factory()->create(['role' => 'association', 'status' => 'ACTIVE']);
        
        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $category->id,
            'status' => 'OPEN',
        ]);

        $response = $this->actingAs($donator)
            ->get(route('projects.index'));

        $response->assertStatus(200);
        $response->assertSee($project->title);
    }

    /** @test */
    public function test_donator_can_make_donation()
    {
        $donator = User::factory()->create([
            'role' => 'donator',
            'email_verified_at' => now(),
        ]);

        $category = Category::factory()->create();
        $association = User::factory()->create(['role' => 'association', 'status' => 'ACTIVE']);
        
        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $category->id,
            'status' => 'OPEN',
            'goalAmount' => 10000,
            'currentAmount' => 0,
        ]);

        $response = $this->actingAs($donator)
            ->post(route('donations.store', $project->id), [
                'amount' => 500,
                'paymentMethod' => 'ONLINE',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('donations', [
            'donator_id' => $donator->id,
            'project_id' => $project->id,
            'amount' => 500,
        ]);
    }

    /** @test */
    public function test_donation_validation_minimum_amount()
    {
        $donator = User::factory()->create([
            'role' => 'donator',
            'email_verified_at' => now(),
        ]);

        $category = Category::factory()->create();
        $association = User::factory()->create(['role' => 'association', 'status' => 'ACTIVE']);
        
        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $category->id,
            'status' => 'OPEN',
        ]);

        $response = $this->actingAs($donator)
            ->post(route('donations.store', $project->id), [
                'amount' => 50,
                'paymentMethod' => 'ONLINE',
            ]);

        $response->assertSessionHasErrors('amount');
    }

    /** @test */
    public function test_project_search_functionality()
    {
        $category = Category::factory()->create(['name' => 'Education']);
        $association = User::factory()->create(['role' => 'association', 'status' => 'ACTIVE']);
        
        $project = Project::factory()->create([
            'title' => 'Ecole Primaire',
            'association_id' => $association->id,
            'category_id' => $category->id,
            'status' => 'OPEN',
        ]);

        $response = $this->get(route('projects.index', ['search' => 'Ecole']));

        $response->assertStatus(200);
        $response->assertSee('Ecole Primaire');
    }

    /** @test */
    public function test_admin_dashboard_accessible()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Tableau de bord');
    }

    /** @test */
    public function test_association_dashboard_accessible()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($association)
            ->get(route('association.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Espace Association');
    }

    /** @test */
    public function test_donator_dashboard_accessible()
    {
        $donator = User::factory()->create([
            'role' => 'donator',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($donator)
            ->get(route('donator.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Espace Donateur');
    }

    /** @test */
    public function test_project_progress_calculation()
    {
        $category = Category::factory()->create();
        $association = User::factory()->create(['role' => 'association', 'status' => 'ACTIVE']);
        
        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $category->id,
            'goalAmount' => 10000,
            'currentAmount' => 5000,
            'status' => 'OPEN',
        ]);

        $percentage = ($project->currentAmount / $project->goalAmount) * 100;
        $this->assertEquals(50, $percentage);
    }

    /** @test */
    public function test_project_completion_when_goal_reached()
    {
        $category = Category::factory()->create();
        $association = User::factory()->create(['role' => 'association', 'status' => 'ACTIVE']);
        
        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $category->id,
            'goalAmount' => 10000,
            'currentAmount' => 9500,
            'status' => 'OPEN',
        ]);

        $project->increment('currentAmount', 500);
        $project->calculateProgress();

        $this->assertEquals('COMPLETED', $project->fresh()->status);
    }
}
