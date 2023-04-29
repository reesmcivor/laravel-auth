<?php

namespace ReesMcIvor\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use Laravel\Fortify\Fortify;

class ResetPasswordController extends Controller
{
    public function __invoke( Request $request )
    {
        $broker = Password::broker(config('fortify.passwords'));
        $status = $broker->reset(
            $request->only(Fortify::email(), 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                app(ResetsUserPasswords::class)->reset($user, $request->all());
                return response(['message' => 'Successfully changed password'], 200);
            }
        );

        return $status == Password::PASSWORD_RESET ?
            response(['message' => 'Successfully changed password'], 200) :
            response(['message' => 'Unable to change password'], 422);
    }
}
