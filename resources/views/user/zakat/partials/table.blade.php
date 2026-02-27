<div class="overflow-hidden bg-white border border-black rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="w-full text-sm border-collapse">

            <thead class="bg-gray-200 border-b border-black">
                <tr>
                    <th class="px-4 py-2 text-center border border-black">Tanggal</th>
                    <th class="px-4 py-2 text-center border border-black">Nama</th>
                    <th class="px-4 py-2 text-center border border-black">Perumahan</th>
                    <th class="px-4 py-2 text-center border border-black">RT</th>
                    <th class="px-4 py-2 text-center border border-black">Blok</th>
                    <th class="px-4 py-2 text-center border border-black">Nomor HP</th>
                    <th class="px-4 py-2 text-center border border-black">Jenis Zakat</th>
                    <th class="px-4 py-2 text-center border border-black">Metode</th>
                    <th class="px-4 py-2 text-center border border-black">Total Bayar</th>
                    <th class="px-4 py-2 text-center border border-black">Infaq</th>
                    <th class="px-4 py-2 text-center border border-black">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($payments as $p)
                    <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="px-4 py-2 border border-black">
                            {{ $p->created_at->format('d M Y') }}
                        </td>
                        <td class="px-4 py-2 border border-black">{{ $p->nama_muzakki }}</td>
                        <td class="px-4 py-2 border border-black">{{ $p->perumahan?->name ?? '-' }}</td>
                        <td class="px-4 py-2 border border-black">{{ $p->rt?->name ?? '-' }}</td>
                        <td class="px-4 py-2 border border-black">{{ $p->blok ?? '-' }}</td>
                        <td class="px-4 py-2 border border-black">{{ $p->phone ?? '-' }}</td>
                        <td class="px-4 py-2 border border-black">{{ $p->zakatType?->name ?? '-' }}</td>
                        <td class="px-4 py-2 border border-black">{{ ucfirst($p->metode_pembayaran) }}</td>
                        <td class="px-4 py-2 border border-black">
                            @if ($p->metode_pembayaran === 'beras')
                                {{ rtrim(rtrim(number_format($p->bayar, 2), '0'), '.') }} kg
                            @else
                                Rp {{ number_format($p->bayar) }}
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-black">
                            @if ($p->zakatType?->name !== 'Zakat Fitrah')
                                -
                            @else
                                @if ($p->infaq > 0)
                                    @if ($p->metode_pembayaran === 'beras')
                                        {{ rtrim(rtrim(number_format($p->infaq, 2), '0'), '.') }} kg
                                    @else
                                        Rp {{ number_format($p->infaq) }}
                                    @endif
                                @else
                                    -
                                @endif
                            @endif
                        </td>
                        <td class="px-4 py-2 text-center border border-black">
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
                        <td colspan="11" class="px-4 py-6 text-center text-gray-500 border border-black">
                            Tidak ditemukan data
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="p-4">
        {{ $payments->links() }}
    </div>
</div>
