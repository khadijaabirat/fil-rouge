<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\ImpactReport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SingleActiveProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_association_cannot_create_multiple_active_projects()
    {
        $category = Category::factory()->create();
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
            'category_id' => $category->id,
        ]);

        // Créer un premier projet OPEN
        $project1 = Project::factory()->create([
            'association_id' => $association->id,
            'status' => 'OPEN',
            'category_id' => $category->id,
        ]);

        // Essayer de créer un deuxième projet
        $response = $this->actingAs($association)->get(route('projects.create'));
        
        $response->assertRedirect(route('association.dashboard'));
        $response->assertSessionHas('error');
    }

    public function test_association_can_create_project_when_no_active_project()
    {
        $category = Category::factory()->create();
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
            'category_id' => $category->id,
        ]);

        // Pas de projet actif
        $response = $this->actingAs($association)->get(route('projects.create'));
        
        $response->assertStatus(200);
        $response->assertViewIs('projects.create');
    }

    public function test_association_can_create_project_after_completing_previous()
    {
        $category = Category::factory()->create();
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
            'category_id' => $category->id,
        ]);

        // Créer un projet COMPLETED avec rapport
        $project1 = Project::factory()->create([
            'association_id' => $association->id,
            'status' => 'COMPLETED',
            'category_id' => $category->id,
        ]);
        
        // Ajouter rapport d'impact
        ImpactReport::factory()->create([
            'project_id' => $project1->id,
        ]);

        // Devrait pouvoir créer un nouveau projet
        $response = $this->actingAs($association)->get(route('projects.create'));
        
        $response->assertStatus(200);
    }
    
    public function test_association_cannot_create_project_if_completed_without_report()
    {
        $category = Category::factory()->create();
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
            'category_id' => $category->id,
        ]);

        // Créer un projet COMPLETED SANS rapport
        $project1 = Project::factory()->create([
            'association_id' => $association->id,
            'status' => 'COMPLETED',
            'category_id' => $category->id,
        ]);

        // Ne devrait PAS pouvoir créer un nouveau projet
        $response = $this->actingAs($association)->get(route('projects.create'));
        
        $response->assertRedirect(route('association.dashboard'));
        $response->assertSessionHas('error');
    }

    public function test_dashboard_shows_active_project_warning()
    {
        $category = Category::factory()->create();
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
            'category_id' => $category->id,
        ]);

        // Créer un projet OPEN
        $project = Project::factory()->create([
            'association_id' => $association->id,
            'status' => 'OPEN',
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($association)->get(route('association.dashboard'));
        
        $response->assertStatus(200);
        $response->assertSee('Projet actif en cours');
    }
    
    public function test_dashboard_shows_completed_without_report_warning()
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
        ]);

        $response = $this->actingAs($association)->get(route('association.dashboard'));
        
        $response->assertStatus(200);
        $response->assertSee('Rapport manquant');
    }
}
