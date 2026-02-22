<?php

use App\BrowserApi\WorkspaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', function () {
    return response()->json(['message' => 'API is working']);
})->middleware('auth:auth0-api');

Route::post('workspaces', [WorkspaceController::class, 'create'])->middleware('auth:auth0-api');
