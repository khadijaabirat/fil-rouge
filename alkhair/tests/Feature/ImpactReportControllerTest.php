<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Donation;
use App\Models\Category;
use App\Models\ImpactReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ImpactReportPublished;

class ImpactReportControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $association;
    protected $project;
    protected $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->category = Category::factory()->create();
        $this->association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $this->project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id
        ]);
    }

    public function test_association_can_access_impact_report_form()
    {
        $response = $this->actingAs($this->association)
            ->get(route('impact-reports.create', $this->project->id));

        $response->assertStatus(200);
        $response->assertViewIs('association.impact_create');
    }

    public function test_association_cannot_access_impact_form_for_other_project()
    {
        $otherAssociation = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $otherProject = Project::factory()->create([
            'association_id' => $otherAssociation->id,
            'category_id' => $this->category->id
        ]);

        $response = $this->actingAs($this->association)
            ->get(route('impact-reports.create', $otherProject->id));

        $response->assertStatus(403);
    }

    public function test_association_can_create_impact_report()
    {
        Notification::fake();

        $donator = User::factory()->create(['role' => 'donator']);
        
        Donation::factory()->create([
            'project_id' => $this->project->id,
            'donator_id' => $donator->id,
            'status' => 'RECEIVED'
        ]);

        $response = $this->actingAs($this->association)
            ->post(route('impact-reports.store', $this->project->id), [
                'description' => 'This is a detailed impact report describing the project outcomes and achievements.',
                'completionDate' => now()->format('Y-m-d'),
                'videoLink' => 'https://youtube.com/impact-video'
            ]);

        $response->assertRedirect(route('association.dashboard'));
        $this->assertDatabaseHas('impact_reports', [
            'project_id' => $this->project->id,
            'description' => 'This is a detailed impact report describing the project outcomes and achievements.'
        ]);

        Notification::assertSentTo($donator, ImpactReportPublished::class);
    }

    public function test_impact_report_updates_donation_status()
    {
        $donation = Donation::factory()->create([
            'project_id' => $this->project->id,
            'status' => 'RECEIVED'
        ]);

        $response = $this->actingAs($this->association)
            ->post(route('impact-reports.store', $this->project->id), [
                'description' => 'This is a detailed impact report describing the project outcomes.',
                'completionDate' => now()->format('Y-m-d')
            ]);

        $this->assertDatabaseHas('donations', [
            'id' => $donation->id,
            'status' => 'IMPACT'
        ]);
    }

    public function test_impact_report_description_must_be_minimum_50_characters()
    {
        $response = $this->actingAs($this->association)
            ->post(route('impact-reports.store', $this->project->id), [
                'description' => 'Short text',
                'completionDate' => now()->format('Y-m-d')
            ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_impact_report_requires_completion_date()
    {
        $response = $this->actingAs($this->association)
            ->post(route('impact-reports.store', $this->project->id), [
                'description' => 'This is a detailed impact report describing the project outcomes and achievements.'
            ]);

        $response->assertSessionHasErrors('completionDate');
    }

    public function test_video_link_must_be_valid_url()
    {
        $response = $this->actingAs($this->association)
            ->post(route('impact-reports.store', $this->project->id), [
                'description' => 'This is a detailed impact report describing the project outcomes.',
                'completionDate' => now()->format('Y-m-d'),
                'videoLink' => 'invalid-url'
            ]);

        $response->assertSessionHasErrors('videoLink');
    }

    public function test_cannot_create_duplicate_impact_report()
    {
        ImpactReport::factory()->create([
            'project_id' => $this->project->id
        ]);

        $response = $this->actingAs($this->association)
            ->get(route('impact-reports.create', $this->project->id));

        $response->assertRedirect(route('association.dashboard'));
        $response->assertSessionHas('error');
    }

    public function test_cannot_submit_duplicate_impact_report()
    {
        ImpactReport::factory()->create([
            'project_id' => $this->project->id
        ]);

        $response = $this->actingAs($this->association)
            ->post(route('impact-reports.store', $this->project->id), [
                'description' => 'This is a detailed impact report describing the project outcomes.',
                'completionDate' => now()->format('Y-m-d')
            ]);

        $response->assertRedirect(route('association.dashboard'));
        $response->assertSessionHas('error');
    }

    public function test_only_donations_with_received_status_are_updated()
    {
        $receivedDonation = Donation::factory()->create([
            'project_id' => $this->project->id,
            'status' => 'RECEIVED'
        ]);

        $validatedDonation = Donation::factory()->create([
            'project_id' => $this->project->id,
            'status' => 'VALIDATED'
        ]);

        $response = $this->actingAs($this->association)
            ->post(route('impact-reports.store', $this->project->id), [
                'description' => 'This is a detailed impact report describing the project outcomes.',
                'completionDate' => now()->format('Y-m-d')
            ]);

        $this->assertDatabaseHas('donations', [
            'id' => $receivedDonation->id,
            'status' => 'IMPACT'
        ]);

        $this->assertDatabaseHas('donations', [
            'id' => $validatedDonation->id,
            'status' => 'VALIDATED'
        ]);
    }

    public function test_notification_sent_only_to_donators_with_impact_status()
    {
        Notification::fake();

        $donatorWithReceived = User::factory()->create(['role' => 'donator']);
        $donatorWithValidated = User::factory()->create(['role' => 'donator']);

        Donation::factory()->create([
            'project_id' => $this->project->id,
            'donator_id' => $donatorWithReceived->id,
            'status' => 'RECEIVED'
        ]);

        Donation::factory()->create([
            'project_id' => $this->project->id,
            'donator_id' => $donatorWithValidated->id,
            'status' => 'VALIDATED'
        ]);

        $response = $this->actingAs($this->association)
            ->post(route('impact-reports.store', $this->project->id), [
                'description' => 'This is a detailed impact report describing the project outcomes.',
                'completionDate' => now()->format('Y-m-d')
            ]);

        Notification::assertSentTo($donatorWithReceived, ImpactReportPublished::class);
        Notification::assertNotSentTo($donatorWithValidated, ImpactReportPublished::class);
    }
}
