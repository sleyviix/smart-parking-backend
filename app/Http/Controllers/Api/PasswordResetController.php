<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function sendResetLinkEmail(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Password reset email sent'], 200)
            : response()->json(['message' => 'Failed to send password reset email'], 400);
    }

    public function reset(ResetPasswordRequest $request): JsonResponse
    {
        $response = Password::reset($request->validated(), function ($user, $password) {
            $user->forceFill(['password' => Hash::make($password)])->save();

            event(new PasswordReset($user));
        });

        return $response == Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password reset successfully'], 200)
            : response()->json(['message' => 'Failed to reset password'], 400);
    }
}
