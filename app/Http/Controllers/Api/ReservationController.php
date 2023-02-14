<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationCreateRequest;
use App\Http\Requests\ReservationDestroyRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function show(Reservation $reservation, Request $request)
    {
        return new ReservationResource($reservation);

    }
    //
    public function store(ReservationCreateRequest $reservationCreateRequest)
    {
        $reservation = $reservationCreateRequest->user()->reservations()->create($reservationCreateRequest->validated());

        return new ReservationResource($reservation);

    }

    public function update(ReservationUpdateRequest $reservationUpdateRequest, Reservation $reservation)
    {
        $reservation->update($reservationUpdateRequest->validated());
        return new ReservationResource($reservation);
//        $reservationUpdateRequest->user()->can('update', $reservation);

    }

    public function delete(ReservationDestroyRequest $reservationDestroyRequest, Reservation $reservation)
    {

        $reservation->delete();

        return response()->json('ok', 204);

//        $reservationDestroyRequest->user()->can('delete', $reservation);
    }


}
