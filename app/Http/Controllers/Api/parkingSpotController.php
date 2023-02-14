<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\parkingSpotIndexRequest;
use App\Http\Resources\parkingSpotResourceCollection;
use App\Models\parkingPlace;
use App\Models\parkingSpot;
use Illuminate\Http\Request;

class parkingSpotController extends Controller
{
    //

    public function index(parkingSpotIndexRequest $request, parkingPlace $parkingPlace)
    {
        return new parkingSpotResourceCollection(
            $parkingPlace
                ->parkingSpots()
                ->filter($request->validated())
                ->with('spotAttributes')
                ->with('size')
                ->get()
        );
    }

    public function show(parkingSpotIndexRequest $request, parkingPlace $parkingPlace)
    {
        dd($parkingPlace);
//        return new parkingSpotResourceCollection(
//            $parkingPlace
//                ->parkingSpots()
//                ->filter($request->validated())
//                ->with('spotAttributes')
//                ->with('size')
//                ->get()
//        );
    }
}
