<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateOnceWithBasicAuth;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware(AuthenticateOnceWithBasicAuth::class)->group(function () {
    Route::get('/users', [UserController::class, 'index']);
});