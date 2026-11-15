<?php

use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\HotelLocalController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [HotelLocalController::class, 'index'])->name('hotellocal.index');


// Auth Customer HotelLokal
Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('hotellocal.login');
Route::post('/login', [CustomerAuthController::class, 'login'])->name('hotellocal.login.post');
Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('hotellocal.register');
Route::post('/register', [CustomerAuthController::class, 'register'])->name('hotellocal.register.post');
Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('hotellocal.logout');


Route::get('/room/{id}/book', [HotelLocalController::class, 'showBookingForm'])->name('hotellocal.form');
Route::post('/room/book/process', [HotelLocalController::class, 'processBooking'])->name('hotellocal.process');