<div class="overflow-hidden bg-white border border-black rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="w-full text-sm border-collapse">

            <thead class="bg-gray-200 border-b border-black">
                <tr>
                    <th class="px-3 py-2 text-left border border-black">Tanggal</th>
                    <th class="px-3 py-2 text-left border border-black">Manual</th>
                    <th class="px-3 py-2 text-left border border-black">Dari Zakat</th>
                    <th class="px-3 py-2 text-left border border-black">Total</th>
                    <th class="px-3 py-2 text-left border border-black">Imam</th>
                    <th class="px-3 py-2 text-left border border-black">Kultum</th>
                    <th class="px-3 py-2 text-left border border-black">Bilal</th>
                    <th class="px-3 py-2 text-center border border-black">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($infaqs as $i)
                    <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="px-3 py-2 border border-black">
                            {{ $i->tanggal->format('d M Y') }}
                        </td>
                        <td class="px-3 py-2 border border-black">
                            Rp {{ number_format($i->pemasukan_manual) }}
                        </td>
                        <td class="px-3 py-2 border border-black">
                            Rp {{ number_format($i->pemasukan_dari_zakat) }}
                        </td>
                        <td class="px-3 py-2 font-semibold border border-black">
                            Rp {{ number_format($i->total_pemasukan) }}
                        </td>
                        <td class="px-3 py-2 border border-black">{{ $i->imam }}</td>
                        <td class="px-3 py-2 border border-black">{{ $i->kultum }}</td>
                        <td class="px-3 py-2 border border-black">{{ $i->bilal }}</td>
                        <td class="px-3 py-2 text-center border border-black">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('user.infaq.edit', $i) }}"
                                    class="px-3 py-1 text-blue-700 bg-blue-100 rounded hover:bg-blue-200">
                                    Edit
                                </a>

                                <form action="{{ route('user.infaq.destroy', $i) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus?')"
                                        class="px-3 py-1 text-red-700 bg-red-100 rounded hover:bg-red-200">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500 border border-black">
                            Tidak ada data infaq
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="p-4">
        {{ $infaqs->withQueryString()->links() }} </div>
</div>
