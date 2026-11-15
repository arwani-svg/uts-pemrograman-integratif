<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan - HotelLokal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <div class="max-w-xl mx-auto py-12 px-6">
        <a href="{{ route('hotellocal.index') }}" class="text-blue-600 font-bold text-sm hover:underline mb-6 inline-block">&larr; Kembali ke Beranda</a>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
            <h1 class="text-2xl font-extrabold text-gray-900 mb-2">Formulir Pemesanan Kamar</h1>
            <p class="text-xs text-gray-500 mb-6">Lengkapi data di bawah ini untuk memesan kamar dari sistem hotel terkait.</p>

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-xs font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Ringkasan Kamar yang Dipilih -->
            <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl mb-6">
                <h3 class="font-bold text-blue-900 text-lg">{{ $selectedRoom['hotel_name'] }}</h3>
                <p class="text-xs text-blue-700 mt-0.5">Tipe: <b>{{ $selectedRoom['room_type'] }}</b></p>
                <p class="text-blue-600 font-extrabold text-base mt-2">Rp {{ number_format($selectedRoom['price'], 0, ',', '.') }} <span class="text-xs font-normal text-gray-500">/ malam</span></p>
            </div>

            <!-- Form Input Pesanan -->
            <form action="{{ route('hotellocal.process') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="room_id" value="{{ $selectedRoom['id'] }}">
                <input type="hidden" name="target_port" value="{{ $targetPort }}">

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama Lengkap Pemesan</label>
                    <input type="text" name="customer_name" placeholder="Masukkan nama kamu" class="w-full p-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Tanggal Check-In</label>
                        <input type="date" name="check_in" class="w-full p-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Tanggal Check-Out</label>
                        <input type="date" name="check_out" class="w-full p-3 border rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl text-sm transition shadow-lg mt-4">
                    Konfirmasi & Bayar Pesanan
                </button>
            </form>
        </div>
    </div>

</body>
</html>