@extends('layouts.app')

@section('title', 'Profil Saya')
@section('header', 'Profil')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">
        {{-- Profile Card --}}
        <div class="bg-gray-50 rounded-2xl p-6">
            <div class="flex items-center gap-5 mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold shadow-lg shadow-emerald-500/20">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    <span class="inline-block mt-1.5 px-3 py-0.5 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 capitalize">
                        {{ Auth::user()->roles->pluck('name')->implode(', ') }}
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-400 uppercase font-semibold mb-1">Status</p>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                        <p class="text-sm font-medium text-gray-700">Aktif</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-400 uppercase font-semibold mb-1">Bergabung Sejak</p>
                    <p class="text-sm font-medium text-gray-700">{{ Auth::user()->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Update Profile Form --}}
        <div class="bg-gray-50 rounded-2xl p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Ubah Informasi Profil</h3>
            <form action="{{ route('erp.settings.profil') }}" method="GET" class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Nama Lengkap</label>
                    <input type="text" value="{{ Auth::user()->name }}" disabled class="block w-full rounded-xl border-gray-200 bg-white text-sm text-gray-700 py-2.5">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Email</label>
                    <input type="email" value="{{ Auth::user()->email }}" disabled class="block w-full rounded-xl border-gray-200 bg-white text-sm text-gray-700 py-2.5">
                </div>
            </form>
        </div>

        {{-- Change Password --}}
        <div class="bg-gray-50 rounded-2xl p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Ubah Password</h3>
            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                @method('put')
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Password Saat Ini</label>
                    <input type="password" name="current_password" class="block w-full rounded-xl border-gray-200 text-sm focus:border-emerald-500 focus:ring-emerald-500 py-2.5">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Password Baru</label>
                        <input type="password" name="password" class="block w-full rounded-xl border-gray-200 text-sm focus:border-emerald-500 focus:ring-emerald-500 py-2.5">
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="block w-full rounded-xl border-gray-200 text-sm focus:border-emerald-500 focus:ring-emerald-500 py-2.5">
                    </div>
                </div>
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium px-5 py-2.5 rounded-xl transition-colors text-sm">
                    Simpan Password Baru
                </button>
            </form>
        </div>
    </div>
@endsection
