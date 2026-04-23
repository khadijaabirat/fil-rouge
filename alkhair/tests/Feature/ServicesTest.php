<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Services\ProjectSearchService;
use App\Services\CacheService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

class ServicesTest extends TestCase
{
    use RefreshDatabase;

    protected $category;
    protected $association;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->category = Category::factory()->create();
        $this->association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id,
            'ville' => 'Casablanca'
        ]);
    }

    // ProjectSearchService Tests
    public function test_project_search_service_can_search_by_title()
    {
        Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'title' => 'Education Project',
            'status' => 'OPEN'
        ]);

        Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'title' => 'Health Project',
            'status' => 'OPEN'
        ]);

        $results = ProjectSearchService::search(['search' => 'Education'])->get();

        $this->assertCount(1, $results);
        $this->assertEquals('Education Project', $results->first()->title);
    }

    public function test_project_search_service_can_filter_by_category()
    {
        $category2 = Category::factory()->create();

        Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $category2->id,
            'status' => 'OPEN'
        ]);

        $results = ProjectSearchService::search(['category_id' => $this->category->id])->get();

        $this->assertCount(1, $results);
    }

    public function test_project_search_service_can_filter_by_ville()
    {
        $association2 = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id,
            'ville' => 'Rabat'
        ]);

        Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        Project::factory()->create([
            'association_id' => $association2->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        $results = ProjectSearchService::search(['ville' => 'Casablanca'])->get();

        $this->assertCount(1, $results);
    }

    public function test_project_search_service_can_sort_by_recent()
    {
        $project1 = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN',
            'created_at' => now()->subDays(5)
        ]);

        $project2 = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN',
            'created_at' => now()
        ]);

        $results = ProjectSearchService::search(['sort' => 'recent'])->get();

        $this->assertEquals($project2->id, $results->first()->id);
    }

    public function test_project_search_service_can_filter_by_date_range()
    {
        Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN',
            'startDate' => now()->subDays(10)
        ]);

        Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN',
            'startDate' => now()
        ]);

        $results = ProjectSearchService::search([
            'date_from' => now()->subDays(5)->format('Y-m-d')
        ])->get();

        $this->assertCount(1, $results);
    }

    public function test_project_search_service_can_filter_by_deadline()
    {
        Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN',
            'endDate' => now()->addDays(5)
        ]);

        Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN',
            'endDate' => now()->addDays(30)
        ]);

        $results = ProjectSearchService::search([
            'deadline_before' => now()->addDays(10)->format('Y-m-d')
        ])->get();

        $this->assertCount(1, $results);
    }

    // CacheService Tests
    public function test_cache_service_can_get_statistics()
    {
        Cache::flush();

        $cacheService = new CacheService();

        Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'currentAmount' => 5000,
            'status' => 'COMPLETED'
        ]);

        $statistics = $cacheService->getStatistics();

        $this->assertIsArray($statistics);
        $this->assertArrayHasKey('totalCollected', $statistics);
        $this->assertArrayHasKey('activeAssociations', $statistics);
        $this->assertArrayHasKey('completedProjects', $statistics);
    }

    public function test_cache_service_caches_statistics()
    {
        Cache::flush();

        $cacheService = new CacheService();

        // First call
        $statistics1 = $cacheService->getStatistics();

        // Verify it's cached
        $this->assertTrue(Cache::has('statistics'));

        // Second call should use cache
        $statistics2 = $cacheService->getStatistics();

        $this->assertEquals($statistics1, $statistics2);
    }

    public function test_cache_service_can_get_categories()
    {
        Cache::flush();

        $cacheService = new CacheService();

        Category::factory()->count(3)->create();

        $categories = $cacheService->getCategories();

        $this->assertCount(4, $categories); // 3 + 1 from setUp
    }

    public function test_cache_service_can_get_open_projects()
    {
        Cache::flush();

        $cacheService = new CacheService();

        Project::factory()->count(5)->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'CLOSED'
        ]);

        $projects = $cacheService->getOpenProjects();

        $this->assertCount(5, $projects);
    }

    public function test_cache_service_limits_open_projects_to_12()
    {
        Cache::flush();

        $cacheService = new CacheService();

        Project::factory()->count(20)->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        $projects = $cacheService->getOpenProjects();

        $this->assertCount(12, $projects);
    }
}
