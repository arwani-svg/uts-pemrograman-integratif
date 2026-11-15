<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Sistem Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10 font-sans">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">🏨 Dashboard Admin Sistem Hotel (Internal)</h1>
        
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">{{ session('success') }}</div>
        @endif

        <!-- Form Tambah Kamar -->
        <form action="{{ route('rooms.store') }}" method="POST" class="bg-gray-50 p-4 rounded-lg mb-6 border grid grid-cols-1 md:grid-cols-5 gap-3">
            @csrf
            <input type="text" name="hotel_name" placeholder="Nama Hotel" class="p-2 border rounded text-sm" required>
            <input type="text" name="room_type" placeholder="Tipe Kamar" class="p-2 border rounded text-sm" required>
            <input type="number" name="price" placeholder="Harga (Rp)" class="p-2 border rounded text-sm" required>
            <input type="number" name="stock" placeholder="Stok Kamar" class="p-2 border rounded text-sm" required>
            <button type="submit" class="bg-blue-600 text-white rounded text-sm font-bold hover:bg-blue-700">Tambah Kamar</button>
        </form>

        <!-- Tabel Daftar Kamar -->
        <table class="w-full border-collapse border border-gray-200 text-sm">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Nama Hotel</th>
                    <th class="border p-2">Tipe Kamar</th>
                    <th class="border p-2">Harga</th>
                    <th class="border p-2">Stok</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td class="border p-2">{{ $room->hotel_name }}</td>
                        <td class="border p-2">{{ $room->room_type }}</td>
                        <td class="border p-2">Rp {{ number_format($room->price, 0, ',', '.') }}</td>
                        <td class="border p-2 font-bold text-green-600">{{ $room->stock }}</td>
                        <td class="border p-2 text-center">
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Hapus kamar ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 font-bold hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>