<x-app-layout>
    <div class="px-2 py-6 mx-auto max-w-7xl md:px-2" x-data="filterHandler()">

        {{-- Header --}}
        <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-4xl font-bold text-center text-white md:text-5xl">
                    Riwayat Bayar Zakat
                </h1>
                <p class="text-sm text-white">
                    Kelola riwayat pembayaran zakat Anda
                </p>
            </div>

            <a href="{{ route('user.zakat.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-white transition bg-green-600 rounded-lg shadow hover:bg-green-700">
                + Bayar Zakat
            </a>
        </div>

        {{-- FILTER SECTION --}}
        <div class="grid grid-cols-1 gap-3 mb-6 md:grid-cols-4">

            {{-- Search --}}
            <input type="text" x-model="search" @input.debounce.500ms="fetchData()"
                placeholder="Cari nama / phone / blok..." class="px-3 py-2 border border-black rounded">

            {{-- Filter Perumahan --}}
            <select x-model="perumahan" @change="fetchData" class="px-3 py-2 border border-black rounded">
                <option value="">Semua Perumahan</option>
                @foreach ($perumahans as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>

            {{-- Filter RT --}}
            <select x-model="rt" @change="fetchData" class="px-3 py-2 border border-black rounded">
                <option value="">Semua RT</option>
                @foreach ($rts as $r)
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                @endforeach
            </select>

            {{-- Filter Jenis Zakat --}}
            <select x-model="zakat" @change="fetchData" class="px-3 py-2 border border-black rounded">
                <option value="">Semua Jenis Zakat</option>
                @foreach ($zakatTypes as $z)
                    <option value="{{ $z->id }}">{{ $z->name }}</option>
                @endforeach
            </select>
        </div>



        {{-- Table --}}
        <div id="stats-container">
            @include('user.zakat.partials.stats')
        </div>

        <div id="table-container">
            @include('user.zakat.partials.table')
        </div>

    </div>

    <script>
        function filterHandler() {
            return {
                search: '',
                perumahan: '',
                rt: '',
                zakat: '',




                fetchData(pageUrl = null) {

                    let baseUrl = `{{ route('user.zakat.index') }}`;

                    let url = typeof pageUrl === 'string' ?
                        pageUrl :
                        baseUrl;

                    let params = new URLSearchParams({
                        search: this.search,
                        perumahan: this.perumahan,
                        rt: this.rt,
                        zakat: this.zakat
                    });

                    fetch(url + '?' + params.toString(), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.json()) // ⬅️ UBAH KE JSON
                        .then(response => {

                            document.getElementById('table-container').innerHTML = response.table;
                            document.getElementById('stats-container').innerHTML = response.stats;

                        });
                }
            }
        }

        function loadTable() {
            fetch("{{ route('zakat-payments.data') }}")
                .then(response => response.text())
                .then(data => {
                    document.getElementById("zakat-table").innerHTML = data;
                });
        }

        setInterval(loadTable, 3000); // reload tiap 5 detik
    </script>
</x-app-layout>
