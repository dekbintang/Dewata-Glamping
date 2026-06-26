@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Overview')

@section('content')
    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Reservasi Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $totalReservasi }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-2">Total reservasi masuk hari ini</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Tamu Check-in</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $okupansiHariIni }}</p>
                </div>
                <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-2">Tamu yang sedang menginap</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pendapatan Bulan Ini</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">Rp {{ number_format($pendapatanBulanIni / 1000000, 1, ',', '.') }}jt</p>
                </div>
                <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-2">Total invoice yang sudah dibayar</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Unit Tersedia</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $unitTersedia }}</p>
                </div>
                <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-2">Siap untuk tamu baru</p>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-700">Pendapatan 7 Hari Terakhir</h3>
                <span class="text-xs text-gray-400">Last 7 days</span>
            </div>
            <div id="revenue-chart" style="min-height: 280px;"></div>
        </div>

        <!-- Occupancy Donut -->
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-700">Status Unit</h3>
                <span class="text-xs text-gray-400">Real-time</span>
            </div>
            <div id="occupancy-donut" style="min-height: 280px;"></div>
        </div>
    </div>

    <!-- Unit Status Grid -->
    <div class="bg-white rounded-xl border border-gray-200 p-5 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-700">Status Unit Real-time</h3>
            <span class="text-xs text-gray-400">Auto-refresh</span>
        </div>
        @livewire('unit-status-grid')
    </div>

    <!-- Recent Reservations -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-700">Reservasi Terbaru</h3>
            <a href="{{ route('erp.transaksi.reservasi.index') }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <th class="px-5 py-3 text-left font-semibold">Kode Booking</th>
                        <th class="px-5 py-3 text-left font-semibold">Tamu</th>
                        <th class="px-5 py-3 text-left font-semibold">Unit</th>
                        <th class="px-5 py-3 text-left font-semibold">Check-in</th>
                        <th class="px-5 py-3 text-left font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach(\App\Models\Reservation::with(['customer','unit'])->latest()->limit(5)->get() as $res)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3 font-mono text-xs font-semibold text-gray-700">{{ $res->booking_code }}</td>
                        <td class="px-5 py-3">
                            <p class="font-medium text-gray-800">{{ $res->customer->name }}</p>
                            <p class="text-xs text-gray-400">{{ $res->customer->phone }}</p>
                        </td>
                        <td class="px-5 py-3 text-gray-600">{{ $res->unit->unit_name }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $res->check_in_date->format('d M Y') }}</td>
                        <td class="px-5 py-3"><x-status-badge :status="$res->status" /></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    @endpush

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Revenue Area Chart
            var revenueOptions = {
                chart: { type: 'area', height: 280, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
                colors: ['#3B82F6'],
                series: [{
                    name: 'Pendapatan (Rp)',
                    data: [
                        @php
                            $data = [];
                            for ($i = 6; $i >= 0; $i--) {
                                $day = \Carbon\Carbon::today()->subDays($i);
                                $total = \App\Models\Invoice::whereDate('invoice_date', $day)->where('status', 'paid')->sum('total_amount');
                                $data[] = $total;
                            }
                            echo implode(',', $data);
                        @endphp
                    ]
                }],
                xaxis: {
                    categories: [
                        @php
                            $cats = [];
                            for ($i = 6; $i >= 0; $i--) {
                                $cats[] = "'" . \Carbon\Carbon::today()->subDays($i)->format('d M') . "'";
                            }
                            echo implode(',', $cats);
                        @endphp
                    ],
                    labels: { style: { colors: '#9CA3AF', fontSize: '11px' } },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        style: { colors: '#9CA3AF', fontSize: '11px' },
                        formatter: function(val) { return 'Rp ' + (val / 1000).toFixed(0) + 'k'; }
                    }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05 } },
                grid: { borderColor: '#F3F4F6', strokeDashArray: 4 },
                tooltip: {
                    y: { formatter: function(val) { return 'Rp ' + val.toLocaleString('id-ID'); } }
                }
            };
            new ApexCharts(document.querySelector("#revenue-chart"), revenueOptions).render();

            // Unit Status Donut
            var donutOptions = {
                chart: { type: 'donut', height: 280, fontFamily: 'Inter, sans-serif' },
                colors: ['#22C55E', '#EF4444', '#F59E0B', '#94A3B8'],
                series: [
                    {{ \App\Models\UnitGlamping::where('status', 'available')->count() }},
                    {{ \App\Models\UnitGlamping::where('status', 'occupied')->count() }},
                    {{ \App\Models\UnitGlamping::where('status', 'cleaning')->count() }},
                    {{ \App\Models\UnitGlamping::where('status', 'maintenance')->count() }}
                ],
                labels: ['Tersedia', 'Terisi', 'Dibersihkan', 'Perawatan'],
                legend: { position: 'bottom', fontSize: '12px', labels: { colors: '#6B7280' } },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                total: { show: true, label: 'Total Unit', fontSize: '12px', color: '#9CA3AF' }
                            }
                        }
                    }
                },
                dataLabels: { enabled: false },
                stroke: { width: 2, colors: ['#fff'] }
            };
            new ApexCharts(document.querySelector("#occupancy-donut"), donutOptions).render();
        });
    </script>
@endsection
