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
        $birminghamLng = -1.890401;
        $birminghamLat = 52.486243;

        return [
            'name' => $this->faker->name,
            'postCode' => $this->faker->postcode,
//            'lng' => $this->faker->longitude,
//            'lat' => $this->faker->latitude,
            'lng' => $this->faker->randomFloat($nbMaxDecimals = 6, $min = $birminghamLng - 0.2, $max = $birminghamLng + 0.2),
            'lat' => $this->faker->randomFloat($nbMaxDecimals = 6, $min = $birminghamLat - 0.2, $max = $birminghamLat + 0.2),
        ];
    }
}
