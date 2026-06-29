@extends('layouts.app')

@section('title', 'Check-out & Billing')
@section('header', 'Check-out')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('erp.transaksi.checkin.form') }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h1 class="text-lg font-semibold text-gray-800">Check-out & Billing</h1>
                    <p class="text-xs text-gray-400 font-mono">{{ $reservation->booking_code }}</p>
                </div>
            </div>
            <span class="text-xs bg-blue-50 text-blue-600 font-medium px-3 py-1.5 rounded-full">{{ $billing['total_days'] }} Malam</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Info Tamu --}}
            <div class="space-y-4">
                <div class="bg-white rounded-2xl border border-gray-100 p-5">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Data Tamu</h3>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ substr($reservation->customer->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $reservation->customer->name }}</p>
                            <p class="text-xs text-gray-400">{{ $reservation->customer->email }}</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Telepon</span>
                            <span class="text-gray-700">{{ $reservation->customer->phone }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Unit</span>
                            <span class="text-gray-700 font-medium">{{ $reservation->unit->unit_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Tipe</span>
                            <span class="text-gray-700 capitalize">{{ $reservation->unit->unit_type }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-5">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Periode Menginap</h3>
                    <div class="flex items-center gap-3">
                        <div class="flex-1 text-center bg-gray-50 rounded-xl p-3">
                            <p class="text-xs text-gray-400">Check-in</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $reservation->check_in_date->format('d M Y') }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        <div class="flex-1 text-center bg-gray-50 rounded-xl p-3">
                            <p class="text-xs text-gray-400">Check-out</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $reservation->check_out_date->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Rincian Billing --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-100 p-5">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-5">Rincian Tagihan</h3>

                    <div class="space-y-4 mb-6">
                        {{-- Akomodasi --}}
                        <div class="flex justify-between items-start py-3 border-b border-gray-50">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Biaya Akomodasi</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $billing['total_days'] }} malam × Rp {{ number_format($reservation->unit->base_price, 0, ',', '.') }}</p>
                            </div>
                            <p class="text-sm font-medium text-gray-800">Rp {{ number_format($billing['accommodation_cost'], 0, ',', '.') }}</p>
                        </div>

                        {{-- F&B --}}
                        @if($billing['fnb_cost'] > 0)
                        <div class="flex justify-between items-start py-3 border-b border-gray-50">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Biaya F&B</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $reservation->fnbOrders->count() }} pesanan</p>
                            </div>
                            <p class="text-sm font-medium text-gray-800">Rp {{ number_format($billing['fnb_cost'], 0, ',', '.') }}</p>
                        </div>
                        @endif

                        {{-- DP --}}
                        @if($billing['dp_paid'] > 0)
                        <div class="flex justify-between items-start py-3 border-b border-gray-50">
                            <div>
                                <p class="text-sm font-medium text-green-600">DP yang Sudah Dibayar</p>
                            </div>
                            <p class="text-sm font-medium text-green-600">- Rp {{ number_format($billing['dp_paid'], 0, ',', '.') }}</p>
                        </div>
                        @endif
                    </div>

                    {{-- Grand Total --}}
                    <div class="bg-blue-50 rounded-xl p-4 flex justify-between items-center mb-6">
                        <p class="font-semibold text-gray-700">Total Tagihan</p>
                        <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($billing['grand_total'], 0, ',', '.') }}</p>
                    </div>

                    {{-- Actions --}}
                    <form action="{{ route('erp.transaksi.checkout.process', $reservation->reservation_id) }}" method="POST" x-data="{ submitting: false }" @submit="submitting = true">
                        @csrf
                        <div class="flex gap-3">
                            <a href="{{ route('erp.transaksi.checkin.form') }}" class="flex-1 bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium py-2.5 rounded-xl text-center transition-colors text-sm">
                                Kembali
                            </a>
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-xl transition-colors text-sm flex justify-center items-center gap-2"
                                    x-bind:disabled="submitting" x-bind:class="{ 'opacity-70 cursor-not-allowed': submitting }">
                                <svg x-show="!submitting" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <svg x-show="submitting" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                <span x-text="submitting ? 'Memproses...' : 'Proses Check-out'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
