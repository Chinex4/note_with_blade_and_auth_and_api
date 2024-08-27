<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NoteApiController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

<<<<<<< HEAD
Route::apiResource('/note', NoteApiController::class);
// Route::post('/register', AuthController::class, 'register');
// Route::post('/login', AuthController::class, 'login');
Route::controller(AuthController::class)->group(function () {
=======
Route::apiResource('/notes', NoteApiController::class);
// Route::post('/register', [AuthController::class, 'register']);
Route::controller(AuthController::class)->group(function(){
>>>>>>> 13b28941b16e9ca251826169742fb9a4c84e35e9
    Route::post('/register', 'register');
    Route::post('/login', 'login');

    Route::get('/profile', 'profile')->middleware('auth:sanctum');
    Route::get('/logout', 'logout')->middleware('auth:sanctum');
<<<<<<< HEAD
    Route::delete('/profile', 'deleteProfile')->middleware('auth:sanctum');
=======
>>>>>>> 13b28941b16e9ca251826169742fb9a4c84e35e9
});
