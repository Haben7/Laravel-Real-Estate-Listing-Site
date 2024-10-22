<?php
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\HouseController;
use App\Http\Controllers\Api\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Search route for houses (needs to come before the resource route)
Route::get('/houses/search', [HouseController::class, 'search'])->name('houses.search');

// Route for fetching houses by city
Route::get('/houses/city/{cityName}', [HouseController::class, 'getHousesByCity'])->name('houses.city');

// API resource for houses (index, show, store, update, destroy)
Route::apiResource('houses', PropertyController::class);

// Route for fetching user data
Route::get('/user', function (Request $request) {
    return $request->user();
});

// Route for fetching cities
Route::get('/cities', [CityController::class, 'index']);

// User sign-up (registration)
Route::post('user/register', [UserController::class, 'register']);

// User log-in
Route::post('user/login', [UserController::class, 'login']);