<?php

namespace Database\Seeders;

use App\Models\parkingPlace;
use App\Models\parkingSpot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParkingSpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
//    public function run()
//    {
//        //
//        parkingPlace::factory(10)->create();
//
//    }

    public function run()
    {
        parkingPlace::get()->each(function (parkingPlace $parkingPlace) {
            parkingSpot::factory()->count(rand(10, 30))->create([
                'parking_place_id' => $parkingPlace->id
            ]);
        });
    }
}
