<x-app-layout>
    <div class="min-h-screen flex items-center justify-center px-6 py-12">

        <div class="w-full max-w-6xl bg-white border border-black rounded-lg shadow p-6">

            {{-- Header --}}
            <div class="border-b border-black px-4 py-3 bg-gray-100 mb-6">
                <h1 class="text-xl font-bold text-gray-800">
                    Bayar Zakat
                </h1>
                <p class="text-sm text-gray-500">
                    Masukkan data muzakki dan pembayaran zakat
                </p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('user.zakat.store') }}" class="space-y-6" x-data="{
                metode: '{{ old('metode_pembayaran', 'tunai') }}',
                jumlah: {{ old('jumlah_jiwa', 1) }},
                ricePrice: {{ old('rice_type_id') ? $riceTypes->firstWhere('id', old('rice_type_id'))->price : 48000 }},
                getWajibBayar() {
                    return this.metode === 'beras' ? this.ricePrice * this.jumlah : 48000 * this.jumlah;
                }
            }">

                @csrf

                {{-- Flex Grid: 2 columns --}}
                <div class="grid grid-cols-2 gap-6">

                    {{-- Nama Muzakki --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Muzakki</label>
                        <input type="text" name="nama_muzakki" value="{{ old('nama_muzakki') }}"
                            placeholder="Contoh: Ahmad"
                            class="w-full border border-black rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300">
                        @error('nama_muzakki')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            placeholder="Contoh: 08123456789"
                            class="w-full border border-black rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300">
                        @error('phone')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Perumahan --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Perumahan</label>
                        <select name="perumahan_id"
                            class="w-full border border-black rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300">
                            <option value="">-- Pilih Perumahan --</option>
                            @foreach ($perumahans as $p)
                                <option value="{{ $p->id }}" @selected(old('perumahan_id') == $p->id)>{{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('perumahan_id')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- RT --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">RT</label>
                        <select name="rt_id"
                            class="w-full border border-black rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300">
                            <option value="">-- Pilih RT --</option>
                            @foreach ($rts as $r)
                                <option value="{{ $r->id }}" @selected(old('rt_id') == $r->id)>{{ $r->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('rt_id')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Blok --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Blok</label>
                        <input type="text" name="blok" value="{{ old('blok') }}" placeholder="Contoh: A1"
                            class="w-full border border-black rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300">
                        @error('blok')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis Zakat --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Zakat</label>
                        <select name="zakat_type_id"
                            class="w-full border border-black rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300">
                            <option value="">-- Pilih Jenis Zakat --</option>
                            @foreach ($zakatTypes as $z)
                                <option value="{{ $z->id }}" @selected(old('zakat_type_id') == $z->id)>{{ $z->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('zakat_type_id')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jumlah Jiwa --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Jiwa</label>
                        <input type="number" min="1" name="jumlah_jiwa" x-model.number="jumlah"
                            value="{{ old('jumlah_jiwa', 1) }}"
                            class="w-full border border-black rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300">
                        @error('jumlah_jiwa')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Metode Pembayaran --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                        <select name="metode_pembayaran" x-model="metode"
                            class="w-full border border-black rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300">
                            <option value="">-- Pilih Metode --</option>
                            <option value="tunai">Tunai</option>
                            <option value="beras">Beras</option>
                        </select>
                        @error('metode_pembayaran')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        {{-- Wajib Bayar --}}
                        <div class="mt-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Wajib Bayar (Rp)</label>
                            <input type="text" readonly x-bind:value="getWajibBayar().toLocaleString('id-ID')"
                                class="w-full border border-black rounded px-3 py-2 bg-gray-100 text-gray-700">
                        </div>

                        {{-- Input tunai --}}
                        <div class="mt-2" x-show="metode=='tunai'">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bayar (Rp)</label>
                            <input type="number" min="0" name="bayar" value="{{ old('bayar') }}"
                                class="w-full border border-black rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300">
                        </div>

                        {{-- Pilih Beras --}}
                        <div class="mt-2" x-show="metode=='beras'">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Beras</label>
                            <select name="rice_type_id" x-model="riceTypeId"
                                @change="ricePrice = $event.target.options[$event.target.selectedIndex].dataset.price"
                                class="w-full border border-black rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-300">
                                <option value="">-- Pilih Jenis Beras --</option>
                                @foreach ($riceTypes as $r)
                                    <option value="{{ $r->id }}" data-price="{{ $r->price }}"
                                        @selected(old('rice_type_id') == $r->id)>
                                        {{ $r->name }} (Rp {{ number_format($r->price) }} / kg)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-black">
                    <a href="{{ route('user.zakat.index') }}"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">
                        Batal
                    </a>

                    <button type="submit" class="px-4 py-2 rounded bg-green-500 hover:bg-green-700 text-black">
                        Bayar Zakat
                    </button>
                </div>

            </form>

        </div>

    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
