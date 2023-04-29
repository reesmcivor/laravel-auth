<?php

namespace ReesMcIvor\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        return \App\Actions\User\GetUser::make($user)->jsonResponse($user);
    }
}
