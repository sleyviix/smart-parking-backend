<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use http\Env\Request;

class UserController extends Controller
{
    public function User(Request $request):UserResource
    {
        return new UserResource($request->user());
    }
}
