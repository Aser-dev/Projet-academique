<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'title'       => fake()->sentence(4),
            'type'        => fake()->randomElement(['terrain', 'batiment', 'appartement', 'villa', 'commerce']),
            'option'      => fake()->randomElement(['location', 'vente']),
            'location'    => fake()->city(),
            'superficie'  => fake()->randomFloat(2, 30, 500),
            'price'       => fake()->randomFloat(2, 50000, 5000000),
            'rooms'       => fake()->numberBetween(1, 10),
            'floor'       => fake()->numberBetween(0, 20),
            'furnished'   => fake()->boolean(),
            'description' => fake()->paragraph(),
            'status'      => 'publiee',
            'is_agency'   => false,
            'views_count' => 0,
        ];
    }
}
