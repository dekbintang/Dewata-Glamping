@extends('layouts.app')

@section('title', 'Pesanan F&B')
@section('header', 'Pesanan F&B')

@section('content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Point of Sale - Food & Beverage</h3>
            <p class="text-sm text-gray-400">Pilih menu dan tagihkan ke kamar tamu.</p>
        </div>
    </div>
    @livewire('fnb-order-form')
@endsection
