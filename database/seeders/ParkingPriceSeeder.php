<?php

namespace Database\Seeders;

use App\Models\parkingPlace;
use App\Models\parkingPrice;
use App\Models\parkingSpot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParkingPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        //
        parkingPlace::get()->each(function (parkingPlace $parkingPlace){

           parkingPrice::factory()->create([
               'parking_place_id' => $parkingPlace->id,
               'size_id' => 1,
               'basePrice' => rand(1,3),
               'dailyRate' => 5
           ]);

           parkingPrice::factory()->create([
              'parking_place_id' => $parkingPlace->id,
               'size_id' => 2,
               'basePrice' => rand(4,6),
               'dailyRate' => 10

//                   [
//                   ['amount' => 20, 'hours' => implode('-', [$start = rand(0,20), rand($start, 23)]), 'days' => array_unique(range(1, rand(1,7)))]
//               ]
           ]);

           parkingPrice::factory()->create([
              'parking_place_id' => $parkingPlace->id,
              'size_id' => 3,
               'basePrice' => rand(7,9),
               'dailyRate' => 15
           ]);

        });
    }
}
