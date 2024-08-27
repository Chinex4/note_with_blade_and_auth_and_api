<?php

use App\Http\Controllers\Api\NoteApiController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('/note', NoteApiController::class);
// Route::post('/register', AuthController::class, 'register');
// Route::post('/login', AuthController::class, 'login');
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');

    Route::get('/profile', 'profile')->middleware('auth:sanctum');
    Route::get('/logout', 'logout')->middleware('auth:sanctum');
    Route::delete('/profile', 'deleteProfile')->middleware('auth:sanctum');
});
