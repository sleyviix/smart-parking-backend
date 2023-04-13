<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\parkingPlaceResourceCollection;
use App\Http\Resources\parkingPlaceShowResource;
use App\Models\parkingPlace;
use App\Models\parkingPrice;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


class parkingPlaceController extends Controller
{

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


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'postCode' => 'required|string|max:10',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
            'size_id_1_baseRate' => 'required|numeric',
            'size_id_2_baseRate' => 'required|numeric',
            'size_id_3_baseRate' => 'required|numeric',
        ]);

        // Create a new parking place record
        $parkingPlace = ParkingPlace::create($validatedData);

        // Create a new parking price record for each size
        $size1Price = new ParkingPrice([
            'size_id' => 1,
            'basePrice' => $validatedData['size_id_1_baseRate'],
        ]);
        $size2Price = new ParkingPrice([
            'size_id' => 2,
            'basePrice' => $validatedData['size_id_2_baseRate'],
        ]);
        $size3Price = new ParkingPrice([
            'size_id' => 3,
            'basePrice' => $validatedData['size_id_3_baseRate'],
        ]);
        $parkingPlace->parkingPrices()->saveMany([
            $size1Price->setAttribute('parking_place_id', $parkingPlace->id),
            $size2Price->setAttribute('parking_place_id', $parkingPlace->id),
            $size3Price->setAttribute('parking_place_id', $parkingPlace->id),
        ]);

        return response()->json([
            'message' => 'Parking place Added successfully'
        ], 200);
    }

    public function sumPrices($parkingPlaceId)
    {
        $sum = DB::table('parking_prices')
            ->where('parking_place_id', $parkingPlaceId)
            ->whereNotNull('basePrice')
            ->sum('basePrice');

        return $sum;
    }

    public function deleteParkingPlace($id)
    {
        $parkingPlace = parkingPlace::find($id);
        // Delete the user from the database

        $parkingPlace->delete();

        // Return a JSON response showing success
        return response()->json([
            'message' => 'Parking Place deleted successfully',
        ], 200);
    }




}
