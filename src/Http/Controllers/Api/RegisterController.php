<?php

namespace ReesMcIvor\Auth\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use ReesMcIvor\Auth\Http\Requests\Api\UserRegisterRequest;
use ReesMcIvor\Auth\Notifications\Auth\VerifyEmail;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __invoke( UserRegisterRequest $request )
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'current_team_id' => Role::CUSTOMER_ROLE_ID,
            'active' => 1
        ]);

        $plainTextToken = $user->createToken($request->get('device_name'))->plainTextToken;

        if (!$user->hasVerifiedEmail()) {
            $user->notify(new VerifyEmail());
            return response()->json([
                'token' => $plainTextToken,
                'verified' => false,
                'message' => 'We have sent you an email to verify your account.'
            ]);
        }

        return response()->json([
            'token' => $plainTextToken,
            'verified' => true,
            'message' => 'User created successfully'
        ]);
    }

}
