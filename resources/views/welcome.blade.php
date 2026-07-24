<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Bengkel</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col justify-between">

    <!-- NAV BAR (Tombol Login & Register di Pojok Kanan Atas) -->
    <nav class="w-full bg-white shadow-sm p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <!-- Logo + Nama Aplikasi -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Bengkel" class="h-10 w-10 object-contain rounded-lg">
                <h1 class="text-xl font-bold text-gray-800">Bengkel App</h1>
            </div>

            <!-- Tombol Auth di Pojok Kanan -->
            <div class="flex gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA (Tengah) -->
    <main class="flex-grow flex items-center justify-center p-6 text-center">
        <div class="max-w-2xl bg-white p-10 rounded-xl shadow-md flex flex-col items-center">
            
            <!-- Logo Besar -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo Bengkel" class="h-28 w-28 object-contain mb-6">

            <h2 class="text-3xl font-extrabold text-gray-900 mb-3">Selamat Datang di Sistem Informasi Bengkel</h2>
            <p class="text-gray-600 leading-relaxed">Kelola data pelanggan, kendaraan, transaksi servis, dan mekanisme bengkel dengan mudah dan cepat.</p>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="text-center py-4 text-sm text-gray-500">
        &copy; {{ date('Y') }} Sistem Informasi Bengkel. All rights reserved.
    </footer>

</body>
</html>