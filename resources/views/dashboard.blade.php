<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <div class="bg-white shadow rounded-lg p-6">

            <h1 class="text-2xl font-bold mb-2">
                Dashboard {{ auth()->user()->role }}
            </h1>

            <p class="text-gray-600 mb-6">
                Selamat datang, <strong>{{ auth()->user()->name }}</strong>
            </p>

            <div class="border-t pt-4">
                <p class="mb-4">
                    Role:
                    <span class="font-semibold text-blue-600">
                        {{ auth()->user()->role }}
                    </span>
                </p>

                {{-- Tombol Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
