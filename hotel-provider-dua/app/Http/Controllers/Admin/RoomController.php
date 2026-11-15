<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // 1. Halaman Dashboard Utama
    public function dashboard()
    {
        $totalRooms = Room::sum('stock');
        $totalBookings = Booking::count();
        $recentBookings = Booking::with('room')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalRooms', 'totalBookings', 'recentBookings'));
    }

    // 2. Halaman Manajemen CRUD Kamar
    public function indexRooms()
    {
        $rooms = Room::all();
        return view('admin.rooms', compact('rooms'));
    }

    public function storeRoom(Request $request)
    {
        $request->validate([
            'room_type' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Room::create([
            'hotel_name' => 'Hotel Cinta Indah',
            'room_type' => $request->room_type,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return back()->with('success', 'Kamar baru berhasil ditambahkan.');
    }

    public function destroyRoom(Room $room)
    {
        $room->delete();
        return back()->with('success', 'Kamar berhasil dihapus.');
    }

    // 3. Halaman Khusus List Booking Masuk
    public function indexBookings()
    {
        $bookings = Booking::with('room')->latest()->get();
        return view('admin.bookings', compact('bookings'));
    }
}