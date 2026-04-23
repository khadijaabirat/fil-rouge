<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Donation;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonatorControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $donator;
    protected $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->category = Category::factory()->create();
        $this->donator = User::factory()->create(['role' => 'donator']);
    }

    public function test_donator_can_access_dashboard()
    {
        $response = $this->actingAs($this->donator)
            ->get(route('donator.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('donator.dashboard');
    }

    public function test_donator_dashboard_shows_own_donations()
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
            'donator_id' => $this->donator->id,
            'project_id' => $project->id
        ]);

        $response = $this->actingAs($this->donator)
            ->get(route('donator.dashboard'));

        $response->assertStatus(200);
        $response->assertViewHas('myDonations');
    }

    public function test_donator_dashboard_can_filter_by_search()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'title' => 'Education Project',
            'status' => 'OPEN'
        ]);

        $response = $this->actingAs($this->donator)
            ->get(route('donator.dashboard', ['search' => 'Education']));

        $response->assertStatus(200);
    }

    public function test_donator_dashboard_can_filter_by_category()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        $response = $this->actingAs($this->donator)
            ->get(route('donator.dashboard', ['category_id' => $this->category->id]));

        $response->assertStatus(200);
    }

    public function test_donator_dashboard_can_filter_by_ville()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id,
            'ville' => 'Casablanca'
        ]);

        Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        $response = $this->actingAs($this->donator)
            ->get(route('donator.dashboard', ['ville' => 'Casablanca']));

        $response->assertStatus(200);
    }

    public function test_donator_dashboard_can_sort_projects()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        Project::factory()->count(3)->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        $response = $this->actingAs($this->donator)
            ->get(route('donator.dashboard', ['sort' => 'recent']));

        $response->assertStatus(200);
    }

    public function test_non_donator_cannot_access_donator_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)
            ->get(route('donator.dashboard'));

        $response->assertStatus(403);
    }
}
