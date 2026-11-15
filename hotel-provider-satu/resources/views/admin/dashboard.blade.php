@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2 class="text-2xl font-extrabold text-gray-800 mb-6">Ringkasan Sistem</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow border">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Sisa Stok Kamar</p>
        <h3 class="text-3xl font-extrabold text-blue-900 mt-2">{{ $totalRooms }} Kamar</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow border">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pesanan Masuk (Traveloka)</p>
        <h3 class="text-3xl font-extrabold text-green-600 mt-2">{{ $totalBookings }} Pesanan</h3>
    </div>
</div>

<div class="bg-white p-6 rounded-xl shadow border">
    <h3 class="font-bold text-lg text-gray-800 mb-4">5 Pesanan Terakhir Masuk</h3>
    <table class="w-full border-collapse border border-gray-200 text-sm">
        <thead>
            <tr class="bg-gray-50 text-left">
                <th class="border p-2.5">Waktu</th>
                <th class="border p-2.5">Nama Tamu</th>
                <th class="border p-2.5">Kamar</th>
                <th class="border p-2.5">Sumber</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentBookings as $b)
                <tr>
                    <td class="border p-2.5 text-xs text-gray-500">{{ $b->created_at }}</td>
                    <td class="border p-2.5 font-semibold">{{ $b->customer_name }}</td>
                    <td class="border p-2.5">{{ $b->room->room_type ?? 'Kamar Dihapus' }}</td>
                    <td class="border p-2.5"><span class="bg-purple-100 text-purple-700 text-xs px-2 py-0.5 rounded font-bold">{{ $b->source }}</span></td>
                </tr>
            @empty
                <tr><td colspan="4" class="border p-4 text-center text-gray-400 text-xs">Belum ada pesanan masuk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection