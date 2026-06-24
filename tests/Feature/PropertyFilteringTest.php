<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Property;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PropertyFilteringTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test: Property filtering by type - EF-B1
     */
    public function test_filter_properties_by_type()
    {
        // Create properties
        $villa = Property::factory()->create(['type' => 'villa', 'status' => 'publiee']);
        $apartment = Property::factory()->create(['type' => 'appartement', 'status' => 'publiee']);
        
        // Test filter
        $response = $this->get('/?type=villa');
        $response->assertSee($villa->title);
    }

    /**
     * Test: Property filtering by option (vente/location) - EF-B1
     */
    public function test_filter_properties_by_option()
    {
        $sale = Property::factory()->create(['option' => 'vente', 'status' => 'publiee']);
        $rent = Property::factory()->create(['option' => 'location', 'status' => 'publiee']);
        
        $response = $this->get('/?option=vente');
        $response->assertSee($sale->title);
    }

    /**
     * Test: Property filtering by location - EF-B1
     */
    public function test_filter_properties_by_location()
    {
        $property = Property::factory()->create(['location' => 'Ouagadougou', 'status' => 'publiee']);
        
        $response = $this->get('/?location=Ouagadougou');
        $response->assertSee($property->title);
    }

    /**
     * Test: Property filtering by price range - EF-B1
     */
    public function test_filter_properties_by_price_range()
    {
        $cheap = Property::factory()->create(['price' => 5000000, 'status' => 'publiee']);
        $expensive = Property::factory()->create(['price' => 200000000, 'status' => 'publiee']);
        
        $response = $this->get('/?price_range=50000000');
        $response->assertSee($cheap->title);
    }
}
