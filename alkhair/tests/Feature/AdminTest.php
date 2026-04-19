<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Donation;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_admin_dashboard(): void
    {
        $donator = User::factory()->create(['role' => 'donator']);

        $response = $this->actingAs($donator)->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_admin_can_validate_association(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'PENDING',
        ]);

        $response = $this->actingAs($admin)
            ->post("/admin/association/{$association->id}/validate");

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $association->id,
            'status' => 'ACTIVE',
        ]);
    }

    public function test_admin_can_ban_association(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
        ]);

        $response = $this->actingAs($admin)
            ->post("/admin/association/{$association->id}/ban");

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $association->id,
            'status' => 'BANNED',
        ]);
    }

    public function test_admin_can_suspend_project(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $project = Project::factory()->create(['status' => 'OPEN']);

        $response = $this->actingAs($admin)
            ->post("/admin/project/{$project->id}/suspend");

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'status' => 'SUSPENDED',
        ]);
    }
}
