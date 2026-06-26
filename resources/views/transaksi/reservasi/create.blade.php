@extends('layouts.app')

@section('title', 'Buat Reservasi')
@section('header', 'Reservasi')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('erp.transaksi.reservasi.index') }}" class="text-sm text-gray-400 hover:text-gray-600">← Kembali ke daftar</a>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-5">Formulir Reservasi Baru</h3>
            @livewire('availability-checker')
        </div>
    </div>
@endsection
