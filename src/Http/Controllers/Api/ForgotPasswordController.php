<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(['link' => 'required']);
        $request->validate(['email' => 'required|email|exists:users,email']);
        $status = Password::sendResetLink($request->only('email'));

        if(Password::RESET_THROTTLED === $status) {
            return response()->json(['message' => 'Too many password reset attempts. Please try again later.'], 429);
        }

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Password reset email sent'])
            : response()->json(['message' => 'Unable to send password reset email'], 500);
    }
}
