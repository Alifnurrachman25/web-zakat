<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zakat Masjid AL IKHLAS TBS2</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="text-gray-900 bg-gray-50">

    <nav class="flex items-center justify-between p-6 bg-white shadow-sm">
        <div class="text-xl font-bold text-emerald-600">
            🕌 AL IKHLAS TBS2
        </div>
        <div>
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-6 py-2 font-semibold text-white transition rounded-lg bg-emerald-600 hover:bg-emerald-700">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-emerald-600">Masuk</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-6 py-2 font-semibold text-white transition rounded-lg bg-emerald-600 hover:bg-emerald-700">
                                Daftar
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <main class="max-w-6xl px-6 mx-auto mt-20 text-center">
        <h1 class="text-5xl font-extrabold leading-tight text-gray-900 md:text-6xl">
            Website Pengelola Zakat <br>
            <span class="text-emerald-600">Masjid AL IKHLAS TBS2</span>
        </h1>
        <p class="max-w-2xl mx-auto mt-6 text-lg text-gray-600">
            Kelola zakat, infaq, dan sedekah dengan lebih transparan, aman, dan amanah untuk kemaslahatan umat di
            lingkungan TBS2.
        </p>

        <div class="flex justify-center gap-4 mt-10">
            @guest
                <a href="{{ route('login') }}"
                    class="px-8 py-3 text-lg font-bold text-white transition shadow-lg bg-emerald-600 rounded-xl shadow-emerald-200 hover:bg-emerald-700">
                    Mulai Berzakat Sekarang
                </a>
            @else
                <a href="{{ url('/dashboard') }}"
                    class="px-8 py-3 text-lg font-bold text-white transition shadow-lg bg-emerald-600 rounded-xl shadow-emerald-200 hover:bg-emerald-700">
                    Buka Dashboard Anda
                </a>
            @endguest
        </div>

        <div class="grid grid-cols-1 gap-8 mt-24 md:grid-cols-3">
            <div class="p-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
                <div class="mb-2 text-3xl">📊</div>
                <h3 class="text-xl font-bold">Transparan</h3>
                <p class="mt-2 text-gray-500">Laporan penyaluran dana dapat diakses oleh semua jamaah secara real-time.
                </p>
            </div>
            <div class="p-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
                <div class="mb-2 text-3xl">⚡</div>
                <h3 class="text-xl font-bold">Cepat</h3>
                <p class="mt-2 text-gray-500">Proses perhitungan zakat otomatis sesuai dengan ketentuan syariat.</p>
            </div>
            <div class="p-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
                <div class="mb-2 text-3xl">🤝</div>
                <h3 class="text-xl font-bold">Amanah</h3>
                <p class="mt-2 text-gray-500">Dikelola oleh pengurus masjid yang terverifikasi dan berpengalaman.</p>
            </div>
        </div>
    </main>

    <footer class="py-10 mt-32 text-sm text-center text-gray-400 border-t">
        &copy; {{ date('Y') }} Masjid AL IKHLAS TBS2. All rights reserved.
    </footer>

</body>

</html>
