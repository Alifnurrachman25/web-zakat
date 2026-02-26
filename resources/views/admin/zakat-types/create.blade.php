<x-app-layout>
    <div class="min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-xl bg-white border border-black rounded-lg shadow">

            {{-- Header --}}
            <div class="border-b border-black px-6 py-4 bg-gray-100">
                <h1 class="text-2xl font-bold text-gray-800">Tambah Jenis Zakat</h1>
                <p class="text-sm text-gray-500">Masukkan nama jenis zakat</p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.zakat-types.store') }}" class="px-6 py-6 space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Jenis Zakat</label>
                    <input name="name" value="{{ old('name') }}" placeholder="Contoh: Zakat Fitrah"
                        class="w-full border border-black rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-black">
                    <a href="{{ route('admin.zakat-types.index') }}"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-4 py-2 rounded !bg-green-600 hover:!bg-green-700 !text-white focus:outline-none focus:ring-2 focus:ring-green-300">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
