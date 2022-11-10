<?php

namespace Database\Factories;

use App\Models\parkingPlace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<parkingPlace>
 */
class ParkingPlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'postCode' => $this->faker->postcode,
            'lng' => $this->faker->longitude,
            'lat' => $this->faker->latitude,
        ];
    }
}
