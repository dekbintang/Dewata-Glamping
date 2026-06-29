<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang 👋</h2>
        <p class="text-sm text-gray-400 mt-1">Masuk ke sistem ERP Dewata Glamping.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block text-xs font-medium text-gray-500 mb-1.5">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="block w-full rounded-xl border-gray-200 text-sm focus:border-emerald-500 focus:ring-emerald-500 py-2.5">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div class="mt-4">
            <label for="password" class="block text-xs font-medium text-gray-500 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-xl border-gray-200 text-sm focus:border-emerald-500 focus:ring-emerald-500 py-2.5">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500" name="remember">
                <span class="ms-2 text-sm text-gray-500">Ingat saya</span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold py-3 rounded-xl transition-all text-sm shadow-lg shadow-emerald-500/20">
                Masuk
            </button>
        </div>
    </form>
</x-guest-layout>
