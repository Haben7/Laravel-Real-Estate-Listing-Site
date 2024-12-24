<?php
use App\Http\Middleware\RoleMiddleware; 

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\EmailController;




Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// admin route
Route::middleware(['auth', 'user-access:admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
    Route::get('/admin/properties', [AdminController::class, 'listOwners'])->name('admin.properties.owners');
    Route::get('/admin/properties/owners/{ownerId}/sites', [AdminController::class, 'ownerSites'])->name('admin.properties.site');
    
    Route::get('/admin/properties/site/{siteId}/houses', [AdminController::class, 'siteHouses'])->name('admin.properties.listhouse');
    Route::get('/sites/create/{siteId?}', [AdminController::class, 'siteCreate'])->name('properties.sitecreate');
    Route::post('/sites/store', [AdminController::class, 'storeSite'])->name('sites.store');
    
    Route::get('owner/houses/{site}', [AdminController::class, 'index'])->name('admin.properties.all');
    Route::get('admin/properties/housecreate/{siteId}', [AdminController::class, 'create'])->name('admin.properties.housecreate');
    Route::post('admin/properties/store/{siteId}', [AdminController::class, 'store'])->name('admin.properties.store');
    Route::get('admin/properties/{siteId}/{houseId}/edit', [AdminController::class, 'edit'])->name('admin.properties.houseedit');
    Route::put('admin/properties/{siteId}/{houseId}', [AdminController::class, 'update'])->name('admin.properties.update');
    // Route::get('/admin/setting', [AdminController::class, 'setting'])->name('admin.setting');
    Route::get('/admin/setting', [AdminController::class, 'showSettingForm'])->name('admin.setting.form');

    Route::put('/admin/setting', [AdminController::class, 'setting'])->name('admin.setting.update');

    Route::get('/chart', [AdminController::class, 'chart'])->name('admin.chart');
Route::get('/table', [AdminController::class, 'table'])->name('admin.table');

    Route::get('/sites/chart', [SiteController::class, 'sitesPerYear'])->name('sites.perYear');
Route::view('/sites/bar-graph', 'owner.sites.chart')->name('sites.chart');





});

//owner route
Route::middleware(['auth', 'user-access:owner'])->group(function(){
    Route::get('/owner', [OwnerController::class, 'dashboard'])->name('owner.index');
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
    
    Route::get('/owner/setting', [OwnerController::class, 'showSettingForm'])->name('owner.setting.form');

   

Route::put('/owner/setting', [OwnerController::class, 'update'])->name('owner.setting.update');
Route::get('/owner/chat', [OwnerController::class, 'chat'])->name('owner.emails.userToOwner');
Route::post('/send-email', [EmailController::class, 'sendEmailToOwner']);

Route::post('/reply-email', [EmailController::class, 'replyEmail'])->name('reply.email');
Route::get('/sites-per-year', [SiteController::class, 'sitesPerYearForOwner'])->name('sites.perYearForOwner');
Route::get('/charts', [OwnerController::class, 'chart'])->name('owner.chart');
Route::get('/tables', [OwnerController::class, 'table'])->name('owner.table');
});

