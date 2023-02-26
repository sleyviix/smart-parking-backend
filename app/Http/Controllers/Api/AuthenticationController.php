<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request) : JsonResponse
    {

        $user = User::create([

            'name'=> $request->get('name'),
            'email'=> $request->get('email'),
            'password'=> Hash::make($request->get('password')),

        ]);

        $loginToken = $user -> createToken(name: 'authentication_token')->plainTextToken;

        return response() ->json([
            'access_token' => $loginToken,
            'token_type' => 'Bearer'
        ], status: 201);
    }

    //https://laravel.com/docs/8.x/authentication

    public function loginToken(LoginRequest $request): JsonResponse
    {
        //
        if(!Auth::attempt($request->all())){
            return Response()->json([
                'message'=>'Invalid Login'
            ], status: 401);
        }

        $user = User::where('email', $request->get('email'))->firstOrFail();

        $LoginToken = $user -> createToken('authentication_token')->plainTextToken;


        return response()->json([
            'access_token' => $LoginToken,
            'token_type' => 'Bearer',
            'is_admin' => $user->is_admin
        ], status: 201);
    }

    public function adminLogin(LoginRequest $request) {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Invalid login details'], 401);
        }

        if ($user->is_admin !== 1) {
            return response()->json(['error' => 'You are not authorized to login'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }


}
