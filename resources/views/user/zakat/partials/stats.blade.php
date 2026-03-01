<div class="mb-6">
    <div class="p-6 bg-white border rounded-2xl shadow-lg">

        <p class="mb-4 text-sm text-gray-500">
            Ringkasan Data Berdasarkan Filter
        </p>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

            <div class="p-4 rounded-xl bg-green-50">
                <p class="text-sm text-gray-500">Total Bayar</p>
                <h2 class="mt-1 text-xl font-bold text-green-600">
                    Rp {{ number_format($totalBayarTunai, 0, ',', '.') }}
                </h2>
                <p class="text-sm text-gray-600">
                    + {{ number_format($totalBayarBeras, 0, ',', '.') }} Kg
                </p>
            </div>

            <div class="p-4 rounded-xl bg-blue-50">
                <p class="text-sm text-gray-500">Total Infaq</p>
                <h2 class="mt-1 text-xl font-bold text-blue-600">
                    Rp {{ number_format($totalInfaqTunai, 0, ',', '.') }}
                </h2>
                <p class="text-sm text-gray-600">
                    + {{ number_format($totalInfaqBeras, 0, ',', '.') }} Kg
                </p>
            </div>

            <div class="p-4 text-white rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600">
                <p class="text-sm opacity-80">Total Muzakki</p>
                <h2 class="mt-1 text-3xl font-bold">
                    {{ $totalMuzakki }}
                </h2>
            </div>

        </div>

    </div>
</div>
