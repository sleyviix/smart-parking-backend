<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Reservation;
use App\Processors\PriceCalcProcessor;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function show(CheckoutRequest $request, PriceCalcProcessor $priceCalcProcessor, Reservation $reservation)
    {
        $price = $priceCalcProcessor->process($reservation->id) * 100;

        $url = $request->user()->checkoutCharge(
            $price,
            "Reservation #Email:{$request->user()->email} #Name:{$request->user()->name} #Reservation:{$reservation->id} From: ({$reservation->start} To: {$reservation->end})",
            1,
            [
                'success_url' => "https://smart-parking-frontend-git-master-sleyviix.vercel.app/checkout/{$reservation->uuid}?response=success",
                'cancel_url' => "https://smart-parking-frontend-git-master-sleyviix.vercel.app",
                'metadata' => [
                    'reservationId' => $reservation->id,
                    'reservationUUID' => $reservation->uuid
                ]
            ]
        )->asStripeCheckoutSession()->url;

        return response()->json(['url' => $url], 200);
    }
}
