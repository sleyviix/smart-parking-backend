<?php

namespace Database\Factories;

use App\Models\parkingPlace;
use App\Models\parkingPrice;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<parkingPrice>
 */
class ParkingPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition():array
    {
        return [
            //
            'parking_place_id' => parkingPlace::factory(),
            'size_id' => Size::inRandomOrder()->first()->id,
            'base' => rand(100,5000),
            'rates' => null
        ];
    }
}
