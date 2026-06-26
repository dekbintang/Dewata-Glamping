@extends('layouts.app')

@section('title', 'Profil Saya')
@section('header', 'Pengaturan')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-5">Informasi Profil</h3>
            <div class="space-y-4 text-sm">
                <div>
                    <label class="block text-xs font-medium text-gray-400 uppercase mb-1">Nama Lengkap</label>
                    <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-400 uppercase mb-1">Email</label>
                    <p class="text-gray-600">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-400 uppercase mb-1">Role</label>
                    <span class="px-2 py-0.5 text-xs font-medium rounded-md bg-blue-50 text-blue-700 border border-blue-200 capitalize">
                        {{ Auth::user()->roles->pluck('name')->implode(', ') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
