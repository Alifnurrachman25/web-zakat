<x-app-layout>

    <div class="px-2 py-6 mx-auto max-w-[700px]">

        <div class="p-6 bg-white border border-black rounded-lg shadow">

            <h2 class="mb-6 text-xl font-bold">
                Tambah Infaq Harian
            </h2>

            <form action="{{ route('user.infaq.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full px-3 py-2 border border-black rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Pemasukan Manual</label>
                    <input type="number" name="pemasukan_manual" class="w-full px-3 py-2 border border-black rounded"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Imam</label>
                    <input type="text" name="imam" class="w-full px-3 py-2 border border-black rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Kultum</label>
                    <input type="text" name="kultum" class="w-full px-3 py-2 border border-black rounded" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-semibold">Bilal</label>
                    <input type="text" name="bilal" class="w-full px-3 py-2 border border-black rounded" required>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('user.infaq.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                        Kembali
                    </a>

                    <button class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
