<?php

namespace Database\Factories;

use App\Models\parkingPlace;
use App\Models\parkingSpot;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<parkingSpot>
 */
class ParkingSpotFactory extends Factory
{

    protected $model = parkingSpot::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'parking_place_id' => parkingPlace::factory(),
            'size_id' => Size::inRandomOrder()->first()->id,
            'floor' => rand(0, 15),
            'number' => rand(0, 15),



        ];
    }
}
