<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-white">Selamat Datang</h2>
        <p class="mt-2 text-white">Silakan masuk ke sistem Zakat Al Ikhlas TBS2</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-semibold text-gray-700" />
            <x-text-input id="email"
                class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="font-semibold text-gray-700" />
            <x-text-input id="password"
                class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="border-gray-300 rounded shadow-sm text-emerald-600 focus:ring-emerald-500" name="remember">
                <span class="text-sm text-white ms-2">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="flex flex-col gap-4 mt-6">
            <button
                class="w-full py-3 font-bold text-white transition shadow-lg bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-emerald-200">
                {{ __('Masuk Sekarang') }}
            </button>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="text-sm font-medium transition text-emerald-400 hover:text-emerald-800"
                        href="{{ route('password.request') }}">
                        {{ __('Lupa kata sandi?') }}
                    </a>
                </div>
            @endif
        </div>

        <div class="pt-6 mt-8 text-center border-t border-gray-100">
            <p class="text-sm text-white">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-emerald-400 hover:underline">Daftar di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>
