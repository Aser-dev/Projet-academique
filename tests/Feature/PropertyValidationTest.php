<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Property;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PropertyValidationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test: Agent can validate property - EF-D1
     */
    public function test_agent_can_validate_property()
    {
        $agent = User::factory()->create(['role' => 'agent']);
        $property = Property::factory()->create(['status' => 'en_attente']);
        
        $this->actingAs($agent)
            ->post("/agent/validations/{$property->id}/validate");
        
        $this->assertDatabaseHas('properties', [
            'id' => $property->id,
            'status' => 'publiee',
            'validated_by' => $agent->id,
        ]);
    }

    /**
     * Test: Agent can reject property with reason - EF-D1
     */
    public function test_agent_can_reject_property_with_reason()
    {
        $agent = User::factory()->create(['role' => 'agent']);
        $property = Property::factory()->create(['status' => 'en_attente']);
        
        $this->actingAs($agent)
            ->post("/agent/validations/{$property->id}/reject", [
                'reason' => 'Photographies insuffisantes ou non conformes',
            ]);
        
        $this->assertDatabaseHas('properties', [
            'id' => $property->id,
            'status' => 'retiree',
            'rejection_reason' => 'Photographies insuffisantes ou non conformes',
        ]);
    }

    /**
     * Test: Only published properties visible to public - EF-C2
     */
    public function test_only_published_properties_visible()
    {
        $published = Property::factory()->create(['status' => 'publiee']);
        $pending = Property::factory()->create(['status' => 'en_attente']);
        
        $response = $this->get('/');
        $response->assertSee($published->title);
        $response->assertDontSee($pending->title);
    }
}
