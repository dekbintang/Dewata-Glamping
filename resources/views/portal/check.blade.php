@extends('layouts.portal')

@section('title', 'Cek Reservasi')

@section('content')
    <div class="relative">
        <div class="absolute inset-0 h-72">
            <img src="/images/nature.png" alt="Booking" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-emerald-900/80 to-emerald-900/95"></div>
        </div>
        <div class="relative max-w-lg mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-16">
            <div class="text-center mb-8">
                <p class="text-emerald-300 text-sm font-medium uppercase tracking-wider mb-2">Keamanan Data</p>
                <h1 class="text-3xl font-bold text-white mb-2">Verifikasi Reservasi</h1>
                <p class="text-emerald-100/80">Masukkan Kode Booking dan Email untuk melihat detail reservasi Anda.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl shadow-gray-300/30 p-6 md:p-8">
                @if(session('error'))
                    <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('booking.verify') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Booking</label>
                            <input type="text" name="booking_code" value="{{ old('booking_code') }}" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Contoh: GLP-A1B2C3" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Pemesan</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Email saat memesan" required>
                        </div>
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-3 rounded-xl transition-colors mt-2">
                            Cek Reservasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
