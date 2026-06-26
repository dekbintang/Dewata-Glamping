@extends('layouts.app')

@section('title', 'Proses Check-in')
@section('header', 'Check-in')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="bg-blue-600 p-5 text-white flex items-center gap-3">
                <div class="bg-white/20 p-2.5 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold">Proses Check-in Tamu</h2>
                    <p class="text-blue-100 text-sm">Masukkan kode booking untuk memproses kedatangan.</p>
                </div>
            </div>
            
            <div class="p-6">
                <form action="{{ route('erp.transaksi.checkin.process') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="booking_code" class="block text-sm font-medium text-gray-700 mb-1.5">Kode Booking</label>
                        <div class="relative">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <input type="text" name="booking_code" id="booking_code" required autofocus
                                class="pl-10 block w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 uppercase tracking-wider py-3" 
                                placeholder="Contoh: BKG-XXXXXX">
                        </div>
                        @error('booking_code') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition-colors text-sm">
                        Proses Check-in
                    </button>
                </form>

                <div class="mt-6 bg-gray-50 border border-gray-100 rounded-lg p-4">
                    <h4 class="text-xs font-semibold text-gray-500 uppercase mb-2">Panduan Staff</h4>
                    <ul class="text-sm text-gray-600 space-y-1 list-disc list-inside">
                        <li>Pastikan identitas tamu sesuai dengan data pemesanan.</li>
                        <li>Ingatkan tamu mengenai tata tertib glamping.</li>
                        <li>Tawarkan paket F&B premium saat kedatangan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
