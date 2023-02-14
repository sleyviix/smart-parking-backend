<?php

namespace Database\Seeders;

use App\Models\parkingSpot;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parkingSpot::get()->each(function (parkingSpot $spot) {

            $start = now()->addHours(rand(-15, 15));

            if (rand(0,1)) {
                Reservation::factory()->create([
                    'parking_spot_id' => $spot->id,
                    'start'   => $start,
                    'end'     => $start->clone()->addHours(rand(1, 70)),
                    'paid_at' => $start->clone()->addSeconds(rand(30, 120))
                ]);
            }

            if (rand(0,1)) {
                Reservation::factory()->create([
                    'parking_spot_id' => $spot->id,
                    'start'   => $start_2 = $start->clone()->addHours(rand(71,100)),
                    'end'     => $start_2->clone()->addHours(rand(1, 70)),
                    'paid_at' => $start_2->clone()->addSeconds(rand(30, 120))
                ]);
            }

            if (rand(0,1)) {
                Reservation::factory()->create([
                    'parking_spot_id' => $spot->id,
                    'start'   => $start_3 = $start->clone()->addHours(rand(171,300)),
                    'end'     => $start_3->clone()->addHours(rand(1, 70)),
                    'paid_at' => $start_3->clone()->addSeconds(rand(30, 120))
                ]);
            }
        });
    }
}
