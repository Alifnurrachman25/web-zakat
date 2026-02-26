<x-app-layout>
    <div class="min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-xl bg-white border border-black rounded-lg shadow">

            {{-- Header --}}
            <div class="border-b border-black px-6 py-4 bg-gray-100">
                <h1 class="text-xl font-bold text-gray-800">
                    Edit Jenis Beras
                </h1>
                <p class="text-sm text-gray-500">
                    Perbarui nama dan harga beras
                </p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.rice-types.update', $riceType) }}" class="px-6 py-6 space-y-4">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Beras
                    </label>
                    <input name="name" value="{{ old('name', $riceType->name) }}"
                        class="w-full border border-black rounded px-3 py-2
                               focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Harga
                    </label>
                    <input name="price" type="number" value="{{ old('price', $riceType->price) }}"
                        class="w-full border border-black rounded px-3 py-2
                               focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-black">
                    <a href="{{ route('admin.rice-types.index') }}"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-4 py-2 rounded bg-gray-800 hover:bg-blue-700 text-white hover:text-white">
                        Update
                    </button>
                </div>
            </form>

        </div>

    </div>
</x-app-layout>
