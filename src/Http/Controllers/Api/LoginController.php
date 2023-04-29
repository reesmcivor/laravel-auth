<?php

namespace ReesMcIvor\Auth\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Notifications\User\VerifyEmail;
use ReesMcIvor\Auth\Services\AuthService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller {

    public function __invoke( UserLoginRequest $request ) : JsonResponse
    {
        $authService = (new AuthService);
        if(!$user = $authService->login($request)) {
            return response()->json(['message' => 'Invalid user'], 403);
        }

        if(!$user->hasVerifiedEmail()) {
            $user->notify(new VerifyEmail());
        }

        if(!$token = $authService->createUserToken($user, $request->get('device_name'))) {
            return response()->json(['message' => 'Invalid credentials'], 403);
        }

        return response()->json([
            'token' => $token,
            'message' => $user->hasVerifiedEmail() ? 'Login successful' : 'Please verify your email address.',
            'verified' => $user->hasVerifiedEmail(),
        ]);
    }

}
