<x-app-layout>
    <div class="max-w-4xl px-4 py-6 mx-auto">

        <h1 class="mb-6 text-3xl font-bold text-white">
            Edit Penerima Zakat
        </h1>

        <form method="POST" action="{{ route('user.penerima-zakat.update', $penerima_zakat->id) }}"
            class="p-6 bg-white border border-black rounded-lg shadow">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                {{-- Nama --}}
                <div>
                    <label class="block mb-1 font-semibold">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $penerima_zakat->name) }}"
                        class="w-full px-3 py-2 border border-black rounded">
                </div>

                {{-- Perumahan --}}
                <div>
                    <label class="block mb-1 font-semibold">Perumahan</label>
                    <select name="perumahan" class="w-full px-3 py-2 border border-black rounded">
                        @foreach ($perumahans as $p)
                            <option value="{{ $p->name }}"
                                {{ $penerima_zakat->perumahan == $p->name ? 'selected' : '' }}>
                                {{ $p->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Blok --}}
                <div>
                    <label class="block mb-1 font-semibold">Blok</label>
                    <input type="text" name="blok" value="{{ old('blok', $penerima_zakat->blok) }}"
                        class="w-full px-3 py-2 border border-black rounded">
                </div>

                {{-- RT --}}
                <div>
                    <label class="block mb-1 font-semibold">RT</label>
                    <select name="rt" class="w-full px-3 py-2 border border-black rounded">
                        @foreach ($rts as $r)
                            <option value="{{ $r->name }}" {{ $penerima_zakat->rt == $r->name ? 'selected' : '' }}>
                                {{ $r->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div>
                <label class="block mb-1 font-semibold">Kategori</label>
                <select name="kategori" class="w-full px-3 py-2 border border-black rounded">
                    @foreach ($kategori_penerimas as $k)
                        <option value="{{ $k->name }}"
                            {{ $penerima_zakat->kategori == $k->name ? 'selected' : '' }}>
                            {{ $k->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="flex gap-3 mt-6">
                <button class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    Update
                </button>

                <a href="{{ route('user.penerima-zakat.index') }}"
                    class="px-6 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">
                    Batal
                </a>
            </div>

        </form>
    </div>
</x-app-layout>
