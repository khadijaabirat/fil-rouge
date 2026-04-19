<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationTest extends TestCase
{
    use RefreshDatabase;

    public function test_donator_can_access_donation_page(): void
    {
        $donator = User::factory()->create(['role' => 'donator']);
        $project = Project::factory()->create(['status' => 'OPEN']);

        $response = $this->actingAs($donator)
            ->get("/projects/{$project->id}/donate");

        $response->assertStatus(200);
    }

    public function test_donation_requires_minimum_amount(): void
    {
        $donator = User::factory()->create(['role' => 'donator']);
        $project = Project::factory()->create(['status' => 'OPEN']);

        $response = $this->actingAs($donator)
            ->post("/projects/{$project->id}/donate", [
                'amount' => 50,
                'paymentMethod' => 'ONLINE',
            ]);

        $response->assertSessionHasErrors('amount');
    }

    public function test_manual_donation_requires_receipt(): void
    {
        $donator = User::factory()->create(['role' => 'donator']);
        $project = Project::factory()->create(['status' => 'OPEN']);

        $response = $this->actingAs($donator)
            ->post("/projects/{$project->id}/donate", [
                'amount' => 200,
                'paymentMethod' => 'MANUAL',
            ]);

        $response->assertSessionHasErrors('paymentReceipt');
    }

    public function test_cannot_donate_to_closed_project(): void
    {
        $donator = User::factory()->create(['role' => 'donator']);
        $project = Project::factory()->create(['status' => 'CLOSED']);

        $response = $this->actingAs($donator)
            ->post("/projects/{$project->id}/donate", [
                'amount' => 200,
                'paymentMethod' => 'ONLINE',
            ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_validate_donation(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $donation = Donation::factory()->create(['status' => 'PENDING']);

        $response = $this->actingAs($admin)
            ->post("/admin/donation/{$donation->id}/validate");

        $response->assertRedirect();
        $this->assertDatabaseHas('donations', [
            'id' => $donation->id,
            'status' => 'VALIDATED',
        ]);
    }
}
