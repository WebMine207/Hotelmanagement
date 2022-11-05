<?php

use App\Http\Controllers\web\BookingController;
use App\Http\Controllers\web\DashboardController;
use App\Http\Controllers\web\HotelController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| role 1=admin,2 = hotel manager
*/


Route::middleware('auth')->group(function (){

    Route::get('/', [DashboardController::class, 'index'])->name('/');
    Route::get("dashboard", [DashboardController::class, 'index'])->name("dashboard");

    
    Route::get("profile",[ProfileController::class,'index'])->name('profile.index');
    Route::post("profile/update",[ProfileController::class,'update'])->name('profile.update');

    Route::get("change_password",[ProfileController::class,'password_index'])->name('password.index');
    Route::post("change_password/update",[ProfileController::class,'password_update'])->name('password.update');

    Route::get('bookings', [BookingController::class, "index"])->name('booking.index');

    Route::middleware('role:1')->group(function () {
        Route::resource('users', UserController::class);
        Route::post('users/lists', [UserController::class, "lists"])->name('users.lists');
        Route::post('users/update_status', [UserController::class, "update_status"])->name('users.update_status');

        Route::resource('hotels', HotelController::class);
        Route::post('hotels/lists', [HotelController::class, "lists"])->name('hotels.lists');
        Route::post('hotels/update_status', [HotelController::class, "update_status"])->name('hotels.update_status');
    });


    Route::middleware('role:2')->group(function () {
    });
});
Auth::routes();
