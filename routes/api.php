<?php

use App\Http\Controllers\AppointmentContoller;
use App\Http\Controllers\AppointmentStatusContoller;
use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\DoctorContoller;
use App\Http\Controllers\SpecialtyContoller;
use App\Http\Controllers\UserContoller;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});


Route::post('loginAdmin', [AuthContoller::class, 'loginAdmin']);
Route::post('loginUser', [AuthContoller::class, 'loginUser']);

Route::resource('users', UserContoller::class);
Route::resource('doctors', DoctorContoller::class);
Route::resource('specializations', SpecialtyContoller::class);
Route::resource('appointments', AppointmentContoller::class);
Route::resource('appointment_statuses', AppointmentStatusContoller::class);

include (base_path('routes/appointments/appointments.php'));


