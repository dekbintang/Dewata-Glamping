@extends('layouts.portal')

@section('title', 'Booking Berhasil')

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center px-4 py-16">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xl shadow-gray-200/50 p-8 text-center">
                <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Booking Berhasil! 🎉</h1>
                <p class="text-gray-500 mb-6">Reservasi Anda di Dewata Glamping telah berhasil dicatat.</p>
                
                <div class="bg-gray-50 rounded-xl p-5 mb-6">
                    <p class="text-xs text-gray-400 uppercase font-semibold tracking-wider mb-2">Kode Booking Anda</p>
                    <p class="text-3xl font-bold font-mono text-emerald-600 tracking-wider">{{ $code }}</p>
                </div>

                <div class="bg-emerald-50 rounded-xl p-4 text-left text-sm mb-6 border border-emerald-100">
                    <h4 class="font-semibold text-emerald-800 mb-2">Langkah Selanjutnya:</h4>
                    <ul class="space-y-1.5 text-emerald-700">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Tim kami akan mengkonfirmasi via telepon/WhatsApp.
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Tunjukkan kode booking saat check-in.
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Check-in mulai pukul 14:00 WITA.
                        </li>
                    </ul>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('home') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2.5 rounded-xl transition-colors text-sm text-center">
                        Beranda
                    </a>
                    <a href="{{ route('booking') }}" class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-2.5 rounded-xl transition-colors text-sm text-center">
                        Booking Lagi
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
