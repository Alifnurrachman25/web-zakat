<x-app-layout>
    <div class="min-h-screen flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-6xl bg-white border border-black rounded-lg shadow p-6">

            {{-- Header --}}
            <div class="border-b border-black px-4 py-3 bg-gray-100 mb-6">
                <h1 class="text-xl font-bold">Bayar Zakat</h1>
                <p class="text-sm text-gray-500">
                    Masukkan data muzakki dan pembayaran zakat
                </p>
            </div>

            {{-- Error --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.zakat.store') }}" x-data="{
                metode: '{{ old('metode_pembayaran', 'tunai') }}',
                zakatType: '{{ old('zakat_type_id') }}',
                jumlah: {{ old('jumlah_jiwa', 0) }},
                ricePrice: {{ old('rice_type_id') ? $riceTypes->firstWhere('id', old('rice_type_id'))?->price ?? 48000 : 48000 }},
                get isFitrah() {
                    return this.zakatType == '{{ $zakatTypes->firstWhere('name', 'Zakat Fitrah')->id ?? '' }}'
                },
                get totalOrang() {
                    return Number(this.jumlah) + 1
                },
                get wajibTunai() {
                    return this.isFitrah ? this.totalOrang * this.ricePrice : '-'
                },
                get wajibBeras() {
                    return this.isFitrah ? this.totalOrang * 3 : '-'
                }
            }" class="space-y-6">

                @csrf

                <div class="grid grid-cols-2 gap-6">

                    {{-- Nama Muzakki --}}
                    <div>
                        <label class="block text-sm font-medium">Nama Muzakki</label>
                        <input type="text" name="nama_muzakki" value="{{ old('nama_muzakki') }}"
                            class="w-full border border-black rounded px-3 py-2">
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-sm font-medium">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full border border-black rounded px-3 py-2">
                    </div>

                    {{-- Perumahan --}}
                    <div>
                        <label class="block text-sm font-medium">Perumahan</label>
                        <select name="perumahan_id" class="w-full border border-black rounded px-3 py-2">
                            <option value="">-- Pilih --</option>
                            @foreach ($perumahans as $p)
                                <option value="{{ $p->id }}" @selected(old('perumahan_id') == $p->id)>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- RT --}}
                    <div>
                        <label class="block text-sm font-medium">RT</label>
                        <select name="rt_id" class="w-full border border-black rounded px-3 py-2">
                            <option value="">-- Pilih --</option>
                            @foreach ($rts as $r)
                                <option value="{{ $r->id }}" @selected(old('rt_id') == $r->id)>
                                    {{ $r->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Blok --}}
                    <div>
                        <label class="block text-sm font-medium">Blok</label>
                        <input type="text" name="blok" value="{{ old('blok') }}"
                            class="w-full border border-black rounded px-3 py-2">
                    </div>

                    {{-- Jenis Zakat --}}
                    <div>
                        <label class="block text-sm font-medium">Jenis Zakat</label>
                        <select name="zakat_type_id" x-model="zakatType"
                            class="w-full border border-black rounded px-3 py-2">
                            <option value="">-- Pilih --</option>
                            @foreach ($zakatTypes as $z)
                                <option value="{{ $z->id }}" @selected(old('zakat_type_id') == $z->id)>
                                    {{ $z->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jumlah Jiwa --}}
                    <div>
                        <label class="block text-sm font-medium">Jumlah Tanggungan</label>
                        <input type="number" min="0" name="jumlah_jiwa" x-model="jumlah"
                            class="w-full border border-black rounded px-3 py-2">
                        <p class="text-xs text-gray-500 mt-1">
                            Total orang: <span x-text="totalOrang"></span>
                        </p>
                    </div>

                    {{-- Metode Pembayaran --}}
                    <div>
                        <label class="block text-sm font-medium">Metode Pembayaran</label>
                        <select name="metode_pembayaran" x-model="metode"
                            class="w-full border border-black rounded px-3 py-2">
                            <option value="tunai">Tunai</option>
                            <option value="beras">Beras</option>
                        </select>
                    </div>

                    {{-- ================= TUNAI ================= --}}
                    <template x-if="metode === 'tunai'">
                        <div class="col-span-2 grid grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium">Jenis Beras</label>
                                <select name="rice_type_id" :disabled="!isFitrah"
                                    @change="ricePrice = $event.target.options[$event.target.selectedIndex].dataset.price"
                                    class="w-full border border-black rounded px-3 py-2 disabled:bg-gray-200">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($riceTypes as $r)
                                        <option value="{{ $r->id }}" data-price="{{ $r->price }}">
                                            {{ $r->name }} (Rp {{ number_format($r->price) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium">Bayar (Rp)</label>
                                <input type="number" min="0" name="bayar"
                                    class="w-full border border-black rounded px-3 py-2">
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-black">Wajib Bayar</label>
                                <input type="text" readonly
                                    :value="isFitrah ? wajibTunai.toLocaleString('id-ID') : '-'"
                                    class="w-full border border-black bg-gray-100 rounded px-3 py-2">
                            </div>

                        </div>
                    </template>

                    {{-- ================= BERAS ================= --}}
                    <template x-if="metode === 'beras'">
                        <div class="col-span-2 grid grid-cols-2 gap-6">

                            <div>
                                <label class="block text-sm font-medium">Jumlah Beras (Kg)</label>
                                <input type="number" step="0.1" min="0" name="beras_kg"
                                    class="w-full border border-black rounded px-3 py-2">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-black">Wajib Beras</label>
                                <input type="text" readonly :value="isFitrah ? wajibBeras + ' Kg' : '-'"
                                    class="w-full border border-black bg-gray-100 rounded px-3 py-2">
                            </div>

                        </div>
                    </template>

                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-black">
                    <a href="{{ route('user.zakat.index') }}" class="px-4 py-2 bg-gray-200 rounded">
                        Batal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-black rounded">
                        Bayar Zakat
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
