<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function User(Request $request):UserResource
    {
        return new UserResource($request->user());
    }
    public function showUser(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function updateUser(Request $request):JsonResponse
    {
        $user = $request->user();

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
        ]);
    }

    public function sumPaidAmount($userId)
    {
        $sum = DB::table('reservations')
            ->where('user_id', $userId)
            ->whereNotNull('paid_amount')
            ->sum('paid_amount');

        return $sum;
    }

    public function countReservations($userId)
    {
        $count = DB::table('reservations')
            ->where('user_id', $userId)
            ->count();

        return $count;
    }
}
