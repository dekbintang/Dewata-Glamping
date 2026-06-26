@extends('layouts.app')

@section('title', 'Check-out & Billing')
@section('header', 'Check-out')

@section('content')
    <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Info Tamu -->
        <div class="space-y-4">
            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <h3 class="text-sm font-semibold text-gray-700 mb-3 pb-2 border-b border-gray-100">Informasi Tamu</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-semibold">Nama</p>
                        <p class="font-medium text-gray-800">{{ $reservation->customer->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-semibold">Telepon</p>
                        <p class="text-gray-600">{{ $reservation->customer->phone }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-semibold">Unit</p>
                        <p class="font-medium text-gray-800">{{ $reservation->unit->unit_name }}</p>
                        <p class="text-xs text-gray-400">{{ $reservation->unit->unit_type }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Check-in</p>
                            <p class="text-gray-600">{{ $reservation->check_in_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-semibold">Check-out</p>
                            <p class="text-gray-600">{{ $reservation->check_out_date->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rincian Billing -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <div class="flex justify-between items-end mb-5 pb-3 border-b border-gray-100">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Rincian Tagihan</h3>
                        <p class="text-xs text-gray-400 font-mono">{{ $reservation->booking_code }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400">Durasi</p>
                        <p class="text-lg font-bold text-gray-800">{{ $billing['total_days'] }} Malam</p>
                    </div>
                </div>

                <div class="space-y-3 mb-6 text-sm">
                    <div class="flex justify-between py-2">
                        <div>
                            <p class="font-medium text-gray-800">Biaya Akomodasi</p>
                            <p class="text-xs text-gray-400">{{ $billing['total_days'] }} malam × Rp {{ number_format($reservation->unit->base_price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-medium text-gray-800">Rp {{ number_format($billing['accommodation_cost'], 0, ',', '.') }}</p>
                    </div>
                    
                    @if($billing['fnb_cost'] > 0)
                    <div class="flex justify-between py-2 border-t border-dashed border-gray-200">
                        <div>
                            <p class="font-medium text-gray-800">Biaya F&B</p>
                            <p class="text-xs text-gray-400">Total pesanan makanan & minuman</p>
                        </div>
                        <p class="font-medium text-gray-800">Rp {{ number_format($billing['fnb_cost'], 0, ',', '.') }}</p>
                    </div>
                    @endif
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 mb-6 flex justify-between items-center">
                    <p class="font-semibold text-gray-700">Grand Total</p>
                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($billing['grand_total'], 0, ',', '.') }}</p>
                </div>

                <form action="{{ route('erp.transaksi.checkout.process', $reservation->reservation_id) }}" method="POST">
                    @csrf
                    <div class="flex gap-3">
                        <a href="{{ route('erp.transaksi.reservasi.index') }}" class="flex-1 bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium py-2.5 rounded-lg text-center transition-colors text-sm">
                            Batal
                        </a>
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition-colors text-sm flex justify-center items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Proses Check-out & Cetak Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
