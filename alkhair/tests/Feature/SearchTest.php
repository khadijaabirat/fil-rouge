<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_search_projects_by_title(): void
    {
        $project1 = Project::factory()->create([
            'title' => 'Build School',
            'status' => 'OPEN',
        ]);
        $project2 = Project::factory()->create([
            'title' => 'Build Hospital',
            'status' => 'OPEN',
        ]);

        $response = $this->get('/projets?search=School');

        $response->assertStatus(200);
        $response->assertSee('Build School');
        $response->assertDontSee('Build Hospital');
    }

    public function test_can_filter_projects_by_category(): void
    {
        $category1 = Category::factory()->create(['name' => 'Education']);
        $category2 = Category::factory()->create(['name' => 'Health']);
        
        $project1 = Project::factory()->create([
            'category_id' => $category1->id,
            'status' => 'OPEN',
        ]);
        $project2 = Project::factory()->create([
            'category_id' => $category2->id,
            'status' => 'OPEN',
        ]);

        $response = $this->get("/projets?category_id={$category1->id}");

        $response->assertStatus(200);
    }

    public function test_can_filter_projects_by_city(): void
    {
        $association1 = User::factory()->create([
            'role' => 'association',
            'ville' => 'Rabat',
        ]);
        $association2 = User::factory()->create([
            'role' => 'association',
            'ville' => 'Casablanca',
        ]);
        
        $project1 = Project::factory()->create([
            'association_id' => $association1->id,
            'status' => 'OPEN',
        ]);
        $project2 = Project::factory()->create([
            'association_id' => $association2->id,
            'status' => 'OPEN',
        ]);

        $response = $this->get('/projets?ville=Rabat');

        $response->assertStatus(200);
    }

    public function test_can_sort_projects_by_urgency(): void
    {
        $project1 = Project::factory()->create([
            'endDate' => now()->addDays(5),
            'status' => 'OPEN',
        ]);
        $project2 = Project::factory()->create([
            'endDate' => now()->addDays(30),
            'status' => 'OPEN',
        ]);

        $response = $this->get('/projets?sort=urgent');

        $response->assertStatus(200);
    }
}
