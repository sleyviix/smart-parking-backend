<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController
{
    //
    public function handleCheckoutSessionCompleted($payload){

//        \Log::info(json_encode($payload));

        Reservation::findOrFail(Arr::get($payload, 'data.object.metadata.reservationId'))->update(['paid_at' => Arr::get($payload, 'created'), 'paid_amount' => Arr::get($payload, 'data.object.amount_total')]);

        return response()->json('', 200);
    }

    public function handleInvoicePaymentSucceeded($payload){


    }
}
