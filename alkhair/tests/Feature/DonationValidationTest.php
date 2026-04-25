<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationValidationTest extends TestCase
{
    use RefreshDatabase;

    protected $donator;
    protected $association;
    protected $project;

    protected function setUp(): void
    {
        parent::setUp();

        $this->donator = User::factory()->create([
            'role' => 'donator',
            'email_verified_at' => now(),
        ]);

        $this->association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'email_verified_at' => now(),
        ]);

        $category = Category::factory()->create();

        $this->project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $category->id,
            'goalAmount' => 10000,
            'currentAmount' => 0,
            'status' => 'OPEN',
        ]);
    }

    /** @test */
    public function it_rejects_donation_below_minimum_amount()
    {
        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 50,
                'paymentMethod' => 'ONLINE',
            ]);

        $response->assertSessionHasErrors('amount');
    }

    /** @test */
    public function it_rejects_donation_exceeding_remaining_goal()
    {
        $this->project->update(['currentAmount' => 9500]);

        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 1000,
                'paymentMethod' => 'ONLINE',
            ]);

        $response->assertSessionHasErrors('amount');
    }

    /** @test */
    public function it_accepts_valid_donation_amount()
    {
        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 500,
                'paymentMethod' => 'ONLINE',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('donations', [
            'amount' => 500,
            'donator_id' => $this->donator->id,
            'project_id' => $this->project->id,
        ]);
    }

    /** @test */
    public function it_requires_receipt_for_manual_payment()
    {
        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 500,
                'paymentMethod' => 'MANUAL',
            ]);

        $response->assertSessionHasErrors('paymentReceipt');
    }

    /** @test */
    public function it_rejects_donation_to_closed_project()
    {
        $this->project->update(['status' => 'COMPLETED']);

        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 500,
                'paymentMethod' => 'ONLINE',
            ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function it_validates_message_length()
    {
        $longMessage = str_repeat('a', 501);

        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 500,
                'message' => $longMessage,
                'paymentMethod' => 'ONLINE',
            ]);

        $response->assertSessionHasErrors('message');
    }

    /** @test */
    public function it_allows_anonymous_donation()
    {
        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 500,
                'isAnonymous' => true,
                'paymentMethod' => 'ONLINE',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('donations', [
            'isAnonymous' => true,
            'donator_id' => $this->donator->id,
        ]);
    }
}
