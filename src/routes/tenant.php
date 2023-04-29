<?php

use Illuminate\Support\Facades\Route;

use ReesMcIvor\Auth\Http\Controllers\Api\User\ForgotPasswordController;
use ReesMcIvor\Auth\Http\Controllers\Api\User\LoginController;
use ReesMcIvor\Auth\Http\Controllers\Api\User\RegisterController;
use ReesMcIvor\Auth\Http\Controllers\Api\User\ResetPasswordController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::group([
    'middleware' => ['tenant', PreventAccessFromCentralDomains::class], // See the middleware group in Http Kernel
], function () {

    Route::post('user/forgot_password', ForgotPasswordController::class);
    Route::post('user/set_password', ResetPasswordController::class);
    Route::post('user/login', LoginController::class);
    Route::post('user/register', RegisterController::class);

});
