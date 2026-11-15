<?php

use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Api\PartnerRoomController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect('/login');
});

// Auth Routes (Tanpa Breeze)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Protected Routes dengan Middleware Kustom
Route::middleware(['admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [RoomController::class, 'dashboard'])->name('dashboard');

    // Menu Manajemen Kamar
    Route::get('/rooms', [RoomController::class, 'indexRooms'])->name('rooms');
    Route::post('/rooms', [RoomController::class, 'storeRoom'])->name('rooms.store');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroyRoom'])->name('rooms.destroy');

    // Menu List Booking Masuk
    Route::get('/bookings', [RoomController::class, 'indexBookings'])->name('bookings');
});

// Redirect root ke login



Route::get('/partner/rooms', [PartnerRoomController::class, 'index']);
Route::post('/partner/book', [PartnerRoomController::class, 'book']);