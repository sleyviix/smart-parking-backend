<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\parkingPlaceResourceCollection;
use App\Models\parkingPlace;
use Illuminate\Http\Request;
use PhpParser\Builder;
use function foo\func;

class parkingPlaceController extends Controller
{
    //
    public function index(Request $request) : parkingPlaceResourceCollection
    {
        return new parkingPlaceResourceCollection(
            parkingPlace::withCount([
                'parking_spots as total_spots',
                'parking_spots as free_spots' => function(Builder $query) {
                    $query->whereDoesntHave('reservations', function(Builder $query) {
                        $query->whereRaw("? BETWEEN start AND end", [now()]);
                    });
                }
            ])->get()
        );
    }

}
