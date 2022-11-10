<?php

namespace Database\Seeders;

use App\Models\parkingPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class ParkingPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        parkingPlace::factory(10)->create();
//
//        parkingPlace::factory()->create([
//            'name' => Str::random(10),
//            'postCode' => Str::random(6),
//            'lng' => '100',
//            'lat' => '50',
//
//        ]);

        parkingPlace::factory(15)->create();


    }
}
