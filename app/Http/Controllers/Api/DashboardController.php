<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\parkingPlaceShowResource;
use App\Http\Resources\parkingSpotResource;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\UserResource;
use App\Models\parkingPlace;
use App\Models\ParkingSpot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\SpotAttribute;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $userCount = User::count();
        $reservationCount = Reservation::count();
        $totalPaidAmount = $this->getTotalPaidAmount() / 100;

        return response()->json([
            'userCount' => $userCount,
            'reservation' => $reservationCount,
            'totalPaidAmount' => $totalPaidAmount,
        ]);
    }

    public function getAllUsers():JsonResponse
    {
        $users = User::all();
        return response()->json([
            'users' => UserResource::collection($users),
        ]);
    }


    public function updateUser(Request $request, $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => new UserResource($user),
        ],200);
    }


    public function deleteUser(User $user)
    {
        // Delete the user from the database
        $user->delete();

        // Return a JSON response showing success
        return response()->json([
            'message' => 'User deleted successfully',
        ], 200);
    }

    public function addParkingPlaces(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'postCode' => 'required|string|max:10',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
            'parkingPrices' => 'required|array',
            'parkingPrices.*.size_id' => 'required|exists:sizes,id',
            'parkingPrices.*.basePrice' => 'required|numeric',
            'parkingPrices.*.dailyRate' => 'required|numeric',
            'spotAttributes' => 'nullable|array',
            'spotAttributes.*.attribute_id' => 'required|exists:attributes,id',
            'spotAttributes.*.hourly_price' => 'required|numeric',
            'parkingSpots' => 'required|array',
            'parkingSpots.*.size_id' => 'required|exists:sizes,id',
            'parkingSpots.*.floor' => 'required|numeric',
            'parkingSpots.*.number' => 'required|numeric',
        ]);

        $parkingPlace = new parkingPlace($validatedData);
        $parkingPlace->save();

        $parkingPlace->parkingPrices()->createMany($validatedData['parkingPrices']);
        if (isset($validatedData['spotAttributes'])) {
            $parkingPlace->spotAttributes()->sync($validatedData['spotAttributes']);
        }

        $parkingSpots = collect($validatedData['parkingSpots'])
            ->map(function ($spot) {
                return new ParkingSpot($spot);
            });

        $parkingPlace->parkingSpots()->saveMany($parkingSpots);

        return new parkingPlaceShowResource($parkingPlace);
    }

    public function getTotalPaidAmount(): float
    {
        $totalPaidAmount = Reservation::sum('paid_amount');
        return $totalPaidAmount;
    }

    public function showParkingPlaces(parkingPlace $parkingPlace)
    {
        $parkingPlace->load('parkingPrices.size', 'spotAttributes');

        return new parkingPlaceShowResource($parkingPlace);

    }

    public function getAllParkingPlaces()
    {
        $parkingPlaces = parkingPlace::all();
        return $parkingPlaces->toArray();
//        return parkingPlaceShowResource::collection($parkingPlaces);
    }

    public function updateParkingPlace(Request $request, $id): JsonResponse
    {
        $parkingPlace = parkingPlace::find($id);


        if (!$parkingPlace) {
            return response()->json(['message' => 'User not found'], 404);
        }


        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'postCode' => 'sometimes|required|string|max:10',
            'lng' => 'sometimes|required|numeric',
            'lat' => 'sometimes|required|numeric',
        ]);


        $parkingPlace->update($validatedData);


        $parkingPlaces = parkingPlace::all()->toArray();

        return response()->json([
            'message' => 'Parking place updated successfully',
            'parkingPlaces' => $parkingPlaces,
        ], 200);
    }

//    public function addParkingSpot(Request $request)
//    {
//        // Validate the request data
//        $validatedData = $request->validate([
//            'parking_place_id' => 'required|exists:parking_places,id',
//            'size_id' => 'required|exists:sizes,id',
//            'floor' => 'required|numeric',
//            'number' => 'required|numeric'
//        ]);
//
//        // Create a new parking spot
//        $parkingSpot = new ParkingSpot();
//        $parkingSpot->parking_place_id = $validatedData['parking_place_id'];
//        $parkingSpot->size_id = $validatedData['size_id'];
//        $parkingSpot->floor = $validatedData['floor'];
//        $parkingSpot->number = $validatedData['number'];
//        $parkingSpot->save();
//
//        return "Parking spot added successfully";
//    }

