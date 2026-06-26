@extends('layouts.app')

@section('title', 'DSS Harga Dinamis')
@section('header', 'DSS Harga (SAW)')

@section('content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Decision Support System - Simple Additive Weighting</h3>
            <p class="text-sm text-gray-400">Analisis rekomendasi harga dinamis berdasarkan data okupansi.</p>
        </div>
    </div>
    @livewire('dss-pricing-panel')
@endsection
