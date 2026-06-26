@extends('layouts.app')

@section('title', 'Data Reservasi')
@section('header', 'Reservasi')

@section('content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Reservasi</h3>
            <p class="text-sm text-gray-400">Kelola semua reservasi tamu glamping.</p>
        </div>
        <a href="{{ route('erp.transaksi.reservasi.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Reservasi
        </a>
    </div>

    @livewire('reservation-table')
@endsection
