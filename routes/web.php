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

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('home');

    Route::get("profile",[ProfileController::class,'index'])->name('profile.index');
    Route::post("profile/update",[ProfileController::class,'update'])->name('profile.update');

    Route::get("change_password",[ProfileController::class,'password_index'])->name('password.index');
    
    Route::resource('users', UserController::class)->name('users');
});
Auth::routes();
