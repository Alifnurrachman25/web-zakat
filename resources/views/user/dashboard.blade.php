<x-app-layout>
    <div class="px-6 py-8 mx-auto max-w-7xl">

        {{-- Header --}}
        <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Dashboard
                </h1>
                <p class="text-white/80">
                    Selamat datang, <strong>{{ auth()->user()->name }}</strong>
                </p>
            </div>

            <a href="{{ route('export.lengkap') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition rounded-lg shadow bg-emerald-600 hover:bg-emerald-700">
                📊 Export Laporan Lengkap
            </a>
        </div>

        {{-- STATISTIK UTAMA --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

            {{-- ZAKAT HARI INI --}}
            <div class="p-6 bg-white border shadow rounded-xl">
                <p class="text-sm text-gray-500">Zakat Hari Ini</p>
                <div class="mt-3 space-y-1">
                    <p class="text-lg font-bold text-green-600">
                        Rp {{ number_format($zakatHariIniTunai, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ number_format($zakatHariIniBeras, 0, ',', '.') }} Kg Beras
                    </p>
                </div>
            </div>

            {{-- INFAQ HARI INI --}}
            <div class="p-6 bg-white border shadow rounded-xl">
                <p class="text-sm text-gray-500">Infaq Hari Ini</p>
                <div class="mt-3 space-y-1">
                    <p class="text-lg font-bold text-blue-600">
                        Rp {{ number_format($infaqHariIniTunai, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ number_format($infaqHariIniBeras, 0, ',', '.') }} Kg Beras
                    </p>
                </div>
            </div>

            {{-- TOTAL ZAKAT --}}
            <div class="p-6 bg-white border shadow rounded-xl">
                <p class="text-sm text-gray-500">Total Zakat</p>
                <div class="mt-3 space-y-1">
                    <p class="text-lg font-bold text-green-700">
                        Rp {{ number_format($zakatTotalTunai, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ number_format($zakatTotalBeras, 0, ',', '.') }} Kg Beras
                    </p>
                </div>
            </div>

            {{-- TOTAL INFAQ --}}
            <div class="p-6 bg-white border shadow rounded-xl">
                <p class="text-sm text-gray-500">Total Infaq</p>
                <div class="mt-3 space-y-1">
                    <p class="text-lg font-bold text-blue-700">
                        Rp {{ number_format($infaqTotalTunai, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ number_format($infaqTotalBeras, 0, ',', '.') }} Kg Beras
                    </p>
                </div>
            </div>

            {{-- JUMLAH PENERIMA --}}
            <div class="p-6 bg-white border shadow rounded-xl">
                <p class="text-sm text-gray-500">Jumlah Penerima</p>
                <h2 class="mt-3 text-2xl font-bold text-purple-600">
                    {{ $jumlahPenerima }} Orang
                </h2>
            </div>

            {{-- JUMLAH PEMBAYAR --}}
            <div class="p-6 bg-white border shadow rounded-xl">
                <p class="text-sm text-gray-500">Jumlah Pembayar</p>
                <h2 class="mt-3 text-2xl font-bold text-orange-600">
                    {{ $jumlahPembayar }} Orang
                </h2>
            </div>

        </div>

        {{-- DISTRIBUSI & KETERANGAN --}}
        <div class="grid grid-cols-1 gap-6 mt-10 md:grid-cols-2">

            {{-- ZAKAT MAAL --}}
            <div class="p-6 bg-white border shadow rounded-xl">
                <p class="text-sm text-gray-500">Total Zakat Maal</p>

                <div class="mt-2 space-y-1">
                    <p class="font-bold text-green-700">
                        Rp {{ number_format($zakatMaalTunai, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ number_format($zakatMaalBeras, 0, ',', '.') }} Kg Beras
                    </p>
                </div>

                <p class="mt-3 text-sm text-red-600">
                    ➜ Seluruh zakat maal disalurkan ke BAZNAS
                </p>
            </div>

            {{-- ZAKAT FITRAH --}}
            <div class="p-6 bg-white border shadow rounded-xl">
                <p class="text-sm text-gray-500">Total Zakat Fitrah</p>

                <div class="mt-2 space-y-1">
                    <p class="font-bold text-green-700">
                        Rp {{ number_format($zakatFitrahTunai, 0, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ number_format($zakatFitrahBeras, 0, ',', '.') }} Kg Beras
                    </p>
                </div>

                <div class="mt-3 p-3 bg-gray-100 rounded-lg text-sm">
                    <p class="font-semibold">Distribusi per Penerima:</p>
                    <p>
                        Rp {{ number_format($fitrahPerOrangTunai, 0, ',', '.') }}
                        + {{ number_format($fitrahPerOrangBeras, 2) }} Kg
                        / orang
                    </p>
                </div>
            </div>

            {{-- INFAQ BERAS --}}
            <div class="p-6 bg-white border shadow rounded-xl">
                <p class="text-sm text-gray-500">Total Infaq Beras</p>
                <h2 class="mt-2 text-xl font-bold text-blue-700">
                    {{ number_format($infaqTotalBeras, 0, ',', '.') }} Kg
                </h2>

                <p class="mt-3 text-sm text-indigo-600">
                    ➜ Akan disalurkan ke Panti Asuhan
                </p>
            </div>

            {{-- INFAQ UANG --}}
            <div class="p-6 bg-white border shadow rounded-xl">
                <p class="text-sm text-gray-500">Total Infaq Uang</p>
                <h2 class="mt-2 text-xl font-bold text-blue-700">
                    Rp {{ number_format($infaqTotalTunai, 0, ',', '.') }}
                </h2>

                <p class="mt-3 text-sm text-indigo-600">
                    ➜ Masuk ke Kas Masjid
                </p>
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
