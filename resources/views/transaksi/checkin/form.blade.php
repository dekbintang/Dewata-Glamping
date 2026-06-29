@extends('layouts.app')

@section('title', 'Check-in / Check-out')
@section('header', 'Check-in / Out')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Check-in Form --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-semibold text-gray-800">Proses Check-in</h2>
                                <p class="text-xs text-gray-400">Masukkan kode booking tamu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <form action="{{ route('erp.transaksi.checkin.preview') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="booking_code" class="block text-xs font-medium text-gray-500 mb-1.5">Kode Booking</label>
                                <input type="text" name="booking_code" id="booking_code" required autofocus
                                    class="block w-full rounded-xl border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 uppercase tracking-wider py-2.5" 
                                    placeholder="GLP-XXXXXX" value="{{ old('booking_code') }}">
                                @error('booking_code') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-xl transition-colors text-sm">
                                Cari & Preview
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Daftar Reservasi Siap Check-in --}}
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gray-800">Reservasi Siap Check-in</h3>
                        <span class="text-xs bg-green-50 text-green-600 font-medium px-2.5 py-1 rounded-full">Confirmed</span>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @php
                            $readyReservations = \App\Models\Reservation::with(['customer', 'unit'])
                                ->where('status', 'confirmed')
                                ->whereDate('check_in_date', '<=', now())
                                ->orderBy('check_in_date')
                                ->get();
                        @endphp
                        @forelse($readyReservations as $res)
                            <div class="p-4 hover:bg-gray-50 transition-colors flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 bg-gray-100 rounded-full flex items-center justify-center text-sm font-semibold text-gray-600">
                                        {{ substr($res->customer->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">{{ $res->customer->name }}</p>
                                        <p class="text-xs text-gray-400">{{ $res->booking_code }} · {{ $res->unit->unit_name }}</p>
                                    </div>
                                </div>
                                <form action="{{ route('erp.transaksi.checkin.preview') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="booking_code" value="{{ $res->booking_code }}">
                                    <button type="submit" class="text-xs bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium px-3 py-1.5 rounded-lg transition-colors">
                                        Check-in →
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="p-8 text-center text-gray-400 text-sm">
                                Tidak ada reservasi yang siap check-in saat ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Daftar Tamu Sedang Menginap (Siap Check-out) --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-orange-50 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-800">Tamu Sedang Menginap</h3>
                        <p class="text-xs text-gray-400">Klik "Check-out" untuk memproses tagihan dan keberangkatan.</p>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 text-xs uppercase tracking-wider border-b border-gray-50">
                            <th class="px-5 py-3 text-left font-medium">Tamu</th>
                            <th class="px-5 py-3 text-left font-medium">Unit</th>
                            <th class="px-5 py-3 text-left font-medium">Check-in</th>
                            <th class="px-5 py-3 text-left font-medium">Rencana Check-out</th>
                            <th class="px-5 py-3 text-left font-medium">Durasi</th>
                            <th class="px-5 py-3 text-right font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @php
                            $checkedInReservations = \App\Models\Reservation::with(['customer', 'unit'])
                                ->where('status', 'checked_in')
                                ->orderBy('check_out_date')
                                ->get();
                        @endphp
                        @forelse($checkedInReservations as $res)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-xs font-semibold text-blue-700">
                                            {{ substr($res->customer->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $res->customer->name }}</p>
                                            <p class="text-xs text-gray-400 font-mono">{{ $res->booking_code }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3 text-gray-600">{{ $res->unit->unit_name }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $res->check_in_date->format('d M Y') }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $res->check_out_date->format('d M Y') }}</td>
                                <td class="px-5 py-3">
                                    <span class="text-xs bg-gray-100 text-gray-600 font-medium px-2 py-1 rounded-full">{{ $res->total_nights }} malam</span>
                                </td>
                                <td class="px-5 py-3 text-right">
                                    <a href="{{ route('erp.transaksi.checkout.form', $res->reservation_id) }}" class="inline-flex items-center gap-1.5 text-xs bg-orange-50 hover:bg-orange-100 text-orange-600 font-medium px-3 py-1.5 rounded-lg transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"></path></svg>
                                        Check-out
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-8 text-center text-gray-400 text-sm">Tidak ada tamu yang sedang menginap.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
