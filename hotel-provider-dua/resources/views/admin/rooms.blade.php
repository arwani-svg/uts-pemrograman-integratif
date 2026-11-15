@extends('admin.layouts.app')

@section('title', 'Manajemen Kamar')

@section('content')
<h2 class="text-2xl font-extrabold text-gray-800 mb-6">Manajemen Kamar Hotel Cinta Indah</h2>

<!-- Form Tambah Kamar -->
<form action="{{ route('admin.rooms.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow border mb-8 grid grid-cols-1 md:grid-cols-4 gap-4">
    @csrf
    
    <div>
        <label class="block text-xs font-bold text-gray-600 mb-1">Tipe Kamar</label>
        <input type="text" name="room_type" placeholder="Deluxe / Suite" class="w-full p-2.5 border rounded text-sm" required>
    </div>
    <div>
        <label class="block text-xs font-bold text-gray-600 mb-1">Harga per Malam</label>
        <input type="number" name="price" placeholder="Contoh: 500000" class="w-full p-2.5 border rounded text-sm" required>
    </div>
    <div>
        <label class="block text-xs font-bold text-gray-600 mb-1">Stok Kamar</label>
        <input type="number" name="stock" placeholder="Contoh: 10" class="w-full p-2.5 border rounded text-sm" required>
    </div>
    <div class="flex items-end">
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 rounded text-sm transition">Tambah Kamar</button>
    </div>
</form>

<!-- Tabel Daftar Kamar -->
<div class="bg-white p-6 rounded-xl shadow border">
    <h3 class="font-bold text-lg text-gray-800 mb-4">Daftar Kamar Aktif</h3>
    <table class="w-full border-collapse border border-gray-200 text-sm">
        <thead>
            <tr class="bg-gray-50 text-left">
                <th class="border p-2.5">Nama Hotel</th>
                <th class="border p-2.5">Tipe Kamar</th>
                <th class="border p-2.5">Harga</th>
                <th class="border p-2.5">Stok</th>
                <th class="border p-2.5 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td class="border p-2.5">{{ $room->hotel_name }}</td>
                    <td class="border p-2.5 font-semibold">{{ $room->room_type }}</td>
                    <td class="border p-2.5">Rp {{ number_format($room->price, 0, ',', '.') }}</td>
                    <td class="border p-2.5 font-bold text-green-600">{{ $room->stock }} Kamar</td>
                    <td class="border p-2.5 text-center">
                        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Hapus kamar ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 font-bold hover:underline text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection