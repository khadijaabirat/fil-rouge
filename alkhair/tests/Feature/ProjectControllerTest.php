<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $association;
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
    }

    public function test_anyone_can_view_projects_index()
    {
        $response = $this->get(route('projects.index'));

        $response->assertStatus(200);
        $response->assertViewIs('projects.index');
    }

    public function test_anyone_can_view_project_details()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id
        ]);

        $response = $this->get(route('projects.show', $project->id));

        $response->assertStatus(200);
        $response->assertViewIs('projects.show');
    }

    public function test_association_can_access_create_project_form()
    {
        $response = $this->actingAs($this->association)
            ->get(route('projects.create'));

        $response->assertStatus(200);
        $response->assertViewIs('projects.create');
    }

    public function test_association_can_create_project()
    {
        Storage::fake('public');

        $response = $this->actingAs($this->association)
            ->post(route('projects.store'), [
                'title' => 'Test Project',
                'description' => 'Test Description',
                'goalAmount' => 10000,
                'startDate' => now()->format('Y-m-d'),
                'endDate' => now()->addMonth()->format('Y-m-d'),
                'category_id' => $this->category->id,
                'videoUrl' => 'https://youtube.com/test',
                'image' => UploadedFile::fake()->image('project.jpg'),
                'latitude' => 33.5731,
                'longitude' => -7.5898
            ]);

        $response->assertRedirect(route('association.dashboard'));
        $this->assertDatabaseHas('projects', [
            'title' => 'Test Project',
            'association_id' => $this->association->id,
            'goalAmount' => 10000
        ]);
    }

    public function test_project_end_date_must_be_after_start_date()
    {
        $response = $this->actingAs($this->association)
            ->post(route('projects.store'), [
                'title' => 'Test Project',
                'description' => 'Test Description',
                'goalAmount' => 10000,
                'startDate' => now()->addMonth()->format('Y-m-d'),
                'endDate' => now()->format('Y-m-d'),
                'category_id' => $this->category->id
            ]);

        $response->assertSessionHasErrors('endDate');
    }

    public function test_association_cannot_create_project_with_pending_reports()
    {
        $oldProject = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id
        ]);

        Donation::factory()->create([
            'project_id' => $oldProject->id,
            'status' => 'RECEIVED'
        ]);

        $response = $this->actingAs($this->association)
            ->get(route('projects.create'));

        $response->assertRedirect(route('association.dashboard'));
        $response->assertSessionHas('error');
    }

    public function test_association_can_edit_own_project()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id
        ]);

        $response = $this->actingAs($this->association)
            ->get(route('projects.edit', $project->id));

        $response->assertStatus(200);
        $response->assertViewIs('projects.edit');
    }

    public function test_association_cannot_edit_other_association_project()
    {
        $otherAssociation = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $otherAssociation->id,
            'category_id' => $this->category->id
        ]);

        $response = $this->actingAs($this->association)
            ->get(route('projects.edit', $project->id));

        $response->assertStatus(403);
    }

    public function test_association_can_update_project()
    {
        Storage::fake('public');

        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id
        ]);

        $response = $this->actingAs($this->association)
            ->put(route('projects.update', $project->id), [
                'title' => 'Updated Title',
                'description' => 'Updated Description',
                'videoUrl' => 'https://youtube.com/updated',
                'image' => UploadedFile::fake()->image('updated.jpg')
            ]);

        $response->assertRedirect(route('association.dashboard'));
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'Updated Title',
            'description' => 'Updated Description'
        ]);
    }

    public function test_old_image_is_deleted_when_project_is_updated()
    {
        Storage::fake('public');

        $oldImage = UploadedFile::fake()->image('old.jpg');
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'image' => $oldImage->store('projects', 'public')
        ]);

        $newImage = UploadedFile::fake()->image('new.jpg');

        $response = $this->actingAs($this->association)
            ->put(route('projects.update', $project->id), [
                'title' => $project->title,
                'description' => $project->description,
                'image' => $newImage
            ]);

        Storage::disk('public')->assertMissing($project->image);
    }

    public function test_association_can_delete_project_without_donations()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'currentAmount' => 0
        ]);

        $response = $this->actingAs($this->association)
            ->delete(route('projects.destroy', $project->id));

        $response->assertRedirect();
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_association_cannot_delete_project_with_donations()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'currentAmount' => 1000
        ]);

        $response = $this->actingAs($this->association)
            ->delete(route('projects.destroy', $project->id));

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('projects', ['id' => $project->id]);
    }

    public function test_association_can_extend_project_deadline()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'endDate' => now()->addDays(5),
            'goalAmount' => 10000,
            'currentAmount' => 5000
        ]);

        $newEndDate = now()->addDays(30);

        $response = $this->actingAs($this->association)
            ->post(route('projects.extend', $project->id), [
                'newEndDate' => $newEndDate->format('Y-m-d')
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'endDate' => $newEndDate->format('Y-m-d H:i:s')
        ]);
    }

    public function test_association_cannot_extend_completed_project()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'goalAmount' => 10000,
            'currentAmount' => 10000
        ]);

        $response = $this->actingAs($this->association)
            ->post(route('projects.extend', $project->id), [
                'newEndDate' => now()->addMonth()->format('Y-m-d')
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_new_deadline_must_be_after_current_deadline()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'endDate' => now()->addMonth()
        ]);

        $response = $this->actingAs($this->association)
            ->post(route('projects.extend', $project->id), [
                'newEndDate' => now()->format('Y-m-d')
            ]);

        $response->assertSessionHasErrors('newEndDate');
    }

    public function test_project_goal_amount_must_be_positive()
    {
        $response = $this->actingAs($this->association)
            ->post(route('projects.store'), [
                'title' => 'Test Project',
                'description' => 'Test Description',
                'goalAmount' => -100,
                'startDate' => now()->format('Y-m-d'),
                'endDate' => now()->addMonth()->format('Y-m-d'),
                'category_id' => $this->category->id
            ]);

        $response->assertSessionHasErrors('goalAmount');
    }

    public function test_project_latitude_must_be_valid()
    {
        $response = $this->actingAs($this->association)
            ->post(route('projects.store'), [
                'title' => 'Test Project',
                'description' => 'Test Description',
                'goalAmount' => 10000,
                'startDate' => now()->format('Y-m-d'),
                'endDate' => now()->addMonth()->format('Y-m-d'),
                'category_id' => $this->category->id,
                'latitude' => 100 // Invalid
            ]);

        $response->assertSessionHasErrors('latitude');
    }
}
