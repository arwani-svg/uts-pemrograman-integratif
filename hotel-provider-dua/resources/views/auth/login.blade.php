<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Login - Hotel Cinta Indah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen font-sans">
    <div class="max-w-md w-full bg-white p-8 rounded-xl shadow-lg border">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">🏨 Hotel Cinta Indah</h2>
        <p class="text-xs text-center text-gray-500 mb-6">Sistem Manajemen Internal & API Provider</p>

        @if(session('error')) <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-xs">{{ session('error') }}</div> @endif
        @if($errors->any()) <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-xs">{{ $errors->first() }}</div> @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1">Email Admin</label>
                <input type="email" name="email" value="admin@cintaindah.com" class="w-full p-2.5 border rounded text-sm" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1">Password</label>
                <input type="password" name="password" value="password123" class="w-full p-2.5 border rounded text-sm" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 rounded text-sm transition">
                Masuk ke Dashboard
            </button>
        </form>
    </div>
</body>
</html>