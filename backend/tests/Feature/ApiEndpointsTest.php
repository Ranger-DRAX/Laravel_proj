<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

class ApiEndpointsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test register and login flow returns expected responses.
     */
    public function test_register_and_login_endpoints(): void
    {
        // Register
        $registerResponse = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'role' => 'customer',
        ]);
        $registerResponse->assertCreated()
            ->assertJsonStructure(['user' => ['id', 'name', 'email'], 'token']);

        // Login
        $loginResponse = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);
        $loginResponse->assertOk()->assertJsonStructure(['user', 'token']);
    }

    /**
     * Ensure that the index endpoints for each main resource are accessible
     * when authenticated.
     */
    public function test_resource_index_endpoints(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $endpoints = [
            '/api/restaurants',
            '/api/branches',
            '/api/tables',
            '/api/bookings',
            '/api/payments',
        ];

        foreach ($endpoints as $endpoint) {
            $response = $this->getJson($endpoint);
            $response->assertOk();
        }
    }
}
