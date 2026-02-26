<x-app-layout>
    <div class="max-w-7xl mx-auto px-8 py-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-white text-center">
                    Riwayat Bayar Zakat
                </h1>
                <p class="text-sm text-white">
                    Kelola riwayat pembayaran zakat Anda
                </p>
            </div>

            <a href="{{ route('user.zakat.create') }}"
                class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition">
                + Bayar Zakat
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
                            <th class="border border-black px-4 py-2 text-left">Nama</th>
                            <th class="border border-black px-4 py-2 text-left">Perumahan</th>
                            <th class="border border-black px-4 py-2 text-left">RT</th>
                            <th class="border border-black px-4 py-2 text-left">Blok</th>
                            <th class="border border-black px-4 py-2 text-left">Phone</th>
                            <th class="border border-black px-4 py-2 text-left">Jenis Zakat</th>
                            <th class="border border-black px-4 py-2 text-left">Metode</th>
                            <th class="border border-black px-4 py-2 text-left">Total Bayar</th>
                            <th class="border border-black px-4 py-2 text-left">Infaq</th>
                            <th class="border border-black px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>

                    {{-- Body --}}
                    <tbody>
                        @forelse($payments as $p)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-100' }}">
                                <td class="border border-black px-4 py-2">{{ $p->nama_muzakki }}</td>
                                <td class="border border-black px-4 py-2">{{ $p->perumahan?->name ?? '-' }}</td>
                                <td class="border border-black px-4 py-2">{{ $p->rt?->name ?? '-' }}</td>
                                <td class="border border-black px-4 py-2">{{ $p->blok ?? '-' }}</td>
                                <td class="border border-black px-4 py-2">{{ $p->phone ?? '-' }}</td>
                                <td class="border border-black px-4 py-2">{{ $p->zakatType?->name ?? '-' }}</td>
                                <td class="border border-black px-4 py-2">{{ ucfirst($p->metode_pembayaran) }}</td>
                                <td class="border border-black px-4 py-2">Rp {{ number_format($p->bayar) }}</td>
                                <td class="border border-black px-4 py-2">Rp {{ number_format($p->infaq) }}</td>
                                <td class="border border-black px-4 py-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('user.zakat.edit', $p) }}"
                                            class="px-3 py-1 text-blue-700 bg-blue-100 rounded hover:bg-blue-200">
                                            Edit
                                        </a>
                                        <form action="{{ route('user.zakat.destroy', $p) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                                class="px-3 py-1 rounded bg-red-100 hover:bg-red-200 !text-red-700 hover:!text-red-800 focus:outline-none focus:ring-2 focus:ring-red-300">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="border border-black px-4 py-6 text-center text-gray-500">
                                    Belum ada pembayaran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</x-app-layout>
