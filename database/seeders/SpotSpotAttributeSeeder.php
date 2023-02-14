<?php

namespace Database\Seeders;

use App\Models\parkingSpot;
use App\Models\parkingSpotAttribute;
use App\Models\SpotAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpotSpotAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        parkingSpot::get()->each(function (parkingSpot $spot) {
            $spot->SpotAttributes()->attach(SpotAttribute::inRandomOrder()->take(rand(0, 3))->pluck('id'));
        });
    }
}
