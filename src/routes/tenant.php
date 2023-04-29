<?php

use Illuminate\Support\Facades\Route;

use ReesMcIvor\Auth\Http\Controllers\Api\ForgotPasswordController;
use ReesMcIvor\Auth\Http\Controllers\Api\LoginController;
use ReesMcIvor\Auth\Http\Controllers\Api\RegisterController;
use ReesMcIvor\Auth\Http\Controllers\Api\ResetPasswordController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::group([
    'middleware' => [
        'tenant',
        'api',
        PreventAccessFromCentralDomains::class
    ], // See the middleware group in Http Kernel
], function () {

    Route::post('user/forgot_password', ForgotPasswordController::class);
    Route::post('user/set_password', ResetPasswordController::class);
    Route::post('user/login', LoginController::class);
    Route::post('user/register', RegisterController::class);

});
