@extends('layouts.portal')

@section('title', 'Booking Online')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Booking Online</h1>
            <p class="text-gray-500">Cari ketersediaan unit dan pesan langsung secara online.</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6">
            @livewire('availability-checker')
        </div>
    </div>
@endsection
