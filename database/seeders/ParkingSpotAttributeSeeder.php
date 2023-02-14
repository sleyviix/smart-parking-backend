<?php

namespace Database\Seeders;

use App\Models\parkingPlace;
use App\Models\parkingSpot;
use App\Models\parkingSpotAttribute;
use App\Models\SpotAttribute;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParkingSpotAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

//    public function run()
//    {
//        //
//        DB::table('spot_attributes')->insert([
//            ['name' => 'electric'],
//            ['name' => 'for_women'],
//            ['name' => 'with_kids'],
//            ['name' => 'handicapped']
//        ]);
//    }

    public function run(): void
    {
        parkingPlace::get()->each(function (parkingPlace $parkingPlace){
            SpotAttribute::get()->each(function (SpotAttribute $SpotAttribute) use ($parkingPlace){
                $parkingPlace->spotAttributes()->attach($SpotAttribute->id, [
                    'hourly_price' => rand(5,10),
                    'created_at' => $now = Carbon::now(),
                ]);
            });
        });
    }
}
