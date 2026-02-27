<x-app-layout>

    <div class="px-2 py-6 mx-auto max-w-[700px]">

        <div class="p-6 bg-white border border-black rounded-lg shadow">

            <h2 class="mb-6 text-xl font-bold">
                Edit Infaq Harian
            </h2>

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="p-3 mb-4 text-green-700 bg-green-100 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
                <div class="p-3 mb-4 text-red-700 bg-red-100 border border-red-300 rounded">
                    <ul class="pl-5 list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.infaq.update', $infaq) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Tanggal --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">
                        Tanggal
                    </label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $infaq->tanggal->format('Y-m-d')) }}"
                        class="w-full px-3 py-2 border border-black rounded" required>
                </div>

                {{-- Pemasukan Manual --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">
                        Pemasukan Manual
                    </label>
                    <input type="number" name="pemasukan_manual"
                        value="{{ old('pemasukan_manual', $infaq->pemasukan_manual) }}"
                        class="w-full px-3 py-2 border border-black rounded" required>
                </div>

                {{-- Imam --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">
                        Imam
                    </label>
                    <input type="text" name="imam" value="{{ old('imam', $infaq->imam) }}"
                        class="w-full px-3 py-2 border border-black rounded" required>
                </div>

                {{-- Kultum --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">
                        Kultum
                    </label>
                    <input type="text" name="kultum" value="{{ old('kultum', $infaq->kultum) }}"
                        class="w-full px-3 py-2 border border-black rounded" required>
                </div>

                {{-- Bilal --}}
                <div class="mb-6">
                    <label class="block mb-1 font-semibold">
                        Bilal
                    </label>
                    <input type="text" name="bilal" value="{{ old('bilal', $infaq->bilal) }}"
                        class="w-full px-3 py-2 border border-black rounded" required>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-between">
                    <a href="{{ route('user.infaq.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                        Kembali
                    </a>

                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>
