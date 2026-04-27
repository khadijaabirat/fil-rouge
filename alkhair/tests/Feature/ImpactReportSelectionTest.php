<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImpactReportSelectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_association_can_access_project_selection_page()
    {
        $category = Category::factory()->create();
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($association)->get(route('impact.create'));
        
        $response->assertStatus(200);
        $response->assertViewIs('impact.select_project');
    }

    public function test_project_selection_shows_completed_projects_without_report()
    {
        $category = Category::factory()->create();
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
            'category_id' => $category->id,
        ]);

        // Créer un projet COMPLETED sans rapport
        $project = Project::factory()->create([
            'association_id' => $association->id,
            'status' => 'COMPLETED',
            'category_id' => $category->id,
            'title' => 'Test Project Without Report',
        ]);

        $response = $this->actingAs($association)->get(route('impact.create'));
        
        $response->assertStatus(200);
        $response->assertSee('Test Project Without Report');
    }

    public function test_project_selection_shows_projects_with_received_donations()
    {
        $category = Category::factory()->create();
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
            'category_id' => $category->id,
        ]);

        $donator = User::factory()->create([
            'role' => 'donator',
            'email_verified_at' => now(),
        ]);

        // Créer un projet avec dons RECEIVED
        $project = Project::factory()->create([
            'association_id' => $association->id,
            'status' => 'OPEN',
            'category_id' => $category->id,
            'title' => 'Project With Received Funds',
        ]);

        Donation::factory()->create([
            'project_id' => $project->id,
            'donator_id' => $donator->id,
            'status' => 'RECEIVED',
        ]);

        $response = $this->actingAs($association)->get(route('impact.create'));
        
        $response->assertStatus(200);
        $response->assertSee('Project With Received Funds');
    }

    public function test_project_selection_shows_empty_state_when_no_projects_need_report()
    {
        $category = Category::factory()->create();
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($association)->get(route('impact.create'));
        
        $response->assertStatus(200);
        $response->assertSee('Aucun rapport en attente');
    }

    public function test_can_access_specific_project_impact_form()
    {
        $category = Category::factory()->create();
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
            'category_id' => $category->id,
        ]);

        $project = Project::factory()->create([
            'association_id' => $association->id,
            'status' => 'COMPLETED',
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($association)->get(route('impact.create', $project->id));
        
        $response->assertStatus(200);
        $response->assertViewIs('impact.impact_create');
    }
}
