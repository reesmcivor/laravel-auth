<?php

namespace ReesMcIvor\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use ReesMcIvor\Auth\Http\Requests\Api\UserLoginRequest;
use ReesMcIvor\Auth\Models\TenantUser;
use ReesMcIvor\Auth\Notifications\Auth\VerifyEmail;
use ReesMcIvor\Auth\Services\AuthService;
use Illuminate\Http\JsonResponse;
use ReesMcIvor\Auth\Models\Modules;

class UserModulesController extends Controller {

    public function __invoke( Request $request ) : JsonResponse
    {
        $modules = Modules::with('features')->get();
        return response()->json([
            'modules' => $modules
        ]);
    }

}
