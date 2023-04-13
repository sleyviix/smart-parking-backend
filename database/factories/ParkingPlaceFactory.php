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
            'name' => $this->faker->streetName . ' Car Park',
            'postCode' => 'B' . $this->faker->regexify('[0-9]{2}') . ' ' . $this->faker->regexify('[0-9]') . $this->faker->regexify('[A-Z]{2}'),
            'lng' => $this->faker->randomFloat($nbMaxDecimals = 6, $min = $birminghamLng - 0.2, $max = $birminghamLng + 0.2),
            'lat' => $this->faker->randomFloat($nbMaxDecimals = 6, $min = $birminghamLat - 0.2, $max = $birminghamLat + 0.2),
        ];
    }
}
