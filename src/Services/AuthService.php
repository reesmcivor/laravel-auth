<?php

namespace ReesMcIvor\Auth\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService {

    const PASSWORD_LENGTH = 8;

    public function resetUserPassword( User $user) : string
    {
        $password = Str::random( self::PASSWORD_LENGTH );
        $user->password = Hash::make( $password );
        $user->save();
        return $password;
    }

    public function userExists( string $email ) : bool
    {
        return User::where('email', $email)->exists();
    }

    public function login($request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if ( $user && Hash::check( $request->get('password'), $user->password) ) {
            return $user;
        }
    }

    public function createUserToken($user, $deviceName)
    {
        return $user->createToken($deviceName)?->plainTextToken;
    }

}
