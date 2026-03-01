<x-app-layout>

    <div class="px-2 py-6 mx-auto max-w-7xl md:px-2">

        {{-- Header --}}
        <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-4xl font-bold text-white md:text-5xl">
                    Data Penerima Zakat
                </h1>
                <p class="text-sm text-white">
                    Kelola data penerima zakat
                </p>
            </div>

            <a href="{{ route('user.penerima-zakat.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-white transition bg-green-600 rounded-lg shadow hover:bg-green-700">
                + Tambah Penerima
            </a>
        </div>

        {{-- Filter --}}
        <form method="GET" action="{{ route('user.penerima-zakat.index') }}" class="mb-6">
            <div class="grid items-end grid-cols-1 gap-4 md:grid-cols-4">

                {{-- Search --}}
                <div class="flex flex-col">
                    <label class="mb-1 text-sm font-semibold text-white">
                        Pencarian
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau blok..."
                        class="px-3 py-2 bg-white border border-black rounded focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Filter Perumahan --}}
                <div class="flex flex-col">
                    <label class="mb-1 text-sm font-semibold text-white">
                        Perumahan
                    </label>
                    <select name="perumahan"
                        class="px-3 py-2 bg-white border border-black rounded focus:ring-2 focus:ring-blue-500">

                        <option value="">Semua</option>

                        @foreach ($perumahans as $perumahan)
                            <option value="{{ $perumahan->name }}"
                                {{ request('perumahan') == $perumahan->name ? 'selected' : '' }}>
                                {{ $perumahan->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Filter RT --}}
                <div class="flex flex-col">
                    <label class="mb-1 text-sm font-semibold text-white">
                        RT
                    </label>
                    <select name="rt" class="px-3 py-2 bg-white border border-black rounded">

                        <option value="">Semua</option>

                        @foreach ($rts as $rt)
                            <option value="{{ $rt->name }}" {{ request('rt') == $rt->name ? 'selected' : '' }}>
                                {{ $rt->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Button --}}
                <div class="flex gap-2">
                    <button type="submit"
                        class="w-full px-4 py-2 text-white transition bg-blue-600 rounded hover:bg-blue-700">
                        Filter
                    </button>

                    <a href="{{ route('user.penerima-zakat.index') }}"
                        class="w-full px-4 py-2 text-center text-white transition bg-gray-500 rounded hover:bg-gray-600">
                        Reset
                    </a>
                </div>

            </div>
        </form>

        <div class="mb-6">
            <div class="p-6 bg-white border border-black rounded-lg shadow">

                <p class="text-sm text-gray-500">
                    Total Penerima Zakat
                </p>

                <h2 class="mt-1 text-2xl font-bold text-blue-600">
                    {{ $filterLabel }} = {{ $data->total() }} Orang
                </h2>

            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-hidden bg-white border border-black rounded-lg shadow">
            <table class="min-w-full text-sm text-left border-collapse">
                <thead class="text-black bg-gray-200 border-b border-black">
                    <tr>
                        <th class="px-4 py-3 text-left border border-black">Nama</th>
                        <th class="px-4 py-3 text-left border border-black">Perumahan</th>
                        <th class="px-4 py-3 text-left border border-black">Blok</th>
                        <th class="px-4 py-3 text-left border border-black">RT</th>
                        <th class="px-4 py-3 text-left border border-black">Kategori</th>
                        <th class="px-4 py-3 text-center border border-black">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2 border border-black">{{ $item->name }}</td>
                            <td class="px-4 py-2 border border-black">{{ $item->perumahan }}</td>
                            <td class="px-4 py-2 border border-black">{{ $item->blok }}</td>
                            <td class="px-4 py-2 border border-black">{{ $item->rt }}</td>
                            <td class="px-4 py-2 border border-black">{{ $item->kategori }}</td>
                            <td class="px-4 py-2 text-center border border-black">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('user.penerima-zakat.edit', $item->id) }}"
                                        class="px-3 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <form action="{{ route('user.penerima-zakat.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 text-white bg-red-600 rounded hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                Data belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- <div class="px-4 py-3 bg-gray-100 border-t border-black">
            <p class="text-sm font-semibold text-gray-800">
                Total Penerima Zakat :
                <span class="px-3 py-1 text-white bg-blue-600 rounded">
                    {{ $data->total() }}
                </span>
                <span class="px-2">Orang</span>
            </p>
        </div> --}}

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $data->withQueryString()->links() }}
        </div>

    </div>

</x-app-layout>
