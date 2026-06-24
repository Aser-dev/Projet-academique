<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ManagerUserManagementTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test: Manager can create user - EF-D5
     */
    public function test_manager_can_create_user()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        
        $this->actingAs($manager)
            ->post('/manager/users', [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'role' => 'client',
            ]);
        
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'role' => 'client',
        ]);
    }

    /**
     * Test: Manager can assign client to agent - EF-D6
     */
    public function test_manager_can_assign_client_to_agent()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $client = User::factory()->create(['role' => 'client']);
        $agent = User::factory()->create(['role' => 'agent']);
        
        $this->actingAs($manager)
            ->post('/manager/affect-client', [
                'client_id' => $client->id,
                'agent_id' => $agent->id,
            ]);
        
        $this->assertDatabaseHas('users', [
            'id' => $client->id,
            'assigned_agent_id' => $agent->id,
        ]);

        $this->assertDatabaseHas('client_agent', [
            'client_id' => $client->id,
            'agent_id' => $agent->id,
            'assigned_by' => $manager->id,
        ]);
    }

    /**
     * Test: Non-manager cannot access manager routes
     */
    public function test_non_manager_cannot_access_manager_dashboard()
    {
        $client = User::factory()->create(['role' => 'client']);
        
        $response = $this->actingAs($client)
            ->get('/manager/dashboard');
        
        $response->assertForbidden();
    }
}
