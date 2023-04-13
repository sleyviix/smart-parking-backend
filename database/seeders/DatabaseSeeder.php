<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\parkingPlace;
use App\Models\Size;
use App\Models\User;
use Database\Factories\ParkingPlaceFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

//
        //Seed Database
         $this->call([
             SizeSeeder::class,
             SpotAttributeSeeder::class,
             ParkingPlaceSeeder::class,
             ParkingPriceSeeder::class,
             ParkingSpotAttributeSeeder::class,
             SpotSeeder::class,
             SpotSpotAttributeSeeder::class,
//             ReservationSeeder::class,
             VehicleSeeder::class,




        ]);

    }
}
