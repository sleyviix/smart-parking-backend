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
         User::factory(10)->create();

         User::factory()->create([
             'name' => 'Test User',
             'email' => Str::random(10).'@gmail.com',
         ]);

         $this->call([

             ParkingPlaceSeeder::class,
             ParkingPriceSeeder::class,
             ParkingSpotAttributeSeeder::class,
             ParkingSpotSeeder::class,
             ReservationSeeder::class,
             SizeSeeder::class,
             VehicleSeeder::class,
        ]);

    }
}
