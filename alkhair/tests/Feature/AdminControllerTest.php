<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Donation;
use App\Models\Payment;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AssociationStatusChanged;
use App\Notifications\DonationStatusChanged;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $association;
    protected $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->category = Category::factory()->create();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->association = User::factory()->create([
            'role' => 'association',
            'status' => 'PENDING',
            'category_id' => $this->category->id
        ]);
    }

    public function test_admin_can_access_dashboard()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    public function test_admin_can_validate_association()
    {
        Notification::fake();

        $response = $this->actingAs($this->admin)
            ->post(route('admin.associations.validate', $this->association->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $this->association->id,
            'status' => 'ACTIVE'
        ]);

        Notification::assertSentTo($this->association, AssociationStatusChanged::class);
    }

    public function test_admin_can_validate_manual_donation()
    {
        Notification::fake();

        $donator = User::factory()->create(['role' => 'donator']);
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'currentAmount' => 0
        ]);

        $donation = Donation::factory()->create([
            'donator_id' => $donator->id,
            'project_id' => $project->id,
            'amount' => 500,
            'status' => 'PENDING'
        ]);

        Payment::factory()->create([
            'donation_id' => $donation->id,
            'paymentMethod' => 'MANUAL',
            'status' => 'PENDING',
            'paymentReceipt' => 'receipts/test.pdf'
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.donations.validate', $donation->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('donations', [
            'id' => $donation->id,
            'status' => 'VALIDATED'
        ]);
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'currentAmount' => 500
        ]);

        Notification::assertSentTo($donator, DonationStatusChanged::class);
    }

    public function test_admin_can_reject_donation()
    {
        Notification::fake();

        $donator = User::factory()->create(['role' => 'donator']);
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id
        ]);

        $donation = Donation::factory()->create([
            'donator_id' => $donator->id,
            'project_id' => $project->id,
            'status' => 'PENDING'
        ]);

        Payment::factory()->create([
            'donation_id' => $donation->id,
            'status' => 'PENDING'
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.donations.reject', $donation->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('donations', [
            'id' => $donation->id,
            'status' => 'FAILED'
        ]);

        Notification::assertSentTo($donator, DonationStatusChanged::class);
    }

    public function test_admin_can_approve_withdrawal()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'COMPLETED'
        ]);

        $donation = Donation::factory()->create([
            'project_id' => $project->id,
            'status' => 'PROCESSING'
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.withdrawals.approve', $project->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('donations', [
            'id' => $donation->id,
            'status' => 'RECEIVED'
        ]);
    }

    public function test_admin_can_ban_association()
    {
        Notification::fake();

        $this->association->update(['status' => 'ACTIVE']);
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.associations.ban', $this->association->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $this->association->id,
            'status' => 'BANNED'
        ]);
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'status' => 'SUSPENDED'
        ]);

        Notification::assertSentTo($this->association, AssociationStatusChanged::class);
    }

    public function test_admin_can_unban_association()
    {
        $this->association->update(['status' => 'BANNED']);
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'SUSPENDED'
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.associations.unban', $this->association->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $this->association->id,
            'status' => 'ACTIVE'
        ]);
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'status' => 'OPEN'
        ]);
    }

    public function test_admin_can_suspend_project()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.projects.suspend', $project->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'status' => 'SUSPENDED'
        ]);
    }

    public function test_admin_can_restore_project()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'SUSPENDED'
        ]);

        $response = $this->actingAs($this->admin)
            ->post(route('admin.projects.restore', $project->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'status' => 'OPEN'
        ]);
    }

    public function test_non_admin_cannot_access_admin_dashboard()
    {
        $donator = User::factory()->create(['role' => 'donator']);

        $response = $this->actingAs($donator)->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }
}
