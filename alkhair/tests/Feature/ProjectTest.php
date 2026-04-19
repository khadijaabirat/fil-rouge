<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_association_can_create_project(): void
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
        ]);
        $category = Category::factory()->create();

        $response = $this->actingAs($association)
            ->post('/projects', [
                'title' => 'Test Project',
                'description' => str_repeat('Test description ', 20),
                'goalAmount' => 5000,
                'startDate' => now()->format('Y-m-d'),
                'endDate' => now()->addMonth()->format('Y-m-d'),
                'category_id' => $category->id,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', [
            'title' => 'Test Project',
            'association_id' => $association->id,
        ]);
    }

    public function test_project_requires_minimum_description_length(): void
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
        ]);
        $category = Category::factory()->create();

        $response = $this->actingAs($association)
            ->post('/projects', [
                'title' => 'Test Project',
                'description' => 'Short',
                'goalAmount' => 5000,
                'startDate' => now()->format('Y-m-d'),
                'endDate' => now()->addMonth()->format('Y-m-d'),
                'category_id' => $category->id,
            ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_association_can_only_edit_own_projects(): void
    {
        $association1 = User::factory()->create(['role' => 'association', 'status' => 'ACTIVE']);
        $association2 = User::factory()->create(['role' => 'association', 'status' => 'ACTIVE']);
        $project = Project::factory()->create(['association_id' => $association1->id]);

        $response = $this->actingAs($association2)
            ->get("/projects/{$project->id}/edit");

        $response->assertStatus(403);
    }

    public function test_project_status_changes_when_goal_reached(): void
    {
        $project = Project::factory()->create([
            'goalAmount' => 1000,
            'currentAmount' => 0,
            'status' => 'OPEN',
        ]);

        $project->update(['currentAmount' => 1000]);
        $project->calculateProgress();

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'status' => 'COMPLETED',
        ]);
    }

    public function test_expired_projects_are_closed(): void
    {
        $project = Project::factory()->create([
            'status' => 'OPEN',
            'endDate' => now()->subDay(),
        ]);

        $project->checkDeadline();

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'status' => 'CLOSED',
        ]);
    }
}
