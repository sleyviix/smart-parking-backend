<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition():array
    {
        return [

            'user_id' => \App\Models\User::factory(),
            'number_plate' => $this->faker->unique()->bothify('#######'),
            'free_access' => $this->faker->boolean(10)

        ];
    }
}
