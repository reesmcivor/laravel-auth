<?php

use Illuminate\Support\Facades\Route;

use ReesMcIvor\Auth\Http\Controllers\Api\ForgotPasswordController;
use ReesMcIvor\Auth\Http\Controllers\Api\LoginController;
use ReesMcIvor\Auth\Http\Controllers\Api\RegisterController;
use ReesMcIvor\Auth\Http\Controllers\Api\ResetPasswordController;
use ReesMcIvor\Auth\Http\Controllers\Api\NewPasswordController;
use ReesMcIvor\Auth\Http\Controllers\Api\VerifyEmailController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'api',
    InitializeTenancyByDomainOrSubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::prefix('api/user')->name("api.user.")->group(function() {
        Route::post('forgot_password', ForgotPasswordController::class);
        Route::post('set_password', ResetPasswordController::class)->name("set-password");
        Route::post('new_password', NewPasswordController::class)->name("new-password");
        Route::any('login', LoginController::class);
        Route::post('register', RegisterController::class);
    });

});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('email/verify/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('user.verify_email');
});


Route::middleware('api')->prefix('api')->group(function () {
    Route::get('user/modules', \ReesMcIvor\Auth\Http\Controllers\Api\UserModulesController::class);
    Route::get('user/lookup', \ReesMcIvor\Auth\Http\Controllers\Api\LookupUserController::class);
});
