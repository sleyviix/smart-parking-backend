<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use http\Env\Request;

class UsersController extends Controller
{
    public function userMe(Request $request):UserResource
    {
        return new UserResource($request->user());
    }
}
