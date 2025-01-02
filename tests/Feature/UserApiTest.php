<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Models\User;
use App\Mail\UserCreatedMail;
use App\Mail\AdminNotificationMail;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_creation_success()
    {
        // Create an admin user and authenticate it
        $admin = User::factory()->create(['role' => 'administrator']);
        $this->actingAs($admin, 'sanctum'); // Authenticate the test request

        // Fake the Mail system
        Mail::fake();

        // Send POST request to create a user
        $response = $this->postJson('/api/users', [
            'email' => 'test@example.com',
            'password' => 'password123',
            'name' => 'Test User',
            'role' => 'user',
        ]);

        // Assert that the response is correct
        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'email', 'name', 'role', 'created_at']);

        // Assert that the user exists in the database
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);

        // Assert that the appropriate emails were sent
        Mail::assertSent(UserCreatedMail::class, function ($mail) {
            return $mail->hasTo('test@example.com'); // Check recipient
        });

        Mail::assertSent(AdminNotificationMail::class, function ($mail) {
            return $mail->hasTo(env('ADMIN_EMAIL')); // Check recipient
        });
    }
}
