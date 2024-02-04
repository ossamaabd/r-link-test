<?php

use App\Http\Controllers\AppointmentUserRepoController;
use App\Http\Controllers\PopupController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:user')->prefix('appointment')->name('appointment.')->group(function(){
    Route::get('dispalyAppointmentsByUser', [AppointmentUserRepoController::class , 'dispalyAppointmentsByUser'])->name('dispalyAppointmentsByUser');
    Route::post('displayAppointmentsByAdmin', [AppointmentUserRepoController::class , 'displayAppointmentsByAdmin'])->name('displayAppointmentsByAdmin');
    Route::post('searchAppointmentsByAdmin', [AppointmentUserRepoController::class , 'searchAppointmentsByAdmin'])->name('searchAppointmentsByAdmin');
    Route::post('createAppointmentByUser', [AppointmentUserRepoController::class , 'createAppointmentByUser'])->name('createAppointmentByUser');


});
Route::middleware('AdminMiddleware')->prefix('appointment')->name('appointment.')->group(function(){
    Route::post('displayAppointmentsByAdmin', [AppointmentUserRepoController::class , 'displayAppointmentsByAdmin'])->name('displayAppointmentsByAdmin');
    Route::post('searchAppointmentsByAdmin', [AppointmentUserRepoController::class , 'searchAppointmentsByAdmin'])->name('searchAppointmentsByAdmin');
    Route::post('acceptOrRejectedAppointmentByDoctor', [AppointmentUserRepoController::class , 'acceptOrRejectedAppointmentByDoctor'])->name('acceptOrRejectedAppointmentByDoctor');
    Route::post('cancelAppointmentByUser', [AppointmentUserRepoController::class , 'cancelAppointmentByUser'])->name('cancelAppointmentByUser');


});
Route::middleware('DoctorMiddleware')->prefix('appointment')->name('appointment.')->group(function(){

    Route::post('acceptOrRejectedAppointmentByDoctor', [AppointmentUserRepoController::class , 'acceptOrRejectedAppointmentByDoctor'])->name('acceptOrRejectedAppointmentByDoctor');


});
