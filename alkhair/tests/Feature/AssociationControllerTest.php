<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Donation;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AssociationControllerTest extends TestCase
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
            'category_id' => $this->category->id,
            'rib' => '123456789012345678901234'
        ]);
    }

    public function test_association_can_access_dashboard()
    {
        $response = $this->actingAs($this->association)->get(route('association.dashboard'));
        
        $response->assertStatus(200);
        $response->assertViewIs('association.dashboard');
    }

    public function test_association_can_withdraw_funds_from_completed_project()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'COMPLETED'
        ]);

        Donation::factory()->create([
            'project_id' => $project->id,
            'status' => 'VALIDATED',
            'amount' => 1000
        ]);

        $response = $this->actingAs($this->association)
            ->post(route('association.withdraw', $project->id));

        $response->assertRedirect();
        $this->assertDatabaseHas('donations', [
            'project_id' => $project->id,
            'status' => 'PROCESSING'
        ]);
    }

    public function test_association_cannot_withdraw_without_rib()
    {
        $this->association->update(['rib' => null]);

        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'COMPLETED'
        ]);

        $response = $this->actingAs($this->association)
            ->post(route('association.withdraw', $project->id));

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_association_cannot_withdraw_from_open_project()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'OPEN'
        ]);

        $response = $this->actingAs($this->association)
            ->post(route('association.withdraw', $project->id));

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_association_cannot_withdraw_if_already_processing()
    {
        $project = Project::factory()->create([
            'association_id' => $this->association->id,
            'category_id' => $this->category->id,
            'status' => 'COMPLETED'
        ]);

        Donation::factory()->create([
            'project_id' => $project->id,
            'status' => 'PROCESSING'
        ]);

        $response = $this->actingAs($this->association)
            ->post(route('association.withdraw', $project->id));

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_association_can_access_edit_profile()
    {
        $response = $this->actingAs($this->association)
            ->get(route('association.profile'));

        $response->assertStatus(200);
        $response->assertViewIs('association.profile');
    }

    public function test_association_can_update_profile()
    {
        Storage::fake('public');

        $response = $this->actingAs($this->association)
            ->put(route('association.updateProfile'), [
                'name' => 'Updated Association',
                'phone' => '0612345678',
                'ville' => 'Casablanca',
                'address' => '123 Rue Test',
                'rib' => '123456789012345678901234',
                'description' => 'Updated description',
                'profilePhoto' => UploadedFile::fake()->image('profile.jpg')
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $this->association->id,
            'name' => 'Updated Association',
            'phone' => '0612345678',
            'ville' => 'Casablanca'
        ]);
    }

    public function test_association_cannot_update_profile_with_invalid_rib()
    {
        $response = $this->actingAs($this->association)
            ->put(route('association.updateProfile'), [
                'name' => 'Test',
                'rib' => '123', // Invalid RIB (not 24 characters)
            ]);

        $response->assertSessionHasErrors('rib');
    }

    public function test_association_cannot_withdraw_from_other_association_project()
    {
        $otherAssociation = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $project = Project::factory()->create([
            'association_id' => $otherAssociation->id,
            'category_id' => $this->category->id,
            'status' => 'COMPLETED'
        ]);

        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        
        $response = $this->actingAs($this->association)
            ->post(route('association.withdraw', $project->id));
    }

    public function test_association_profile_photo_is_deleted_when_updated()
    {
        Storage::fake('public');

        $oldPhoto = UploadedFile::fake()->image('old.jpg');
        $this->association->update([
            'profilePhoto' => $oldPhoto->store('profiles', 'public')
        ]);

        $newPhoto = UploadedFile::fake()->image('new.jpg');
        
        $response = $this->actingAs($this->association)
            ->put(route('association.updateProfile'), [
                'name' => $this->association->name,
                'profilePhoto' => $newPhoto
            ]);

        $response->assertRedirect();
        Storage::disk('public')->assertMissing($this->association->profilePhoto);
    }
}
