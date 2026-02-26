<x-app-layout>
    <div class="max-w-7xl mx-auto px-8 py-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-white text-center">
                    Jenis Beras
                </h1>
                <p class="text-sm text-white">
                    Kelola jenis dan harga beras zakat
                </p>
            </div>

            <a href="{{ route('admin.rice-types.create') }}"
                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition">
                + Tambah Jenis
            </a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table Card --}}
        <div class="bg-white rounded-lg shadow overflow-hidden border border-black">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm">

                    {{-- Head --}}
                    <thead class="bg-gray-200 border-b border-black">
                        <tr>
                            <th class="border border-black px-6 py-3 text-left">
                                Nama Beras
                            </th>
                            <th class="border border-black px-6 py-3 text-left">
                                Harga / Kg
                            </th>
                            <th class="border border-black px-6 py-3 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    {{-- Body --}}
                    <tbody>
                        @forelse($riceTypes as $rice)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-100' }}">
                                <td class="border border-black px-6 py-3">
                                    {{ $rice->name }}
                                </td>
                                <td class="border border-black px-6 py-3">
                                    Rp {{ number_format($rice->price) }}
                                </td>
                                <td class="border border-black px-6 py-3">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('admin.rice-types.edit', $rice) }}"
                                            class="px-3 py-1 text-blue-700 bg-blue-100 rounded hover:bg-blue-200">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.rice-types.destroy', $rice) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                                class="px-3 py-1 rounded
               bg-red-100 hover:bg-red-200
               !text-red-700 hover:!text-red-800
               focus:outline-none focus:ring-2 focus:ring-red-300">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border border-black px-6 py-6 text-center text-gray-500">
                                    Belum ada jenis beras
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</x-app-layout>
