<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\BookingController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/list', [BookingController::class, 'index'])->name('bookings.list');
Route::get('/show/{id}', [BookingController::class, 'show'])->name('bookings.show');
Route::get('/create', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/store', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/edit/{id}', [BookingController::class, 'edit'])->name('bookings.edit');
Route::put('/update/{id}', [BookingController::class, 'update'])->name('bookings.update');
Route::delete('/delete/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');

