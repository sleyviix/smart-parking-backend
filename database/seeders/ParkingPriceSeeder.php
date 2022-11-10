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
    public function run()
    {
        //
        parkingPlace::get()->each(function (parkingSpot $parkingSpot){

           parkingPrice::factory()->create([
               'parking_place_id' => $parkingSpot->id,
               'size_id' => 1,
               'basePrice' => 3
           ]);

           parkingPrice::factory()->create([
              'parking_place_id' => $parkingSpot->id,
               'size_id' => 2,
               'basePrice' => 3,
               'rates' => [
                   ['amount' => 20, 'hours' => implode('-', [$start = rand(0,20), rand($start, 23)]), 'days' => array_unique(range(1, rand(1,7)))]
               ]
           ]);

           parkingPrice::factory()->create([
              'parking_place_id' => $parkingSpot->id,
              'size_id' => 3,
               'basePrice' => 2
           ]);

        });
    }
}
