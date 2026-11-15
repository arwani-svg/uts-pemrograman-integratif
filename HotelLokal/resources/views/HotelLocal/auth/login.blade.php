<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Masuk - HotelLokal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center h-screen font-sans">
    <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        <h2 class="text-2xl font-black text-blue-600 text-center mb-1">✈️ HotelLokal</h2>
        <p class="text-xs text-center text-gray-400 mb-6">Masuk untuk mulai memesan hotel</p>

        @if(session('error')) <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-xs font-semibold">{{ session('error') }}</div> @endif
        @if(session('success')) <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-xs font-semibold">{{ session('success') }}</div> @endif

        <form action="{{ route('hotellocal.login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Email</label>
                <input type="email" name="email" class="w-full p-3 border rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" class="w-full p-3 border rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl text-sm transition shadow">
                Masuk
            </button>
        </form>

        <p class="text-center text-xs text-gray-500 mt-6">
            Belum punya akun? <a href="{{ route('hotellocal.register') }}" class="text-blue-600 font-bold hover:underline">Daftar sekarang</a>
        </p>
    </div>
</body>
</html>