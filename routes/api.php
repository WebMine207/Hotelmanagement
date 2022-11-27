<?php

use App\Http\Controllers\api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login',[UsersController::class,"login"])->name('users.login');
Route::post('otp_verification',[UsersController::class,"otp_verification"])->name('users.otp_verification');
Route::post('resend_otp',[UsersController::class,"resend_otp"])->name('users.resend_otp');
Route::group(['middleware' => 'auth:api'], function(){
Route::get('get_profile',[UsersController::class,"get_profile"])->name('users.get_profile');
Route::post('update_user_details',[UsersController::class,"update_user_details"])->name('users.update_user_details');
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
