<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AgencyPropertyTest extends TestCase
{
    use DatabaseMigrations;

    public function test_agent_can_create_agency_property_with_option_type()
    {
        Storage::fake('public');

        $agent = User::factory()->create(['role' => 'agent']);

        $response = $this->actingAs($agent)->post('/agent/properties/agency', [
            'title' => 'Bureau centre-ville',
            'description' => 'Espace moderne au centre.',
            'price' => 250000,
            'superficie' => 80,
            'localisation' => 'Ouagadougou',
            'type' => 'commerce',
            'option_type' => 'location',
            'usages' => ['bureau'],
            'photos' => [UploadedFile::fake()->image('bureau.jpg')],
        ]);

        $response->assertRedirect(route('agent.properties'));

        $this->assertDatabaseHas('properties', [
            'user_id' => $agent->id,
            'title' => 'Bureau centre-ville',
            'option' => 'location',
            'location' => 'Ouagadougou',
            'is_agency' => true,
            'status' => 'publiee',
        ]);
    }
}
