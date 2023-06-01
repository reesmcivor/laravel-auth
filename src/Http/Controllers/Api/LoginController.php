<?php

namespace ReesMcIvor\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use ReesMcIvor\Auth\Http\Requests\Api\UserLoginRequest;
use ReesMcIvor\Auth\Notifications\Auth\VerifyEmail;
use ReesMcIvor\Auth\Services\AuthService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller {

    public function __invoke( UserLoginRequest $request ) : JsonResponse
    {
        Log::debug($request->all());

        $authService = (new AuthService);
        if(!$user = $authService->login($request)) {
            return response()->json(['message' => 'Invalid user'], 403);
        }

        $user->email_verified_at = now();
        $user->save();

        if(!$user->hasVerifiedEmail()) {
            $user->notify(new VerifyEmail());
        }

        if(!$token = $authService->createUserToken  ($user, $request->get('device_name'))) {
            return response()->json(['message' => 'Invalid credentials'], 403);
        }

        return response()->json([
            'id' => $user->id,
            'token' => $token,
            'message' => $user->hasVerifiedEmail() ? 'Login successful' : 'Please verify your email address.',
            'verified' => $user->hasVerifiedEmail(),
        ]);
    }

}
