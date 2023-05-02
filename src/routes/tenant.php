<?php

use Illuminate\Support\Facades\Route;

use ReesMcIvor\Auth\Http\Controllers\Api\ForgotPasswordController;
use ReesMcIvor\Auth\Http\Controllers\Api\LoginController;
use ReesMcIvor\Auth\Http\Controllers\Api\RegisterController;
use ReesMcIvor\Auth\Http\Controllers\Api\ResetPasswordController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'api',
    \Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::prefix('api/user')->group(function() {
        Route::post('forgot_password', ForgotPasswordController::class);
        Route::post('set_password', ResetPasswordController::class);
        Route::any('login', LoginController::class);
        Route::post('register', RegisterController::class);
    });
});
