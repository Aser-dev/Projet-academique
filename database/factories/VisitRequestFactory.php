<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitRequestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id'   => User::factory(),
            'property_id' => Property::factory(),
            'agent_id'    => null,
            'visit_date'  => fake()->dateTimeBetween('+1 day', '+30 days')->format('Y-m-d'),
            'visit_time'  => '10:00:00',
            'status'      => 'en_attente',
        ];
    }
}
