<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Hotel Cinta Indah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    
    <!-- Navbar / Header -->
    <nav class="bg-blue-900 text-white shadow px-8 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <span class="font-bold text-lg">🏨 Hotel Cinta Indah (Admin)</span>
            <div class="space-x-3 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-800 px-3 py-1.5 rounded font-bold' : 'text-blue-200 hover:text-white' }}">Dashboard</a>
                <a href="{{ route('admin.rooms') }}" class="{{ request()->routeIs('admin.rooms') ? 'bg-blue-800 px-3 py-1.5 rounded font-bold' : 'text-blue-200 hover:text-white' }}">Manajemen Kamar</a>
                <a href="{{ route('admin.bookings') }}" class="{{ request()->routeIs('admin.bookings') ? 'bg-blue-800 px-3 py-1.5 rounded font-bold' : 'text-blue-200 hover:text-white' }}">List Booking Masuk</a>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1.5 rounded font-bold">Logout</button>
        </form>
    </nav>

    <!-- Content Body -->
    <main class="max-w-6xl mx-auto p-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-6 text-sm font-semibold">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

</body>
</html>