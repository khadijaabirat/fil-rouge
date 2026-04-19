<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use App\Models\Donation;
use App\Models\ImpactReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssociationTest extends TestCase
{
    use RefreshDatabase;

    public function test_pending_association_cannot_access_dashboard(): void
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'PENDING',
        ]);

        $response = $this->actingAs($association)->get('/association/dashboard');

        $response->assertRedirect('/');
    }

    public function test_active_association_can_access_dashboard(): void
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
        ]);

        $response = $this->actingAs($association)->get('/association/dashboard');

        $response->assertStatus(200);
    }

    public function test_association_can_withdraw_funds_from_completed_project(): void
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'rib' => '123456789012345678901234',
        ]);
        $project = Project::factory()->create([
            'association_id' => $association->id,
            'status' => 'COMPLETED',
        ]);
        Donation::factory()->create([
            'project_id' => $project->id,
            'status' => 'VALIDATED',
        ]);

        $response = $this->actingAs($association)
            ->post("/association/projects/{$project->id}/withdraw");

        $response->assertRedirect();
        $this->assertDatabaseHas('donations', [
            'project_id' => $project->id,
            'status' => 'PROCESSING',
        ]);
    }

    public function test_association_cannot_withdraw_without_rib(): void
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'rib' => null,
        ]);
        $project = Project::factory()->create([
            'association_id' => $association->id,
            'status' => 'COMPLETED',
        ]);

        $response = $this->actingAs($association)
            ->post("/association/projects/{$project->id}/withdraw");

        $response->assertSessionHasErrors();
    }

    public function test_association_can_publish_impact_report(): void
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
        ]);
        $project = Project::factory()->create([
            'association_id' => $association->id,
        ]);

        $response = $this->actingAs($association)
            ->post("/association/projects/{$project->id}/impact", [
                'description' => str_repeat('Impact report description ', 10),
                'completionDate' => now()->format('Y-m-d'),
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('impact_reports', [
            'project_id' => $project->id,
        ]);
    }
}
