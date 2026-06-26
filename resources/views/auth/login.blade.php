<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <h2 class="text-lg font-bold text-gray-800">Masuk ke Sistem</h2>
        <p class="text-sm text-gray-400">Gunakan email dan password akun Anda.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block text-xs font-medium text-gray-500 mb-1.5">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="block w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div class="mt-4">
            <label for="password" class="block text-xs font-medium text-gray-500 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-500">Ingat saya</span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition-colors text-sm">
                Masuk
            </button>
        </div>
    </form>
</x-guest-layout>
