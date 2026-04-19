<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Donation;
use App\Notifications\DonationStatusChanged;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_donator_receives_notification_when_donation_validated(): void
    {
        Notification::fake();

        $admin = User::factory()->create(['role' => 'admin']);
        $donator = User::factory()->create(['role' => 'donator']);
        $donation = Donation::factory()->create([
            'donator_id' => $donator->id,
            'status' => 'PENDING',
        ]);

        $this->actingAs($admin)
            ->post("/admin/donation/{$donation->id}/validate");

        Notification::assertSentTo(
            $donator,
            DonationStatusChanged::class
        );
    }

    public function test_association_receives_notification_when_validated(): void
    {
        Notification::fake();

        $admin = User::factory()->create(['role' => 'admin']);
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'PENDING',
        ]);

        $this->actingAs($admin)
            ->post("/admin/association/{$association->id}/validate");

        Notification::assertSentTo(
            $association,
            \App\Notifications\AssociationStatusChanged::class
        );
    }
}
