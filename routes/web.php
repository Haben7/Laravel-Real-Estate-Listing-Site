<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\HouseController;



Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/owner', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
});


// User Management Routes

Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
    Route::get('/admin/properties', [AdminController::class, 'listOwners'])->name('admin.properties.owners');
    Route::get('/admin/properties/owners/{ownerId}/sites', [AdminController::class, 'ownerSites'])->name('admin.properties.site');
    
    Route::get('/admin/properties/site/{siteId}/houses', [AdminController::class, 'siteHouses'])->name('admin.properties.listhouse');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/owner/sites', [SiteController::class, 'index'])->name('sites.index');
    
    Route::get('/owner/sites/create', [SiteController::class, 'create'])->name('sites.create');

    Route::post('/owner/sites', [SiteController::class, 'store'])->name('sites.store');

    Route::get('/owner/sites/{site}/edit', [SiteController::class, 'edit'])->name('sites.edit');

    Route::put('/sites/{id}', [SiteController::class, 'update'])->name('sites.update');

    Route::delete('/sites/{id}', [SiteController::class, 'destroy'])->name('sites.destroy');


    Route::get('owner/houses/{site}', [HouseController::class, 'index'])->name('owner.houses.index');
    Route::get('owner/houses/create/{siteId}', [HouseController::class, 'create'])->name('owner.houses.create');
    Route::post('owner/houses/store/{siteId}', [HouseController::class, 'store'])->name('owner.houses.store');
    Route::get('owner/houses/{siteId}/{houseId}/edit', [HouseController::class, 'edit'])->name('owner.houses.edit');
    Route::put('owner/houses/{siteId}/{houseId}', [HouseController::class, 'update'])->name('owner.houses.update');

    Route::delete('owner/houses/{siteId}/{houseId}', [HouseController::class, 'destroy'])->name('owner.houses.destroy');

});










































// Admin dashboard - List of owners
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/properties', [AdminController::class, 'listOwners'])->name('admin.properties.owners');
//     Route::get('/admin/properties/owners/{ownerId}/properties', [AdminController::class, 'ownerProperties'])->name('admin.properties.owner-properties');
// });

//     Route::get('/owner/houses/create/{site}', [HouseController::class, 'create'])->name('owner.houses.create');
// Route::post('owner/houses/store/{site}', [HouseController::class, 'store'])->name('owner.houses.store');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/owner/{ownerId}/sites', [SiteController::class, 'index'])->name('sites.index');
//     Route::get('/owner/sites/create', [SiteController::class, 'create'])->name('sites.create');
//     Route::post('/owner/sites', [SiteController::class, 'store'])->name('owner.sites.store');

//     Route::get('/owner/sites/{id}/edit', [SiteController::class, 'edit'])->name('sites.edit');
//     Route::put('/owner/sites/{id}', [SiteController::class, 'update'])->name('owner.sites.update');
//     Route::delete('/owner/sites/{id}', [SiteController::class, 'destroy'])->name('sites.destroy');

//     // Route::get('/owner/sites/houses', [SiteController::class, 'index'])->name('houses.index');
//     Route::get('/owner/sites/houses/view/{id}', [SiteController::class, 'view'])->name('houses.view');
// });
// Route::resource('realestates', RealEstateController::class);
// Route::resource('realestates.sites', SiteController::class);
// Route::resource('sites.houses', HouseController::class);
// Route::resource('houses.images', ImageController::class);
// Route::middleware(['auth'])->group(function () {
//     Route::get('/owner/realestates', [RealEstateController::class, 'index'])->name('realestates.index');
//     Route::get('/owner/realestates/create', [RealEstateController::class, 'create'])->name('realestates.create');
//     Route::post('/owner/realestates', [RealEstateController::class, 'store'])->name('realestates.store');
//     Route::get('/owner/realestates/{id}/edit', [RealEstateController::class, 'edit'])->name('realestates.edit');
//     Route::put('/owner/realestates/{id}', [RealEstateController::class, 'update'])->name('realestates.update');
//     Route::delete('/owner/realestates/{id}', [RealEstateController::class, 'destroy'])->name('realestates.destroy');
// });
// Route::middleware(['auth'])->group(function () {
//     Route::get('/owner/sites', action: [SiteController::class, 'index'])->name('sites.index');
//     Route::get('/owner/sites/create/', [SiteController::class, 'create'])->name('sites.create');
//     // Route::post('/owner/sites', [SiteController::class, 'store'])->name('sites.store');
//     Route::post('/owner/sites/', [SiteController::class, 'store'])->name('sites.store');
//     Route::post('/owner/sites', [SiteController::class, 'store'])->name('owner.sites.store'); // Ensure this route is defined

//     Route::get('/owner/sites/{id}/edit', [SiteController::class, 'edit'])->name('sites.edit');
//     Route::put('/owner/sites/{id}', [SiteController::class, 'update'])->name('sites.update');
//     Route::delete('/owner/sites/{id}', [SiteController::class, 'destroy'])->name('sites.destroy');
// });
// Route::prefix('admin')->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('users.index'); // View all users
//     Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Create new user
//     Route::post('/users/store', [UserController::class, 'store'])->name('users.store'); // Store user
//     Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit'); // Edit user
//     Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update'); // Update user
//     Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Delete user
//     Route::get('/admin/properties', [AdminController::class, 'listOwners'])->name('admin.properties.owners');
//     Route::get('/admin/properties/owners/{ownerId}/properties', [AdminController::class, 'ownerProperties'])->name('admin.properties.site');

    
    
// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('/owner/properties', [PropertyController::class, 'index'])->name('properties.index');
//     Route::get('/owner/properties/create', [PropertyController::class, 'create'])->name('properties.create');
//     Route::post('/owner/properties', [PropertyController::class, 'store'])->name('properties.store');
//     Route::get('/owner/properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
//     Route::put('/owner/properties/{id}', [PropertyController::class, 'update'])->name('properties.update');
//     Route::delete('/owner/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
// });