//    public function addParkingSpot(Request $request)
//    {
//        // Validate the request data
//        $validatedData = $request->validate([
//            'parking_place_id' => 'required|exists:parking_places,id',
//            'size_id' => 'required|exists:sizes,id',
//            'floor' => 'required|numeric',
//            'number' => 'required|numeric',
//            'attributes' => 'required|numeric',
//            'attributes.*' => 'required|exists:spot_attributes,id'
//        ]);
//
//        // Create a new parking spot
//        $parkingSpot = new ParkingSpot();
//        $parkingSpot->parking_place_id = $validatedData['parking_place_id'];
//        $parkingSpot->size_id = $validatedData['size_id'];
//        $parkingSpot->floor = $validatedData['floor'];
//        $parkingSpot->number = $validatedData['number'];
//        $parkingSpot->save();
//
//        // Add spot attributes
//        if (isset($validatedData['attributes'])) {
//            $spotAttributes = array_map(function ($attributeId) use ($parkingSpot) {
//                return [
//                    'parking_spot_id' => $parkingSpot->id,
//                    'spot_attribute_id' => $attributeId
//                ];
//            }, $validatedData['attributes']);
//
//            DB::table('parking_spot_spot_attribute')->insert($spotAttributes);
//        }
//
//        return "Parking spot added successfully";
//    }

    public function addParkingSpot(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'parking_place_id' => 'required|exists:parking_places,id',
            'size_id' => 'required|exists:sizes,id',
            'floor' => 'required|numeric',
            'number' => 'required|numeric',
            'attributes' => 'nullable|string',
            'attributes.*' => 'required|exists:spot_attributes,id'
        ]);

        // Create a new parking spot
        $parkingSpot = new ParkingSpot();
        $parkingSpot->parking_place_id = $validatedData['parking_place_id'];
        $parkingSpot->size_id = $validatedData['size_id'];
        $parkingSpot->floor = $validatedData['floor'];
        $parkingSpot->number = $validatedData['number'];
        $parkingSpot->save();

        // Add spot attributes
        if (isset($validatedData['attributes'])) {
            $attributeIds = is_array($validatedData['attributes']) ? $validatedData['attributes'] : explode(',', $validatedData['attributes']);
            $spotAttributes = array_map(function ($attributeId) use ($parkingSpot) {
                return [
                    'parking_spot_id' => $parkingSpot->id,
                    'spot_attribute_id' => $attributeId
                ];
            }, $attributeIds);

            DB::table('parking_spot_spot_attribute')->insert($spotAttributes);
        }

        return "Parking spot added successfully";
    }

//    public function getSpotsByParkingPlace($id)
//    {
//
//        // Retrieve the parking place
//
//        $parkingPlace = ParkingPlace::findOrFail($id);
//
//
//        // Retrieve the parking spots for the parking place
//        $spots = $parkingPlace->parkingSpots;
//
//
//
//
//        return [
//        'id' => $spots->id,
//        'size_id'=>$spots->size->name,
//        'floor'=>$spots->floor,
//        'number'=>$spots->number,
//        'attributes'=> $spots->spotAttributes
//    ];
//    }
//    public function getSpotsByParkingPlace($id)
//    {
//        // Retrieve the parking place
//        $parkingPlace = ParkingPlace::findOrFail($id);
//
//        // Retrieve the parking spots for the parking place
//        $spots = $parkingPlace->parkingSpots;
//
//        // Create an array to hold the spot data
//        $spotData = [];
//
//        // Loop through each parking spot and add its data to the array
//        foreach ($spots as $spot) {
//            $spotData[] = [
//                'id' => $spot->id,
//                'size_id' => $spot->size->name,
//                'floor' => $spot->floor,
//                'number' => $spot->number,
//                'attributes' => $spot->spotAttributes->pluck('name')
//            ];
//        }
//
//        // Return the array of spot data
//        return $spotData;
//    }
    public function getSpotsByParkingPlace($id)
    {
        // Retrieve the parking place
        $parkingPlace = ParkingPlace::findOrFail($id);

        // Retrieve the parking spots for the parking place
        $spots = $parkingPlace->parkingSpots;

        // Create an array to hold the spot data
        $spotData = [];

        // Loop through each parking spot and add its data to the array
        foreach ($spots as $spot) {
            $spotData[] = [
                'id' => $spot->id,
                'size_id' => $spot->size->name,
                'floor' => $spot->floor,
                'number' => $spot->number,
                'attributes' => $spot->spotAttributes->pluck('name')
            ];
        }

        // Sort the array by floor and number
        usort($spotData, function($a, $b) {
            if ($a['floor'] == $b['floor']) {
                return $a['number'] - $b['number'];
            } else {
                return $a['floor'] - $b['floor'];
            }
        });

        // Return the sorted array of spot data
        return $spotData;
    }

    public function deleteParkingSpot($id)
    {
        $parkingSpot = ParkingSpot::find($id);

        if (!$parkingSpot) {
            return response()->json([
                'message' => 'Parking spot not found.'
            ], 404);
        }

        $parkingSpot->delete();

        return response()->json([
            'message' => 'Parking spot deleted successfully.'
        ], 200);
    }

    public function viewAllReservations(Request $request)
    {
        $reservations = Reservation::all();
        return ReservationResource::collection($reservations);
    }

    public function deleteReservation($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted successfully']);
    }





}
