<?php

namespace Database\Seeders;

use App\Models\parkingPlace;
use App\Models\parkingSpot;
use App\Models\parkingSpotAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParkingSpotAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        //
//        \DB::table('parking_spot_attributes')->insert([
//            ['name' => 'Electric'],
//            ['name' => 'Disabled'],
//            ['name' => 'Kids']
//        ]);
        parkingPlace::get()->each(function (parkingSpot $parkingSpot){
            parkingSpotAttribute::get()->each(function (parkingSpotAttribute $parkingSpotAttribute) use ($parkingSpot){
                $parkingSpot->parkingSpotAttributes()->attach($parkingSpotAttribute->id, [
                    'hourly_price' => rand(5,10)
                ]);
            });
        });
    }
}
