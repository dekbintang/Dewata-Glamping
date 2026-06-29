@extends('layouts.portal')

@section('title', 'Booking Online')

@section('content')
    <div class="relative">
        <div class="absolute inset-0 h-72">
            <img src="/images/nature.png" alt="Booking" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-emerald-900/80 to-emerald-900/95"></div>
        </div>
        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-16">
            <div class="text-center mb-8">
                <p class="text-emerald-300 text-sm font-medium uppercase tracking-wider mb-2">Dewata Glamping</p>
                <h1 class="text-3xl font-bold text-white mb-2">Pesan Unit Anda</h1>
                <p class="text-emerald-100/80">Pilih tanggal dan unit favorit Anda untuk pengalaman tak terlupakan.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl shadow-gray-300/30 p-6 md:p-8">
                @livewire('availability-checker')
            </div>
        </div>
    </div>
@endsection
