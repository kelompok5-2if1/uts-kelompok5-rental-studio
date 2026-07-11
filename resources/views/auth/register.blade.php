<x-guest-layout>
    <div class="w-full max-w-md mx-auto">
        <div class="text-center mb-6">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-blue-600 text-white shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.5v2H12zM4 7h16M6 7v10a2 2 0 002 2h8a2 2 0 002-2V7" />
                </svg>
            </div>
            <h2 class="mt-4 text-2xl font-bold text-gray-800">Daftar Akun Baru</h2>
            <p class="mt-2 text-sm text-gray-600">Buat akun untuk mengakses sistem rental studio musik.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4 rounded-2xl border border-gray-200 bg-white/95 p-6 shadow-xl backdrop-blur">
            @csrf

            <div>
                <label for="name" class="mb-1 block text-sm font-semibold text-gray-700">Nama</label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 20a8 8 0 0116 0" />
                        </svg>
                    </span>
                    <x-text-input id="name" class="block w-full pl-10" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-semibold text-gray-700">Email</label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l9 6 9-6" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <x-text-input id="email" class="block w-full pl-10" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-semibold text-gray-700">Password</label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7a3 3 0 00-6 0v4M6 11h12a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2z" />
                        </svg>
                    </span>
                    <x-text-input id="password" class="block w-full pl-10" type="password" name="password" required autocomplete="new-password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7a3 3 0 00-6 0v4M6 11h12a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6a2 2 0 012-2z" />
                        </svg>
                    </span>
                    <x-text-input id="password_confirmation" class="block w-full pl-10" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="pt-2">
                <x-primary-button class="w-full justify-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold shadow hover:bg-blue-700">
                    {{ __('Register') }}
                </x-primary-button>
            </div>

            <div class="text-center text-sm text-gray-600">
                Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-700">Masuk di sini</a>
            </div>
        </form>
    </div>
</x-guest-layout>
