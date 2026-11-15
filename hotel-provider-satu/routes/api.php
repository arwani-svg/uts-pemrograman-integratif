<?php

use App\Http\Controllers\Api\PartnerRoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Endpoint yang akan ditembak oleh Traveloka
Route::get('/partner/rooms', [PartnerRoomController::class, 'index']);
Route::post('/partner/book', [PartnerRoomController::class, 'book']);