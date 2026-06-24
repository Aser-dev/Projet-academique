<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Property;
use App\Models\VisitRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class VisitRequestTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test: Client can create visit request - EF-B3
     */
    public function test_client_can_create_visit_request()
    {
        $client = User::factory()->create(['role' => 'client']);
        $property = Property::factory()->create(['status' => 'publiee']);
        
        $this->actingAs($client)
            ->post("/visit/{$property->id}", [
                'visit_date' => now()->addDays(5)->format('Y-m-d'),
                'visit_time' => '10:00',
            ]);
        
        $this->assertDatabaseHas('visit_requests', [
            'client_id'   => $client->id,
            'property_id' => $property->id,
            'status'      => 'en_attente',
        ]);
    }

    public function test_visit_request_assigns_client_agent_when_available()
    {
        $agent = User::factory()->create(['role' => 'agent']);
        $client = User::factory()->create([
            'role' => 'client',
            'assigned_agent_id' => $agent->id,
        ]);
        $property = Property::factory()->create(['status' => 'publiee']);

        $this->actingAs($client)
            ->post("/visit/{$property->id}", [
                'visit_date' => now()->addDays(5)->format('Y-m-d'),
                'visit_time' => '10:00',
            ]);

        $this->assertDatabaseHas('visit_requests', [
            'client_id' => $client->id,
            'agent_id'  => $agent->id,
        ]);
    }

    public function test_client_can_view_visits_history()
    {
        $client = User::factory()->create(['role' => 'client']);
        $property = Property::factory()->create(['status' => 'publiee']);

        VisitRequest::factory()->create([
            'client_id' => $client->id,
            'property_id' => $property->id,
            'status' => 'en_attente',
        ]);

        $response = $this->actingAs($client)->get('/client/visits-history');

        $response->assertOk();
        $response->assertSee($property->title);
    }

    /**
     * Test: Agent can validate visit request - EF-D3
     */
    public function test_agent_can_validate_visit_request()
    {
        $agent = User::factory()->create(['role' => 'agent']);
        $client = User::factory()->create(['role' => 'client']);
        $property = Property::factory()->create();
        
        $visit = VisitRequest::factory()->create([
            'client_id'   => $client->id,
            'property_id' => $property->id,
            'status'      => 'en_attente',
        ]);
        
        $this->actingAs($agent)
            ->post("/agent/visits/{$visit->id}/status", ['status' => 'validee']);
        
        $this->assertDatabaseHas('visit_requests', [
            'id' => $visit->id,
            'status' => 'validee',
        ]);
    }

    public function test_agent_cannot_update_visit_assigned_to_another_agent()
    {
        $agent1 = User::factory()->create(['role' => 'agent']);
        $agent2 = User::factory()->create(['role' => 'agent']);
        $client = User::factory()->create(['role' => 'client']);
        $property = Property::factory()->create();

        $visit = VisitRequest::factory()->create([
            'client_id' => $client->id,
            'property_id' => $property->id,
            'agent_id' => $agent1->id,
            'status' => 'en_attente',
        ]);

        $this->actingAs($agent2)
            ->post("/agent/visits/{$visit->id}/status", ['status' => 'validee'])
            ->assertForbidden();
    }
}
