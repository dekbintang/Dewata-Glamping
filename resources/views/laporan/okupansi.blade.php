@extends('layouts.app')

@section('title', 'Laporan Okupansi')
@section('header', 'Laporan Okupansi')

@section('content')
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-gray-800">Laporan Tingkat Okupansi</h3>
        <p class="text-sm text-gray-400">Analisis tingkat hunian unit glamping.</p>
    </div>

    @php
        $totalUnits = \App\Models\UnitGlamping::count();
        $occupied = \App\Models\UnitGlamping::where('status', 'occupied')->count();
        $rate = $totalUnits > 0 ? round(($occupied / $totalUnits) * 100, 1) : 0;
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase">Total Unit</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalUnits }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase">Unit Terisi</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $occupied }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase">Tingkat Okupansi</p>
            <p class="text-2xl font-bold text-blue-600 mt-1">{{ $rate }}%</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h4 class="text-sm font-semibold text-gray-700 mb-4">Okupansi per Unit</h4>
        <div id="okupansi-chart" style="min-height: 300px;"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new ApexCharts(document.querySelector("#okupansi-chart"), {
                chart: { type: 'bar', height: 300, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
                colors: ['#3B82F6'],
                series: [{
                    name: 'Status',
                    data: [
                        {{ \App\Models\UnitGlamping::where('status', 'available')->count() }},
                        {{ \App\Models\UnitGlamping::where('status', 'occupied')->count() }},
                        {{ \App\Models\UnitGlamping::where('status', 'cleaning')->count() }},
                        {{ \App\Models\UnitGlamping::where('status', 'maintenance')->count() }}
                    ]
                }],
                xaxis: { categories: ['Tersedia', 'Terisi', 'Dibersihkan', 'Perawatan'] },
                plotOptions: { bar: { borderRadius: 6, columnWidth: '50%' } },
                dataLabels: { enabled: false },
                grid: { borderColor: '#F3F4F6', strokeDashArray: 4 }
            }).render();
        });
    </script>
@endsection
