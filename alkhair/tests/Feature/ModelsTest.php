<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Donation;
use App\Models\Category;
use App\Models\ImpactReport;
use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelsTest extends TestCase
{
    use RefreshDatabase;

    protected $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->category = Category::factory()->create();
    }

    // User Model Tests
    public function test_user_has_projects_relationship()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id
        ]);

        $this->assertInstanceOf(Project::class, $association->projects->first());
        $this->assertEquals($project->id, $association->projects->first()->id);
    }

    public function test_user_has_category_relationship()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $this->assertInstanceOf(Category::class, $association->category);
        $this->assertEquals($this->category->id, $association->category->id);
    }

    public function test_user_has_donations_relationship()
    {
        $donator = User::factory()->create(['role' => 'donator']);
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id
        ]);

        $donation = Donation::factory()->create([
            'donator_id' => $donator->id,
            'project_id' => $project->id
        ]);

        $this->assertInstanceOf(Donation::class, $donator->donations->first());
    }

    public function test_user_is_admin_method()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $donator = User::factory()->create(['role' => 'donator']);

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($donator->isAdmin());
    }

    public function test_user_is_association_method()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);
        $donator = User::factory()->create(['role' => 'donator']);

        $this->assertTrue($association->isAssociation());
        $this->assertFalse($donator->isAssociation());
    }

    public function test_user_is_donator_method()
    {
        $donator = User::factory()->create(['role' => 'donator']);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->assertTrue($donator->isDonator());
        $this->assertFalse($admin->isDonator());
    }

    public function test_user_get_redirect_route_for_admin()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $route = $admin->getRedirectRoute();

        $this->assertEquals(route('admin.dashboard', absolute: false), $route);
    }

    public function test_user_get_redirect_route_for_active_association()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $route = $association->getRedirectRoute();

        $this->assertEquals(route('association.dashboard', absolute: false), $route);
    }

    public function test_user_get_redirect_route_for_pending_association()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'PENDING',
            'category_id' => $this->category->id
        ]);

        $route = $association->getRedirectRoute();

        $this->assertEquals(route('home', absolute: false), $route);
    }

    public function test_user_get_redirect_route_for_donator()
    {
        $donator = User::factory()->create(['role' => 'donator']);

        $route = $donator->getRedirectRoute();

        $this->assertEquals(route('donator.dashboard', absolute: false), $route);
    }

    // Project Model Tests
    public function test_project_has_association_relationship()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id
        ]);

        $this->assertInstanceOf(User::class, $project->association);
        $this->assertEquals($association->id, $project->association->id);
    }

    public function test_project_has_category_relationship()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id
        ]);

        $this->assertInstanceOf(Category::class, $project->category);
    }

    public function test_project_has_impact_report_relationship()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id
        ]);

        $impactReport = ImpactReport::factory()->create([
            'project_id' => $project->id
        ]);

        $this->assertInstanceOf(ImpactReport::class, $project->impactReport);
    }

    public function test_project_has_donations_relationship()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id
        ]);

        $donation = Donation::factory()->create([
            'project_id' => $project->id
        ]);

        $this->assertInstanceOf(Donation::class, $project->donations->first());
    }

    public function test_project_calculate_progress_completes_project()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'goalAmount' => 10000,
            'currentAmount' => 10000,
            'status' => 'OPEN'
        ]);

        $project->calculateProgress();

        $this->assertEquals('COMPLETED', $project->fresh()->status);
    }

    public function test_project_check_deadline_closes_expired_project()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'endDate' => now()->subDay(),
            'status' => 'OPEN'
        ]);

        $project->checkDeadline();

        $this->assertEquals('CLOSED', $project->fresh()->status);
    }

    // Donation Model Tests
    public function test_donation_has_donator_relationship()
    {
        $donator = User::factory()->create(['role' => 'donator']);
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id
        ]);

        $donation = Donation::factory()->create([
            'donator_id' => $donator->id,
            'project_id' => $project->id
        ]);

        $this->assertInstanceOf(User::class, $donation->donator);
        $this->assertEquals($donator->id, $donation->donator->id);
    }

    public function test_donation_has_project_relationship()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id
        ]);

        $donation = Donation::factory()->create([
            'project_id' => $project->id
        ]);

        $this->assertInstanceOf(Project::class, $donation->project);
    }

    public function test_donation_has_payment_relationship()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id
        ]);

        $donation = Donation::factory()->create([
            'project_id' => $project->id
        ]);

        $payment = Payment::factory()->create([
            'donation_id' => $donation->id
        ]);

        $this->assertInstanceOf(Payment::class, $donation->payment);
    }
}
