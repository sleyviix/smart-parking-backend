<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalcPayRequest;
use App\Processors\PriceCalcProcessor;


class PayController extends Controller
{
    //
    public function __invoke(CalcPayRequest $request, PriceCalcProcessor $processor): int
    {
//        return $processor->process($request->get('reservation_id'));

        return $processor->process($request->get('reservation_id'));
    }
}
