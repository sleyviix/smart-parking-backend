<?php

namespace Database\Seeders;

use App\Models\parkingSpot;
use App\Models\parkingSpotAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpotAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('spot_attributes')->insert([
            ['name' => 'electric'],
            ['name' => 'for_women'],
            ['name' => 'with_kids'],
            ['name' => 'handicapped']
        ]);
    }


//    public function run(): void
//    {
//        parkingSpot::get()->each(function (parkingSpot $parkingSpot){
//            parkingSpotAttribute::get()->each(function (parkingSpotAttribute $parkingSpotAttribute) use ($parkingSpot){
//                $parkingSpot->parkingSpotAttributes()->attach($parkingSpotAttribute->id, [
//                    'hourly_price' => rand(5,10)
//                ]);
//            });
//        });
//    }
}
