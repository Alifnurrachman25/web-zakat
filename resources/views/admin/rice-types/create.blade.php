<x-app-layout>
    <div class="min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-xl bg-white border border-black rounded-lg shadow">

            {{-- Header --}}
            <div class="border-b border-black px-6 py-4 bg-gray-100">
                <h1 class="text-xl font-bold text-gray-800">
                    Tambah Jenis Beras
                </h1>
                <p class="text-sm text-gray-500">
                    Masukkan nama dan harga beras
                </p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.rice-types.store') }}" class="px-6 py-6 space-y-4">
                @csrf

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Beras
                    </label>
                    <input name="name" value="{{ old('name') }}" placeholder="Contoh: Beras Premium"
                        class="w-full border border-black rounded px-3 py-2
                               focus:outline-none focus:ring-2 focus:ring-green-300">
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Harga
                    </label>
                    <input name="price" type="number" value="{{ old('price') }}" placeholder="Contoh: 54000"
                        class="w-full border border-black rounded px-3 py-2
                               focus:outline-none focus:ring-2 focus:ring-green-300">
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-black">
                    <a href="{{ route('admin.rice-types.index') }}"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">
                        Batal
                    </a>

                    <button type="submit" class="px-4 py-2 rounded bg-green-500 hover:bg-green-700 text-black">
                        Simpan
                    </button>

                </div>
            </form>

        </div>

    </div>
</x-app-layout>
