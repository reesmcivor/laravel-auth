<?php

namespace ReesMcIvor\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use ReesMcIvor\Auth\Http\Requests\Api\NewPasswordRequest;

class NewPasswordController extends Controller
{

    public function __invoke(NewPasswordRequest $request)
    {
        auth()->user()->update([
            'password' => Hash::make($request->get("password")),
        ]);

        return response()->json([
            'message' => 'Password updated successfully.',
        ]);
    }

}
