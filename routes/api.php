<?php
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\HouseController;
use App\Http\Controllers\Api\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

Route::get('/houses/search', [HouseController::class, 'search'])->name('houses.search');

Route::get('/houses/city/{cityName}', [HouseController::class, 'getHousesByCity'])->name('houses.city');

Route::apiResource('houses', PropertyController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cities', [CityController::class, 'index']);

// User sign-up (registration)
Route::post('user/register', [UserController::class, 'register']);

// User log-in
Route::post('user/login', [UserController::class, 'login']);

Route::post('/user/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/user/{userId}', [UserController::class, 'update']);

    Route::delete('/user/{id}', [UserController::class, 'destroy']); 
});

Route::middleware(['simple_cors'])->group(function () {
    Route::put('/user/{id}', [UserController::class, 'update']);
});

Route::post('/send-email', [EmailController::class, 'sendEmailToOwner']);

