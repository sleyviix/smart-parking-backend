<?php

namespace Database\Factories;

use App\Models\parkingSpot;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition():array
    {
        return [
            //
            'parking_spot_id' => parkingSpot::factory(),
            'user_id' => User::factory(),
            'start' => $now = Carbon::now(),
            'end' => $now->clone()->addHours(rand(1,28)),
            'paid_at' => null
        ];
    }
}
