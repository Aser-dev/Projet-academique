<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Property;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoriteToggleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test: Client can toggle favorite - EF-B2
     */
    public function test_authenticated_client_can_toggle_favorite()
    {
        $client = User::factory()->create(['role' => 'client']);
        $property = Property::factory()->create();
        
        // Add to favorites
        $response = $this->actingAs($client)
            ->from('/')
            ->post("/favorite/{$property->id}");
        
        $this->assertDatabaseHas('favorites', [
            'user_id' => $client->id,
            'property_id' => $property->id,
        ]);
    }

    /**
     * Test: Unauthenticated user cannot toggle favorite
     */
    public function test_unauthenticated_user_cannot_toggle_favorite()
    {
        $property = Property::factory()->create();
        
        $response = $this->post("/favorite/{$property->id}");
        $response->assertRedirect('/login');
    }

    /**
     * Test: Client can remove favorite - EF-B2
     */
    public function test_client_can_remove_favorite()
    {
        $client = User::factory()->create(['role' => 'client']);
        $property = Property::factory()->create();
        
        // Create favorite
        Favorite::create([
            'user_id' => $client->id,
            'property_id' => $property->id,
        ]);
        
        // Remove favorite
        $this->actingAs($client)
            ->from('/')
            ->post("/favorite/{$property->id}");
        
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $client->id,
            'property_id' => $property->id,
        ]);
    }
}
