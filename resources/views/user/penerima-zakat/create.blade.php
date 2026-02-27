<x-app-layout>
    <div class="max-w-4xl px-4 py-6 mx-auto">

        <h1 class="mb-6 text-3xl font-bold text-white">
            Tambah Penerima Zakat
        </h1>

        <form method="POST" action="{{ route('user.penerima-zakat.store') }}"
            class="p-6 bg-white border border-black rounded-lg shadow">

            @csrf

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                {{-- Nama --}}
                <div>
                    <label class="block mb-1 font-semibold">Nama</label>
                    <input type="text" name="name" class="w-full px-3 py-2 border border-black rounded">
                </div>

                {{-- Perumahan --}}
                <div>
                    <label class="block mb-1 font-semibold">Perumahan</label>
                    <select name="perumahan" class="w-full px-3 py-2 border border-black rounded">
                        <option value="">Pilih Perumahan</option>
                        @foreach ($perumahans as $p)
                            <option value="{{ $p->name }}">
                                {{ $p->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Blok --}}
                <div>
                    <label class="block mb-1 font-semibold">Blok</label>
                    <input type="text" name="blok" class="w-full px-3 py-2 border border-black rounded">
                </div>

                {{-- RT --}}
                <div>
                    <label class="block mb-1 font-semibold">RT</label>
                    <select name="rt" class="w-full px-3 py-2 border border-black rounded">
                        <option value="">Pilih RT</option>
                        @foreach ($rts as $r)
                            <option value="{{ $r->name }}">
                                {{ $r->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- Notes --}}
            <div class="mt-4">
                <label class="block mb-1 font-semibold">Catatan</label>
                <textarea name="notes" class="w-full px-3 py-2 border border-black rounded"></textarea>
            </div>

            <div class="mt-6">
                <button class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
