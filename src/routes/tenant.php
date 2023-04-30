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
    Route::post('user/forgot_password', ForgotPasswordController::class);
    Route::post('user/set_password', ResetPasswordController::class);
    Route::post('user/login', LoginController::class);
    Route::post('api/user/register', RegisterController::class);
});
