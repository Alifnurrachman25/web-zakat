<x-app-layout>
    <div class="max-w-7xl mx-auto px-8 py-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-white text-center">
                    Jenis Zakat
                </h1>
                <p class="text-sm text-white">
                    Kelola jenis zakat di masjid
                </p>
            </div>

            <a href="{{ route('admin.zakat-types.create') }}"
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
                                Nama Jenis Zakat
                            </th>
                            <th class="border border-black px-6 py-3 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    {{-- Body --}}
                    <tbody>
                        @forelse($zakatTypes as $zakat)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-100' }}">
                                <td class="border border-black px-6 py-3">
                                    {{ $zakat->name }}
                                </td>
                                <td class="border border-black px-6 py-3">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('admin.zakat-types.edit', $zakat) }}"
                                            class="px-3 py-1 text-blue-700 bg-blue-100 rounded hover:bg-blue-200">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.zakat-types.destroy', $zakat) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus jenis zakat ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 rounded bg-red-100 hover:bg-red-200 text-red-700 hover:text-red-800">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="border border-black px-6 py-6 text-center text-gray-500">
                                    Belum ada jenis zakat
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</x-app-layout>
