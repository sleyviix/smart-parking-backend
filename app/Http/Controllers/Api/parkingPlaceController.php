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

//    public function store(Request $request)
//    {
//        $validatedData = $request->validate([
//            'name' => 'required|string|max:255',
//            'postCode' => 'required|string|max:10',
//            'lng' => 'required|numeric',
//            'lat' => 'required|numeric',
//            'parkingPrices' => 'required|array',
//            'parkingPrices.*.size_id' => 'required|exists:sizes,id',
//            'parkingPrices.*.basePrice' => 'required|numeric',
//            'parkingPrices.*.dailyRate' => 'required|numeric',
//            'spotAttributes' => 'nullable|array',
//            'spotAttributes.*.attribute_id' => 'required|exists:attributes,id',
//            'spotAttributes.*.hourly_price' => 'required|numeric',
//            'parkingSpots' => 'required|array',
//            'parkingSpots.*.size_id' => 'required|exists:sizes,id',
//            'parkingSpots.*.floor' => 'required|numeric',
//            'parkingSpots.*.number' => 'required|numeric',
//        ]);
//
//        $parkingPlace = new parkingPlace($validatedData);
//        $parkingPlace->save();
//
//        $parkingPlace->parkingPrices()->createMany($validatedData['parkingPrices']);
//        if (isset($validatedData['spotAttributes'])) {
//            $parkingPlace->spotAttributes()->sync($validatedData['spotAttributes']);
//        }
//
//        $parkingSpots = collect($validatedData['parkingSpots'])
//            ->map(function ($spot) {
//                return new ParkingSpot($spot);
//            });
//
//        $parkingPlace->parkingSpots()->saveMany($parkingSpots);
//
//        return new parkingPlaceShowResource($parkingPlace);
//    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'postCode' => 'required|string|max:10',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
        ]);

        $parkingPlace = parkingPlace::create($validatedData);

        return new parkingPlaceShowResource($parkingPlace);
    }


}
