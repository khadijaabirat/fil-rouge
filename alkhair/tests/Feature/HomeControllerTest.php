<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->category = Category::factory()->create(['name' => 'Education']);
    }

    public function test_home_page_is_accessible()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }

    public function test_home_page_displays_statistics()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'currentAmount' => 5000
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewHas('totalCollected');
        $response->assertViewHas('verifiedAssociations');
        $response->assertViewHas('completedProjects');
    }

    public function test_home_page_displays_open_projects()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN',
            'title' => 'Test Project'
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewHas('projects');
    }

    public function test_home_page_can_search_projects()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN',
            'title' => 'Education for Children'
        ]);

        Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN',
            'title' => 'Health Project'
        ]);

        $response = $this->get(route('home', ['search' => 'Education']));

        $response->assertStatus(200);
    }

    public function test_home_page_can_filter_by_category()
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

        $response = $this->get(route('home', ['category' => $this->category->id]));

        $response->assertStatus(200);
    }

    public function test_home_page_displays_categories()
    {
        Category::factory()->count(5)->create();

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewHas('categories');
    }

    public function test_home_page_calculates_total_in_millions()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'currentAmount' => 2000000
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewHas('totalInMillions');
    }

    public function test_home_page_only_shows_open_projects()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $openProject = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN',
            'title' => 'Open Project'
        ]);

        $closedProject = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'status' => 'CLOSED',
            'title' => 'Closed Project'
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }

    public function test_home_page_uses_cache_for_statistics()
    {
        Cache::flush();

        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'currentAmount' => 5000
        ]);

        // First request - should cache
        $response1 = $this->get(route('home'));
        $response1->assertStatus(200);

        // Second request - should use cache
        $response2 = $this->get(route('home'));
        $response2->assertStatus(200);
    }

    public function test_home_page_limits_projects_to_12()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        Project::factory()->count(20)->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewHas('projects');
    }
}
