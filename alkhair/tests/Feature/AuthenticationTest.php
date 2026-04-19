<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_donator_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test Donator',
            'email' => 'donator@test.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => 'donator',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' => 'donator@test.com',
            'role' => 'donator',
        ]);
    }

    public function test_association_registration_requires_kyc(): void
    {
        $category = Category::factory()->create();

        $response = $this->post('/register', [
            'name' => 'Test Association',
            'email' => 'association@test.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => 'association',
            'ville' => 'Rabat',
            'licenseNumber' => 'LIC123456',
            'description' => str_repeat('Test description ', 10),
            'category_id' => $category->id,
        ]);

        $response->assertSessionHasErrors(['documentKYC', 'profilePhoto']);
    }

    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $this->assertAuthenticatedAs($user);
    }

    public function test_banned_user_cannot_access_system(): void
    {
        $user = User::factory()->create([
            'status' => 'BANNED',
        ]);

        $response = $this->actingAs($user)->get('/donator/dashboard');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
