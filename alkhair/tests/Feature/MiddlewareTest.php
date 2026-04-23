<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->category = Category::factory()->create();
    }

    // CheckRole Middleware Tests
    public function test_admin_can_access_admin_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }

    public function test_association_cannot_access_admin_routes()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $response = $this->actingAs($association)->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }

    public function test_donator_cannot_access_admin_routes()
    {
        $donator = User::factory()->create(['role' => 'donator']);

        $response = $this->actingAs($donator)->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }

    public function test_association_can_access_association_routes()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $response = $this->actingAs($association)->get(route('association.dashboard'));

        $response->assertStatus(200);
    }

    public function test_donator_cannot_access_association_routes()
    {
        $donator = User::factory()->create(['role' => 'donator']);

        $response = $this->actingAs($donator)->get(route('association.dashboard'));

        $response->assertStatus(403);
    }

    public function test_admin_cannot_access_association_routes()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('association.dashboard'));

        $response->assertStatus(403);
    }

    public function test_donator_can_access_donator_routes()
    {
        $donator = User::factory()->create(['role' => 'donator']);

        $response = $this->actingAs($donator)->get(route('donator.dashboard'));

        $response->assertStatus(200);
    }

    public function test_association_cannot_access_donator_routes()
    {
        $association = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $response = $this->actingAs($association)->get(route('donator.dashboard'));

        $response->assertStatus(403);
    }

    // CheckBannedUser Middleware Tests
    public function test_banned_user_cannot_login()
    {
        $bannedUser = User::factory()->create([
            'role' => 'association',
            'status' => 'BANNED',
            'category_id' => $this->category->id,
            'email' => 'banned@test.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->post(route('login'), [
            'email' => 'banned@test.com',
            'password' => 'password'
        ]);

        $response->assertRedirect();
        $this->assertGuest();
    }

    public function test_active_user_can_login()
    {
        $activeUser = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id,
            'email' => 'active@test.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->post(route('login'), [
            'email' => 'active@test.com',
            'password' => 'password'
        ]);

        $this->assertAuthenticated();
    }

    public function test_pending_association_can_login()
    {
        $pendingUser = User::factory()->create([
            'role' => 'association',
            'status' => 'PENDING',
            'category_id' => $this->category->id,
            'email' => 'pending@test.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->post(route('login'), [
            'email' => 'pending@test.com',
            'password' => 'password'
        ]);

        $this->assertAuthenticated();
    }

    public function test_banned_user_is_logged_out_automatically()
    {
        $user = User::factory()->create([
            'role' => 'association',
            'status' => 'ACTIVE',
            'category_id' => $this->category->id
        ]);

        $this->actingAs($user);

        // Ban the user
        $user->update(['status' => 'BANNED']);

        // Try to access a protected route
        $response = $this->get(route('association.dashboard'));

        $response->assertRedirect();
    }

    public function test_guest_cannot_access_protected_routes()
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_unauthenticated_user_redirected_to_login()
    {
        $response = $this->get(route('donator.dashboard'));

        $response->assertRedirect(route('login'));
    }
}
