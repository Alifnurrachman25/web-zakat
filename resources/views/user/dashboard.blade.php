<x-app-layout>
    <div class="px-6 py-8 mx-auto max-w-7xl">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">
                Dashboard
            </h1>
            <p class="text-white/80">
                Selamat datang, <strong>{{ auth()->user()->name }}</strong>
            </p>
        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

            {{-- Zakat Hari Ini --}}
            <div class="p-6 bg-white border border-black rounded-lg shadow">
                <p class="text-sm text-gray-500">Zakat Hari Ini</p>
                <h2 class="mt-2 text-2xl font-bold text-green-600">
                    Rp {{ number_format($zakatHariIni) }}
                </h2>
            </div>

            {{-- Infaq Hari Ini --}}
            <div class="p-6 bg-white border border-black rounded-lg shadow">
                <p class="text-sm text-gray-500">Infaq Hari Ini</p>
                <h2 class="mt-2 text-2xl font-bold text-blue-600">
                    Rp {{ number_format($infaqHariIni) }}
                </h2>
            </div>

            {{-- Total Zakat --}}
            <div class="p-6 bg-white border border-black rounded-lg shadow">
                <p class="text-sm text-gray-500">Total Zakat</p>
                <h2 class="mt-2 text-2xl font-bold text-green-700">
                    Rp {{ number_format($zakatTotal) }}
                </h2>
            </div>

            {{-- Total Infaq --}}
            <div class="p-6 bg-white border border-black rounded-lg shadow">
                <p class="text-sm text-gray-500">Total Infaq</p>
                <h2 class="mt-2 text-2xl font-bold text-blue-700">
                    Rp {{ number_format($infaqTotal) }}
                </h2>
            </div>

            {{-- Jumlah Penerima --}}
            <div class="p-6 bg-white border border-black rounded-lg shadow">
                <p class="text-sm text-gray-500">Jumlah Penerima</p>
                <h2 class="mt-2 text-2xl font-bold text-purple-600">
                    {{ $jumlahPenerima }} Orang
                </h2>
            </div>

            {{-- Jumlah Pembayar --}}
            <div class="p-6 bg-white border border-black rounded-lg shadow">
                <p class="text-sm text-gray-500">Jumlah Pembayar</p>
                <h2 class="mt-2 text-2xl font-bold text-orange-600">
                    {{ $jumlahPembayar }} Orang
                </h2>
            </div>

        </div>

        {{-- Logout --}}
        <div class="mt-10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                    Logout
                </button>
            </form>
        </div>

    </div>
</x-app-layout>
