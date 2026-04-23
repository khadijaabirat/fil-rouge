<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Donation;
use App\Models\Payment;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DonationStatusChanged;

class DonationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $donator;
    protected $project;
    protected $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->category = Category::factory()->create();
        $this->donator = User::factory()->create(['role' => 'donator']);
        
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $this->project = Project::factory()->create([
            'association_id' => $association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);
    }

    public function test_donator_can_access_donation_form()
    {
        $response = $this->actingAs($this->donator)
            ->get(route('donations.create', $this->project->id));

        $response->assertStatus(200);
        $response->assertViewIs('donator.donate');
    }

    public function test_donator_can_make_manual_donation()
    {
        Storage::fake('public');

        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 500,
                'message' => 'Test donation',
                'isAnonymous' => false,
                'paymentMethod' => 'MANUAL',
                'paymentReceipt' => UploadedFile::fake()->create('receipt.pdf', 100)
            ]);

        $response->assertRedirect(route('donator.dashboard'));
        $this->assertDatabaseHas('donations', [
            'donator_id' => $this->donator->id,
            'project_id' => $this->project->id,
            'amount' => 500,
            'status' => 'PENDING'
        ]);
        $this->assertDatabaseHas('payments', [
            'paymentMethod' => 'MANUAL',
            'status' => 'PENDING'
        ]);
    }

    public function test_donation_amount_must_be_minimum_100()
    {
        Storage::fake('public');

        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 50,
                'paymentMethod' => 'MANUAL',
                'paymentReceipt' => UploadedFile::fake()->create('receipt.pdf', 100)
            ]);

        $response->assertSessionHasErrors('amount');
    }

    public function test_manual_donation_requires_receipt()
    {
        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 500,
                'paymentMethod' => 'MANUAL'
            ]);

        $response->assertSessionHasErrors('paymentReceipt');
    }

    public function test_cannot_donate_to_closed_project()
    {
        $this->project->update(['status' => 'CLOSED']);

        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 500,
                'paymentMethod' => 'MANUAL',
                'paymentReceipt' => UploadedFile::fake()->create('receipt.pdf', 100)
            ]);

        $response->assertStatus(403);
    }

    public function test_donation_success_updates_project_amount()
    {
        Notification::fake();

        $donation = Donation::factory()->create([
            'donator_id' => $this->donator->id,
            'project_id' => $this->project->id,
            'amount' => 1000,
            'status' => 'PENDING'
        ]);

        Payment::factory()->create([
            'donation_id' => $donation->id,
            'transactionId' => 'test_session_id',
            'paymentMethod' => 'ONLINE',
            'status' => 'PENDING'
        ]);

        $currentAmount = $this->project->currentAmount;

        $response = $this->actingAs($this->donator)
            ->get(route('donations.success', ['id' => $donation->id, 'session_id' => 'test_session_id']));

        $this->assertDatabaseHas('donations', [
            'id' => $donation->id,
            'status' => 'VALIDATED'
        ]);

        $this->assertDatabaseHas('projects', [
            'id' => $this->project->id,
            'currentAmount' => $currentAmount + 1000
        ]);

        Notification::assertSentTo($this->donator, DonationStatusChanged::class);
    }

    public function test_donation_cancel_deletes_pending_donation()
    {
        Storage::fake('public');

        $donation = Donation::factory()->create([
            'donator_id' => $this->donator->id,
            'project_id' => $this->project->id,
            'status' => 'PENDING'
        ]);

        $payment = Payment::factory()->create([
            'donation_id' => $donation->id,
            'paymentReceipt' => 'receipts/test.pdf',
            'status' => 'PENDING'
        ]);

        Storage::disk('public')->put('receipts/test.pdf', 'test content');

        $response = $this->actingAs($this->donator)
            ->get(route('donations.cancel', $donation->id));

        $response->assertRedirect(route('donator.dashboard'));
        $this->assertDatabaseMissing('donations', ['id' => $donation->id]);
        $this->assertDatabaseMissing('payments', ['id' => $payment->id]);
    }

    public function test_anonymous_donation_is_saved_correctly()
    {
        Storage::fake('public');

        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 500,
                'message' => 'Anonymous donation',
                'isAnonymous' => true,
                'paymentMethod' => 'MANUAL',
                'paymentReceipt' => UploadedFile::fake()->create('receipt.pdf', 100)
            ]);

        $this->assertDatabaseHas('donations', [
            'donator_id' => $this->donator->id,
            'project_id' => $this->project->id,
            'isAnonymous' => true
        ]);
    }

    public function test_donation_message_cannot_exceed_500_characters()
    {
        Storage::fake('public');

        $longMessage = str_repeat('a', 501);

        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 500,
                'message' => $longMessage,
                'paymentMethod' => 'MANUAL',
                'paymentReceipt' => UploadedFile::fake()->create('receipt.pdf', 100)
            ]);

        $response->assertSessionHasErrors('message');
    }

    public function test_only_donation_owner_can_access_success_page()
    {
        $otherDonator = User::factory()->create(['role' => 'donator']);

        $donation = Donation::factory()->create([
            'donator_id' => $otherDonator->id,
            'project_id' => $this->project->id,
            'status' => 'PENDING'
        ]);

        $response = $this->actingAs($this->donator)
            ->get(route('donations.success', ['id' => $donation->id, 'session_id' => 'test']));

        $response->assertStatus(403);
    }

    public function test_receipt_file_must_be_valid_format()
    {
        Storage::fake('public');

        $response = $this->actingAs($this->donator)
            ->post(route('donations.store', $this->project->id), [
                'amount' => 500,
                'paymentMethod' => 'MANUAL',
                'paymentReceipt' => UploadedFile::fake()->create('receipt.txt', 100)
            ]);

        $response->assertSessionHasErrors('paymentReceipt');
    }
}
