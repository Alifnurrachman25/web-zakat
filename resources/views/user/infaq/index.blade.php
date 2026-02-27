<x-app-layout>

    <div class="px-2 py-6 mx-auto max-w-7xl md:px-2">

        {{-- Header --}}
        <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-4xl font-bold text-center text-white md:text-5xl">
                    Riwayat Infaq Harian
                </h1>
                <p class="text-sm text-white">
                    Kelola data pemasukan infaq harian Anda
                </p>
            </div>

            <a href="{{ route('user.infaq.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-white transition bg-green-600 rounded-lg shadow hover:bg-green-700">
                + Tambah Infaq
            </a>
        </div>

        <form method="GET" action="{{ route('user.infaq.index') }}" class="mb-6">
            <div class="grid items-end grid-cols-1 gap-4 md:grid-cols-4">

                {{-- Search --}}
                <div class="flex flex-col">
                    <label class="mb-1 text-sm font-semibold text-white">
                        Pencarian
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari imam / kultum / bilal..."
                        class="px-3 py-2 bg-white border border-black rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Filter Tanggal --}}
                <div class="flex flex-col">
                    <label class="mb-1 text-sm font-semibold text-white">
                        Filter Tanggal
                    </label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                        class="px-3 py-2 bg-white border border-black rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Spacer (biar tombol rata kanan di desktop) --}}
                <div class="hidden md:block"></div>

                {{-- Button --}}
                <div class="flex gap-2">
                    <button type="submit"
                        class="w-full px-4 py-2 text-white transition bg-blue-600 rounded hover:bg-blue-700">
                        Filter
                    </button>

                    <a href="{{ route('user.infaq.index') }}"
                        class="w-full px-4 py-2 text-center text-white transition bg-gray-500 rounded hover:bg-gray-600">
                        Reset
                    </a>
                </div>

            </div>
        </form>

        {{-- Table --}}
        <div>
            @include('user.infaq.partials.table', ['infaqs' => $infaqs])
        </div>

    </div>

</x-app-layout>
