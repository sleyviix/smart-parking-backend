<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\parkingPlaceResourceCollection;
use App\Http\Resources\parkingPlaceShowResource;
use App\Models\parkingPlace;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class parkingPlaceController extends Controller
{
    //
    public function index(Request $request)
    {
        return new parkingPlaceResourceCollection(
            parkingPlace::withCount([
                'parkingSpots as total_spots',
                'parkingSpots as free_spots' => function(Builder $query) {
                    $query->whereDoesntHave('reservations', function(Builder $query) {
                        $query->whereRaw("? BETWEEN start AND end", [now()]);
                    });
                }
            ])->get()
        );
    }

    public function show(parkingPlace $parkingPlace)
    {
        $parkingPlace->load('parkingPrices.size', 'spotAttributes');

        return new parkingPlaceShowResource($parkingPlace);

    }

}
