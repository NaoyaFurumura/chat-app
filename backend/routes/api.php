<?php

use App\BrowserApi\UsersController;
use Illuminate\Support\Facades\Route;


Route::get('test', function () {
    return response()->json(['message' => 'API is working']);
})->middleware('auth:auth0-api');



Route::middleware('auth:auth0-api')->group(function () {
    Route::get('me', [UsersController::class, 'getMe']);
    Route::prefix('users')->group(function(){
        Route::post('/', [UsersController::class, 'create']);
    });
});
