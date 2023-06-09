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

class LookupUserController extends Controller {

    public function __invoke( Request $request ) : JsonResponse
    {
        $this->validate($request, [
            'email' => 'exists:tenant_users'
        ]);

        $tenant = TenantUser::where('email', $request->get('email'))->get()->first();
        tenancy()->initialize($tenant->tenant_id);

        return response()->json([
            'domain' => tenant()->domain,
        ]);
    }

}
