<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelLokal - Booking Hotel Terbaik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0875E1',
                        navy: '#102A43',
                        orange: '#FF8A00'
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[#F5F8FC] font-sans text-slate-800">

    <!-- NAVBAR -->
    <nav class="bg-white sticky top-0 z-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-5 lg:px-8 h-20 flex items-center justify-between">
            <a href="#" class="flex items-center gap-2">
                <div class="bg-blue-600 text-white w-10 h-10 rounded-xl flex items-center justify-center text-xl">✈
                </div>
                <span class="text-2xl font-extrabold tracking-tight text-slate-900">
                    Hotel<span class="text-blue-600">Lokal.</span>
                </span>
            </a>

            <div class="hidden md:flex items-center gap-9 text-sm font-semibold text-slate-600">
                <a href="#" class="text-blue-600">Beranda</a>
                <a href="#hotels" class="hover:text-blue-600">Jelajahi Hotel</a>
                <a href="#promo" class="hover:text-blue-600">Promo</a>
                <a href="#footer" class="hover:text-blue-600">Tentang Kami</a>
            </div>

            <div class="flex items-center gap-3">
                <a href="#hotels" class="hidden sm:block text-sm font-bold text-blue-600 px-4 py-2">Cari Hotel</a>
                <a href="#hotels"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 transition">
                    Pesan Sekarang
                </a>
            </div>

            <!-- Bagian kanan navbar di index.blade.php -->
            <div class="space-x-4 text-sm font-semibold flex items-center">
                <a href="{{ route('hotellocal.index') }}" class="text-gray-600 hover:text-blue-600">Beranda</a>

                @auth
                    <span class="text-blue-600 font-bold">Halo, {{ Auth::user()->name }}</span>
                    <form action="{{ route('hotellocal.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('hotellocal.login') }}"
                        class="text-blue-600 border border-blue-600 px-4 py-1.5 rounded-lg hover:bg-blue-50 transition">Masuk</a>
                    <a href="{{ route('hotellocal.register') }}"
                        class="bg-blue-600 text-white px-4 py-1.5 rounded-lg hover:bg-blue-700 transition">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="relative overflow-hidden bg-[#0C3B78]">
        <div class="absolute inset-0 opacity-30"
            style="background:linear-gradient(90deg,#082b55 0%,transparent 100%),url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?q=85&w=2000') center/cover;">
        </div>

        <div class="relative max-w-7xl mx-auto px-5 lg:px-8 pt-20 pb-36 lg:pt-28 lg:pb-44">
            <div class="max-w-2xl">
                <span
                    class="inline-flex items-center gap-2 bg-white/15 border border-white/20 text-white px-4 py-2 rounded-full text-xs font-bold mb-7">
                    ✨ PARTNER HOTEL TERPERCAYA
                </span>

                <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight">
                    Liburan Nyaman,<br>
                    <span class="text-yellow-400">Dimulai dari Sini.</span>
                </h1>

                <p class="text-blue-100 mt-6 text-base md:text-lg leading-relaxed max-w-xl">
                    Temukan hotel terbaik untuk perjalananmu. Harga menarik,
                    pilihan kamar beragam, dan pengalaman menginap yang berkesan.
                </p>

                <div class="flex flex-wrap gap-5 mt-8 text-white text-sm font-semibold">
                    <span>✓ Hotel pilihan</span>
                    <span>✓ Harga transparan</span>
                    <span>✓ Booking mudah</span>
                </div>
            </div>
        </div>
    </section>

    <!-- SEARCH PANEL -->
    <div class="max-w-7xl mx-auto px-5 lg:px-8 relative -mt-20 z-10">
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/70 p-5 lg:p-7">
            <div class="flex items-center gap-2 mb-5">
                <span class="text-xl">🔎</span>
                <h2 class="font-extrabold text-lg text-slate-900">Mau menginap di mana?</h2>
            </div>

            <form action="#hotels" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="border border-slate-200 rounded-xl px-4 py-3 hover:border-blue-500 transition">
                    <label class="text-xs text-slate-400 font-bold block mb-2">DESTINASI</label>
                    <input type="text" id="destination" placeholder="Kota atau nama hotel"
                        class="w-full outline-none text-sm font-semibold text-slate-700 bg-transparent">
                </div>

                <div class="border border-slate-200 rounded-xl px-4 py-3">
                    <label class="text-xs text-slate-400 font-bold block mb-2">CHECK-IN</label>
                    <input type="date"
                        class="w-full outline-none text-sm font-semibold text-slate-700 bg-transparent">
                </div>

                <div class="border border-slate-200 rounded-xl px-4 py-3">
                    <label class="text-xs text-slate-400 font-bold block mb-2">CHECK-OUT</label>
                    <input type="date"
                        class="w-full outline-none text-sm font-semibold text-slate-700 bg-transparent">
                </div>

                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white rounded-xl font-extrabold text-sm shadow-lg shadow-orange-100 transition">
                    🔍 Cari Hotel
                </button>
            </form>
            <p class="text-xs text-slate-400 mt-3">* Pencarian tanggal dan destinasi ini masih berupa tampilan UI.</p>
        </div>
    </div>

    <!-- PROMO -->
    <section id="promo" class="max-w-7xl mx-auto px-5 lg:px-8 pt-20">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 md:p-10 relative overflow-hidden">
            <div class="absolute -right-10 -top-20 w-72 h-72 rounded-full bg-white/10"></div>
            <div class="absolute right-32 -bottom-32 w-64 h-64 rounded-full bg-white/10"></div>

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div>
                    <span class="text-yellow-300 text-xs font-extrabold tracking-widest">SPECIAL OFFER</span>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-white mt-3">
                        Waktunya Liburan Lebih Hemat!
                    </h2>
                    <p class="text-blue-100 mt-3 text-sm">Temukan penginapan favorit dengan harga terbaik.</p>
                </div>
                <a href="#hotels"
                    class="bg-yellow-400 hover:bg-yellow-500 text-slate-900 px-7 py-4 rounded-xl font-extrabold text-sm whitespace-nowrap transition">
                    Jelajahi Hotel →
                </a>
            </div>
        </div>
    </section>

    <!-- HOTEL LIST -->
    <main id="hotels" class="max-w-7xl mx-auto px-5 lg:px-8 py-20">

        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl mb-8 font-semibold text-sm">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-9">
            <div>
                <span class="text-blue-600 font-extrabold text-xs tracking-widest">REKOMENDASI UNTUKMU</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-2">Temukan Penginapan Terbaik</h2>
                <p class="text-slate-500 text-sm mt-2">Pilihan hotel dan akomodasi dari mitra resmi kami.</p>
            </div>

            <span class="text-sm font-bold text-slate-500">🏨 Hotel pilihan HotelLokal</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">

            @forelse($rooms as $room)
                <article
                    class="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col">

                    <!-- HOTEL IMAGE -->
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=900"
                            alt="Hotel {{ $room['hotel_name'] }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                            loading="lazy">

                        <div
                            class="absolute top-4 left-4 bg-white/95 text-blue-600 text-xs font-extrabold px-3 py-2 rounded-lg shadow">
                            ✓ MITRA RESMI
                        </div>

                        <div
                            class="absolute bottom-4 right-4 bg-slate-900/80 text-white text-xs font-bold px-3 py-2 rounded-lg">
                            🏨 Hotel Pilihan
                        </div>
                    </div>

                    <!-- HOTEL INFO -->
                    <div class="p-6 flex flex-col flex-1">

                        <div class="flex items-start justify-between gap-2">
                            <h3 class="font-extrabold text-xl text-slate-900 leading-snug">
                                {{ $room['hotel_name'] }}
                            </h3>
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            🛏️ {{ $room['room_type'] }}
                        </p>

                        <div class="border-t border-dashed border-slate-200 my-5"></div>

                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-xs text-slate-400 font-medium">Harga mulai dari</p>
                                <p class="text-2xl font-extrabold text-blue-600 mt-1">
                                    Rp {{ number_format($room['price'], 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-slate-400 mt-1">/ kamar / malam</p>
                            </div>

                            <div class="text-right">
                                <span class="bg-green-50 text-green-700 px-3 py-2 rounded-lg text-xs font-extrabold">
                                    {{ $room['stock'] }} Tersedia
                                </span>
                            </div>
                        </div>

                        <div class="mt-auto">
                            @if ($room['stock'] > 0)
                                <a href="{{ route('hotellocal.form', $room['id']) }}"
                                    class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-extrabold text-sm shadow-lg shadow-blue-100 transition">
                                    Pesan Kamar Sekarang →
                                </a>
                            @else
                                <button disabled
                                    class="block w-full bg-slate-200 text-slate-500 py-3.5 rounded-xl font-bold text-sm cursor-not-allowed">
                                    Kamar Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </article>

            @empty

                <div class="col-span-full bg-white rounded-2xl border border-slate-100 p-14 text-center">
                    <div class="text-6xl mb-5">🏨</div>
                    <h3 class="text-xl font-extrabold text-slate-800">Belum Ada Hotel Tersedia</h3>
                    <p class="text-slate-500 text-sm mt-3">
                        Saat ini belum ada kamar dari API partner. Silakan cek kembali nanti.
                    </p>
                </div>
            @endforelse

        </div>
    </main>

    <!-- WHY HOTELLOKAL -->
    <section class="bg-white border-y border-slate-100 py-20">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-blue-600 text-xs font-extrabold tracking-widest">KENAPA HOTELLOKAL?</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-3">Pengalaman Booking Lebih Mudah</h2>
                <p class="text-slate-500 text-sm mt-3">Semua kebutuhan penginapan dalam satu platform.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-3xl mx-auto">🏨
                    </div>
                    <h3 class="font-extrabold text-lg mt-5">Pilihan Hotel</h3>
                    <p class="text-slate-500 text-sm mt-2 leading-relaxed">Beragam pilihan akomodasi dari mitra hotel
                        terpercaya.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center text-3xl mx-auto">
                        💰</div>
                    <h3 class="font-extrabold text-lg mt-5">Harga Transparan</h3>
                    <p class="text-slate-500 text-sm mt-2 leading-relaxed">Informasi harga kamar ditampilkan dengan
                        jelas.</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center text-3xl mx-auto">⚡
                    </div>
                    <h3 class="font-extrabold text-lg mt-5">Pemesanan Mudah</h3>
                    <p class="text-slate-500 text-sm mt-2 leading-relaxed">Proses pemesanan kamar yang praktis dan
                        sederhana.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="footer" class="bg-[#102A43] text-white pt-14 pb-8">
        <div class="max-w-7xl mx-auto px-5 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 pb-10">
                <div>
                    <h2 class="text-2xl font-extrabold">Hotel<span class="text-blue-400">Lokal.</span></h2>
                    <p class="text-slate-400 text-sm leading-relaxed mt-4 max-w-sm">
                        Temukan pengalaman menginap terbaik bersama HotelLokal.
                        Partner perjalananmu untuk menjelajahi berbagai destinasi.
                    </p>
                </div>

                <div>
                    <h3 class="font-bold mb-4">Navigasi</h3>
                    <div class="flex flex-col gap-3 text-sm text-slate-400">
                        <a href="#" class="hover:text-white">Beranda</a>
                        <a href="#hotels" class="hover:text-white">Daftar Hotel</a>
                        <a href="#promo" class="hover:text-white">Promo</a>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold mb-4">Informasi</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        HotelLokal Aggregator System<br>
                        Platform integrasi pemesanan hotel.
                    </p>
                </div>
            </div>

            <div class="border-t border-white/10 pt-7 text-center text-xs text-slate-500">
                © 2026 HotelLokal. All Rights Reserved. | Tugas Pemrograman Integratif.
            </div>
        </div>
    </footer>

</body>

</html>
