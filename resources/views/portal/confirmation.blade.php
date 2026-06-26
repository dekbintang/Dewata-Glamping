@extends('layouts.portal')

@section('title', 'Booking Berhasil')

@section('content')
    <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
        <div class="bg-white rounded-xl border border-gray-200 p-8">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Booking Berhasil!</h1>
            <p class="text-gray-500 mb-6">Reservasi Anda telah berhasil dicatat. Silakan simpan kode booking berikut:</p>
            
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
                <p class="text-xs text-gray-400 uppercase font-semibold mb-1">Kode Booking Anda</p>
                <p class="text-2xl font-bold font-mono text-blue-600 tracking-wider">{{ $code }}</p>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 text-left text-sm text-blue-700 mb-6">
                <h4 class="font-semibold mb-2">Langkah Selanjutnya:</h4>
                <ul class="space-y-1 list-disc list-inside text-blue-600">
                    <li>Tim kami akan mengkonfirmasi reservasi Anda via telepon/email.</li>
                    <li>Tunjukkan kode booking saat check-in di resepsionis.</li>
                    <li>Pastikan untuk datang sebelum jam 14:00 pada tanggal check-in.</li>
                </ul>
            </div>

            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-lg transition-colors text-sm">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
@endsection
