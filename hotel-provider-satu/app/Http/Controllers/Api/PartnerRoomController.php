<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class PartnerRoomController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'hotel_name' => 'Hotel Mandalika',
            'data' => Room::all()
        ], 200);
    }

    public function book(Request $request)
    {
        $room = Room::find($request->room_id);

        if (!$room || $room->stock <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, stok kamar di Hotel Mandalika sudah habis!'
            ], 400);
        }

        // Kurangi stok kamar hotel
        $room->decrement('stock');

        // Catat ke riwayat pemesanan hotel
        Booking::create([
            'room_id' => $room->id,
            'customer_name' => $request->customer_name ?? 'Tamu Traveloka',
            'source' => 'HotelLokal (Traveloka)',
            'check_in' => now(),
            'check_out' => now()->addDays(1),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan diterima oleh Hotel Mandalika dan stok diperbarui.'
        ], 200);
    }
}