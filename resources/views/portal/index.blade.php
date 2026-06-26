@extends('layouts.portal')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-600 to-blue-800 overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Pengalaman Glamping Premium</h1>
            <p class="text-lg text-blue-100 mb-8 max-w-2xl mx-auto">Nikmati kemewahan berkemah di alam terbuka dengan fasilitas bintang lima. Booking sekarang dan ciptakan kenangan tak terlupakan.</p>
            <a href="{{ route('booking') }}" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-8 py-3 rounded-lg hover:bg-blue-50 transition-colors shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Booking Sekarang
            </a>
        </div>
    </section>

    <!-- Features -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Mengapa Memilih Kami?</h2>
            <p class="text-gray-500">Fasilitas lengkap untuk kenyamanan tamu.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Unit Premium</h3>
                <p class="text-sm text-gray-500">Tenda glamping dengan tempat tidur king-size, AC, dan kamar mandi privat.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-14 h-14 bg-green-50 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Lokasi Alam</h3>
                <p class="text-sm text-gray-500">Terletak di pegunungan dengan pemandangan alam yang menakjubkan.</p>
            </div>
            <div class="text-center p-6">
                <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">F&B Berkualitas</h3>
                <p class="text-sm text-gray-500">Menu restoran dengan bahan organik lokal dan sajian khas daerah.</p>
            </div>
        </div>
    </section>

    <!-- Available Units -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Tipe Unit Glamping</h2>
                <p class="text-gray-500">Pilih tipe akomodasi sesuai kebutuhan Anda.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach(\App\Models\UnitGlamping::all()->unique('unit_type') as $unit)
                    <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 capitalize mb-1">{{ $unit->unit_type }}</h3>
                        <p class="text-sm text-gray-500 mb-3">Kapasitas {{ $unit->capacity }} orang</p>
                        <p class="text-xl font-bold text-blue-600 mb-4">Rp {{ number_format($unit->base_price, 0, ',', '.') }} <span class="text-xs font-normal text-gray-400">/malam</span></p>
                        <a href="{{ route('booking') }}" class="block text-center bg-gray-50 hover:bg-blue-50 text-gray-700 hover:text-blue-700 font-medium py-2 rounded-lg transition-colors text-sm border border-gray-200 hover:border-blue-200">
                            Pesan Sekarang →
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-3">Siap untuk Petualangan?</h2>
        <p class="text-gray-500 mb-6">Pesan unit glamping Anda sekarang dan nikmati pengalaman menginap di alam.</p>
        <a href="{{ route('booking') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-3 rounded-lg transition-colors">
            Mulai Booking
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
    </section>
@endsection
