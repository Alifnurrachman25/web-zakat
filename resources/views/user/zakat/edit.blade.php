<x-app-layout>
    <div class="flex items-center justify-center min-h-screen px-6 py-12">
        <div class="w-full max-w-6xl p-6 bg-white border border-black rounded-lg shadow">

            {{-- Header --}}
            <div class="px-4 py-3 mb-6 bg-gray-100 border-b border-black">
                <h1 class="text-xl font-bold">Edit Zakat</h1>
                <p class="text-sm text-gray-500">
                    Perbarui data muzakki dan pembayaran zakat
                </p>
            </div>

            {{-- Error --}}
            @if ($errors->any())
                <div class="p-3 mb-4 text-red-700 bg-red-100 border border-red-400">
                    <ul class="text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.zakat.update', $zakat) }}" x-data="{
                metode: '{{ old('metode_pembayaran', $zakat->metode_pembayaran ?? 'tunai') }}',
                zakatType: '{{ old('zakat_type_id', $zakat->zakat_type_id) }}',
                jumlah: Number('{{ old('jumlah_jiwa', $zakat->jumlah_jiwa ?? 0) }}'),
                ricePrice: {{ old('rice_type_id')
                    ? $riceTypes->firstWhere('id', old('rice_type_id'))?->price ?? ($zakat->riceType?->price ?? 48000)
                    : $zakat->riceType?->price ?? 48000 }},
            
                get isFitrah() {
                    return this.zakatType == '{{ $zakatTypes->firstWhere('name', 'Zakat Fitrah')?->id }}'
                },
            
                get wajibTunai() {
                    return this.isFitrah ? this.jumlah * this.ricePrice : 0
                },
            
                get wajibBeras() {
                    return this.isFitrah ? this.jumlah * 3 : 0
                }
            }"
                class="space-y-6">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6">

                    {{-- Nama Muzakki --}}
                    <div>
                        <label class="block text-sm font-medium">Nama Muzakki</label>
                        <input type="text" name="nama_muzakki"
                            value="{{ old('nama_muzakki', $zakat->nama_muzakki) }}" required
                            class="w-full px-3 py-2 border border-black rounded">
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-sm font-medium">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $zakat->phone) }}"
                            class="w-full px-3 py-2 border border-black rounded">
                    </div>

                    {{-- Perumahan --}}
                    <div>
                        <label class="block text-sm font-medium">Perumahan</label>
                        <select name="perumahan_id" required class="w-full px-3 py-2 border border-black rounded">
                            <option value="">-- Pilih --</option>
                            @foreach ($perumahans as $p)
                                <option value="{{ $p->id }}" @selected(old('perumahan_id', $zakat->perumahan_id) == $p->id)>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- RT --}}
                    <div>
                        <label class="block text-sm font-medium">RT</label>
                        <select name="rt_id" required class="w-full px-3 py-2 border border-black rounded">
                            <option value="">-- Pilih --</option>
                            @foreach ($rts as $r)
                                <option value="{{ $r->id }}" @selected(old('rt_id', $zakat->rt_id) == $r->id)>
                                    {{ $r->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Blok --}}
                    <div>
                        <label class="block text-sm font-medium">Blok</label>
                        <input type="text" name="blok" value="{{ old('blok', $zakat->blok) }}"
                            class="w-full px-3 py-2 border border-black rounded">
                    </div>

                    {{-- Jenis Zakat --}}
                    <div>
                        <label class="block text-sm font-medium">Jenis Zakat</label>
                        <select name="zakat_type_id" x-model="zakatType" required
                            class="w-full px-3 py-2 border border-black rounded">
                            <option value="">-- Pilih --</option>
                            @foreach ($zakatTypes as $z)
                                <option value="{{ $z->id }}" @selected(old('zakat_type_id', $zakat->zakat_type_id) == $z->id)>
                                    {{ $z->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jumlah Jiwa --}}
                    <!-- TOTAL ORANG -->
                    <div>
                        <label class="block text-sm font-medium ">Total Orang</label>
                        <x-text-input type="number" min="1" name="jumlah_jiwa" class="w-full"
                            value="{{ old('jumlah_jiwa', $zakat->jumlah_jiwa) }}" x-model.number="jumlah" />

                        <p class="mt-1 text-sm italic text-gray-500">
                            * Total orang sudah termasuk <strong>muzakki + seluruh tanggungan</strong>
                        </p>
                    </div>

                    {{-- Metode Pembayaran --}}
                    <div>
                        <label class="block text-sm font-medium">Metode Pembayaran</label>
                        <select name="metode_pembayaran" x-model="metode"
                            class="w-full px-3 py-2 border border-black rounded">
                            <option value="tunai">Tunai</option>
                            <option value="beras">Beras</option>
                        </select>
                    </div>

                    {{-- ================= TUNAI ================= --}}
                    <template x-if="metode === 'tunai'">
                        <div class="grid grid-cols-2 col-span-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium">Jenis Beras</label>
                                <select name="rice_type_id" required
                                    @change="ricePrice = $event.target.options[$event.target.selectedIndex].dataset.price"
                                    class="w-full px-3 py-2 border border-black rounded">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($riceTypes as $r)
                                        <option value="{{ $r->id }}" data-price="{{ $r->price }}"
                                            @selected(old('rice_type_id', $zakat->rice_type_id) == $r->id)>
                                            {{ $r->name }} (Rp {{ number_format($r->price) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium">Bayar (Rp)</label>
                                <input type="number" min="0" name="bayar"
                                    value="{{ old('bayar', $zakat->bayar) }}" required
                                    class="w-full px-3 py-2 border border-black rounded">
                            </div>

                            <template x-if="isFitrah">
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium">Wajib Bayar</label>
                                    <input type="text" readonly :value="wajibTunai.toLocaleString('id-ID')"
                                        class="w-full px-3 py-2 bg-gray-100 border border-black rounded">
                                </div>
                            </template>

                        </div>
                    </template>

                    {{-- ================= BERAS ================= --}}
                    <template x-if="metode === 'beras'">
                        <div class="grid grid-cols-2 col-span-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium">Jumlah Beras (Kg)</label>
                                <input type="number" step="0.1" min="0" name="beras_kg"
                                    value="{{ old('beras_kg') }}" required
                                    class="w-full px-3 py-2 border border-black rounded">
                            </div>

                            <template x-if="isFitrah">
                                <div>
                                    <label class="block text-sm font-medium">Wajib Beras</label>
                                    <input type="text" readonly :value="wajibBeras + ' Kg'"
                                        class="w-full px-3 py-2 bg-gray-100 border border-black rounded">
                                </div>
                            </template>

                        </div>
                    </template>

                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-black">
                    <a href="{{ route('user.zakat.index') }}" class="px-4 py-2 bg-gray-200 rounded">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">
                        Update Zakat
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
