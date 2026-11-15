<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class HotelLocalController extends Controller
{
    // 1. Ambil data dari KEDUA hotel provider secara paralel/berurutan
    public function index(Request $request)
    {
        // Tembak API Hotel 1 (Port 8001)
        $responseHotel1 = Http::get('http://127.0.0.1:8001/api/partner/rooms');
        $roomsHotel1 = $responseHotel1->successful() ? $responseHotel1->json()['data'] ?? [] : [];

        // Tembak API Hotel 2 (Port 8002)
        $responseHotel2 = Http::get('http://127.0.0.1:8002/api/partner/rooms');
        $roomsHotel2 = $responseHotel2->successful() ? $responseHotel2->json()['data'] ?? [] : [];

        // Gabungkan (merge) data kamar dari kedua hotel ke dalam satu variabel
        $allRooms = array_merge($roomsHotel1, $roomsHotel2);

        return view('hotellocal.index', ['rooms' => $allRooms]);
    }

    // 2. Form Booking (Deteksi kamar milik hotel mana berdasarkan asal port/url atau penanda)
    public function showBookingForm($id, Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('hotellocal.login')->with('error', 'Kamu harus login terlebih dahulu sebelum memesan kamar!');
        }

        // Ambil data dari kedua hotel untuk dicocokkan ID-nya
        $res1 = Http::get('http://127.0.0.1:8001/api/partner/rooms');
        $rooms1 = $res1->successful() ? $res1->json()['data'] ?? [] : [];

        $res2 = Http::get('http://127.0.0.1:8002/api/partner/rooms');
        $rooms2 = $res2->successful() ? $res2->json()['data'] ?? [] : [];

        $allRooms = array_merge($rooms1, $rooms2);
        $selectedRoom = collect($allRooms)->firstWhere('id', (int)$id);

        if (!$selectedRoom) {
            return redirect('/')->with('error', 'Kamar tidak ditemukan.');
        }

        // Tentukan port tujuan berdasarkan data hotel (misal berdasarkan nama hotel atau penanda)
        // Cara paling mudah: cek apakah kamar ini milik Hotel Mandalika atau Hotel Provider 2
        $targetPort = (str_contains(strtolower($selectedRoom['hotel_name']), 'mandalika')) ? 8001 : 8002;

        return view('hotellocal.book-form', compact('selectedRoom', 'targetPort'));
    }

    // 3. Proses Booking (Diteruskan ke port hotel yang sesuai secara dinamis)
    public function processBooking(Request $request)
    {
        $request->validate([
            'room_id' => 'required|integer',
            'target_port' => 'required|integer', // Menerima port tujuan
            'customer_name' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
        ]);

        // Tentukan URL API hotel berdasarkan port yang dikirim dari form
        $targetApiUrl = "http://127.0.0.1:{$request->target_port}/api/partner/book";

        $response = Http::post($targetApiUrl, [
            'room_id' => $request->room_id,
            'customer_name' => $request->customer_name,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);

        if ($response->successful()) {
            return redirect('/')->with('success', 'Pesanan berhasil dikirim ke sistem hotel terkait!');
        }

        $errorMsg = $response->json()['message'] ?? 'Gagal memproses pemesanan.';
        return back()->with('error', $errorMsg);
    }
}