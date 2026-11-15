@extends('admin.layouts.app')

@section('title', 'List Booking Masuk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-extrabold text-gray-800">Log Pesanan Masuk</h2>
        <p class="text-xs text-gray-500 mt-1">Daftar lengkap pesanan yang masuk melalui integrasi API Traveloka secara real-time.</p>
    </div>
    <div class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-lg border border-blue-200">
        Total Transaksi: {{ count($bookings) }} Pesanan
    </div>
</div>

<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 overflow-x-auto">
    <table class="w-full border-collapse text-sm">
        <thead>
            <tr class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500 border-b">
                <th class="p-3">ID Booking</th>
                <th class="p-3">Waktu Transaksi</th>
                <th class="p-3">Nama Tamu</th>
                <th class="p-3">Tipe Kamar</th>
                <th class="p-3">Check-In / Out</th>
                <th class="p-3">Harga Kamar</th>
                <th class="p-3">Sumber</th>
                <th class="p-3 text-center">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($bookings as $booking)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-3 font-mono text-xs text-blue-600 font-bold">#BK-{{ $booking->id }}</td>
                    <td class="p-3 text-xs text-gray-500">{{ $booking->created_at->format('d M Y, H:i') }}</td>
                    <td class="p-3 font-bold text-gray-800">{{ $booking->customer_name }}</td>
                    <td class="p-3">
                        <span class="font-semibold text-gray-700">{{ $booking->room->room_type ?? 'Kamar Dihapus' }}</span>
                    </td>
                    <td class="p-3 text-xs text-gray-600">
                        <div class="font-medium text-gray-800">{{ $booking->check_in }}</div>
                        <div class="text-gray-400">s/d {{ $booking->check_out }}</div>
                    </td>
                    <td class="p-3 font-bold text-blue-600">
                        @if($booking->room)
                            Rp {{ number_format($booking->room->price, 0, ',', '.') }}
                        @else
                            <span class="text-gray-400 font-normal">-</span>
                        @endif
                    </td>
                    <td class="p-3">
                        <span class="bg-purple-50 text-purple-700 text-xs px-2.5 py-1 rounded-full font-bold border border-purple-100">{{ $booking->source }}</span>
                    </td>
                    <td class="p-3 text-center">
                        <span class="bg-green-50 text-green-700 text-xs px-2.5 py-1 rounded-full font-bold border border-green-100">{{ ucfirst($booking->status) }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="p-8 text-center text-gray-400 text-sm">
                        Belum ada pesanan yang masuk dari Traveloka.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection