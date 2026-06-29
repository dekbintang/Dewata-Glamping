@extends('layouts.app')

@section('title', 'Konfirmasi Check-in')
@section('header', 'Konfirmasi Check-in')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-gray-50 rounded-2xl p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Konfirmasi Data Check-in</h2>
                    <p class="text-xs text-gray-400">Pastikan data di bawah sudah benar sebelum proses check-in.</p>
                </div>
            </div>

            {{-- Data Tamu --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 mb-4">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Data Tamu</h3>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white text-lg font-bold">
                        {{ substr($reservation->customer->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ $reservation->customer->name }}</p>
                        <p class="text-sm text-gray-500">{{ $reservation->customer->email }} · {{ $reservation->customer->phone }}</p>
                    </div>
                </div>
            </div>

            {{-- Detail Reservasi --}}
            <div class="bg-white rounded-xl border border-gray-100 p-5 mb-4">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Detail Reservasi</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs">Kode Booking</p>
                        <p class="font-mono font-semibold text-gray-800">{{ $reservation->booking_code }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Unit</p>
                        <p class="font-semibold text-gray-800">{{ $reservation->unit->unit_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Check-in</p>
                        <p class="text-gray-700">{{ $reservation->check_in_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Check-out</p>
                        <p class="text-gray-700">{{ $reservation->check_out_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Durasi</p>
                        <p class="text-gray-700">{{ $reservation->total_nights }} malam</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">Status</p>
                        <x-status-badge :status="$reservation->status" />
                    </div>
                </div>
                @if($reservation->special_request)
                    <div class="mt-3 pt-3 border-t border-gray-100">
                        <p class="text-gray-400 text-xs">Permintaan Khusus</p>
                        <p class="text-sm text-gray-700 mt-1">{{ $reservation->special_request }}</p>
                    </div>
                @endif
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-3">
                <a href="{{ route('erp.transaksi.checkin.form') }}" class="flex-1 bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium py-2.5 rounded-xl text-center transition-colors text-sm">
                    ← Kembali
                </a>
                <form action="{{ route('erp.transaksi.checkin.process') }}" method="POST" class="flex-1" x-data="{ submitting: false }" @submit="submitting = true">
                    @csrf
                    <input type="hidden" name="reservation_id" value="{{ $reservation->reservation_id }}">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-xl transition-colors text-sm flex justify-center items-center gap-2"
                            x-bind:disabled="submitting" x-bind:class="{ 'opacity-70 cursor-not-allowed': submitting }">
                        <svg x-show="!submitting" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <svg x-show="submitting" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span x-text="submitting ? 'Memproses...' : 'Konfirmasi Check-in'"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
