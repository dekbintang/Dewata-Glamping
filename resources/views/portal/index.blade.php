@extends('layouts.portal')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Section with Photo --}}
    <section class="relative h-[85vh] min-h-[600px] overflow-hidden">
        <img src="/images/hero.png" alt="Dewata Glamping Resort" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="max-w-xl">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md text-white text-xs font-medium px-3 py-1.5 rounded-full mb-5 border border-white/20">
                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    Premium Glamping Experience
                </div>
                <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-5">
                    Dewata<br>
                    <span class="text-emerald-400">Glamping</span>
                </h1>
                <p class="text-gray-300 text-base md:text-lg mb-8 leading-relaxed">Rasakan keajaiban berkemah di tengah keindahan alam Bali dengan kenyamanan hotel bintang lima. Setiap momen adalah kenangan.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('booking') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-7 py-3.5 rounded-xl transition-all shadow-lg shadow-emerald-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Booking Sekarang
                    </a>
                    <a href="#units" class="inline-flex items-center gap-2 bg-white/10 backdrop-blur text-white font-medium px-7 py-3.5 rounded-xl hover:bg-white/20 transition-all border border-white/20">
                        Lihat Unit
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
        {{-- Scroll indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/50 animate-bounce">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </section>

    {{-- Stats Bar --}}
    <section class="bg-gray-900 py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <p class="text-2xl md:text-3xl font-bold text-white">50+</p>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mt-1">Unit Glamping</p>
                </div>
                <div>
                    <p class="text-2xl md:text-3xl font-bold text-white">4.9</p>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mt-1">Rating Tamu</p>
                </div>
                <div>
                    <p class="text-2xl md:text-3xl font-bold text-white">10K+</p>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mt-1">Tamu Puas</p>
                </div>
                <div>
                    <p class="text-2xl md:text-3xl font-bold text-white">24/7</p>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mt-1">Layanan</p>
                </div>
            </div>
        </div>
    </section>

    {{-- About --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="rounded-3xl overflow-hidden shadow-2xl shadow-gray-200">
                <img src="/images/nature.png" alt="Pemandangan Dewata Glamping" class="w-full h-[400px] object-cover">
            </div>
            <div>
                <p class="text-emerald-600 text-sm font-semibold uppercase tracking-wider mb-3">Tentang Kami</p>
                <h2 class="text-3xl font-bold text-gray-800 mb-5">Kemewahan di Tengah Alam Bali</h2>
                <p class="text-gray-500 leading-relaxed mb-6">Dewata Glamping hadir untuk memberikan pengalaman menginap yang tidak terlupakan. Terletak di dataran tinggi Ubud, dikelilingi hamparan sawah terasering dan hutan tropis yang masih asri.</p>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">AC, WiFi & Kamar Mandi Privat</p>
                            <p class="text-xs text-gray-400">Kenyamanan hotel bintang lima dalam suasana alam.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">Restoran & Bar</p>
                            <p class="text-xs text-gray-400">Menu organik lokal dan sajian internasional.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">Aktivitas & Spa</p>
                            <p class="text-xs text-gray-400">Yoga sunrise, trekking, dan Balinese spa treatment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Room Types --}}
    <section id="units" class="bg-gray-50 py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p class="text-emerald-600 text-sm font-semibold uppercase tracking-wider mb-2">Akomodasi</p>
                <h2 class="text-3xl font-bold text-gray-800 mb-3">Pilihan Unit Glamping</h2>
                <p class="text-gray-500 max-w-lg mx-auto">Setiap unit dirancang untuk memberikan kenyamanan maksimal dengan sentuhan alam Bali.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach(\App\Models\UnitGlamping::where('status', 'available')->get()->unique('unit_type') as $unit)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100">
                        <div class="relative h-52 overflow-hidden">
                            <img src="/images/tent.png" alt="{{ $unit->unit_type }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur text-xs font-semibold text-emerald-700 px-3 py-1 rounded-full">
                                {{ $unit->capacity }} Tamu
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-800 capitalize mb-1">{{ $unit->unit_type }}</h3>
                            <p class="text-xs text-gray-400 mb-4">{{ $unit->description ?? 'AC · WiFi · Kamar Mandi Privat · Sarapan' }}</p>
                            <div class="flex items-end justify-between pt-3 border-t border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-400">Mulai dari</p>
                                    <p class="text-xl font-bold text-gray-800">Rp {{ number_format($unit->base_price, 0, ',', '.') }} <span class="text-xs font-normal text-gray-400">/malam</span></p>
                                </div>
                                <a href="{{ route('booking') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium px-4 py-2 rounded-xl transition-colors text-sm shadow-sm">
                                    Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Gallery --}}
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p class="text-emerald-600 text-sm font-semibold uppercase tracking-wider mb-2">Galeri</p>
                <h2 class="text-3xl font-bold text-gray-800">Momen di Dewata Glamping</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div class="rounded-2xl overflow-hidden h-64">
                    <img src="/images/hero.png" alt="Glamping Resort" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
                <div class="rounded-2xl overflow-hidden h-64 md:row-span-2">
                    <img src="/images/tent.png" alt="Interior Tent" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
                <div class="rounded-2xl overflow-hidden h-64">
                    <img src="/images/nature.png" alt="Nature View" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
                <div class="rounded-2xl overflow-hidden h-64 col-span-2 md:col-span-2">
                    <img src="/images/hero.png" alt="Dewata Glamping" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="pb-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-3xl overflow-hidden">
                <img src="/images/nature.png" alt="CTA Background" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/90 to-teal-800/80"></div>
                <div class="relative px-8 md:px-16 py-16 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Siap untuk Pengalaman Tak Terlupakan?</h2>
                    <p class="text-emerald-100 mb-8 max-w-lg mx-auto">Pesan unit glamping Anda sekarang dan nikmati keindahan alam Bali dengan kenyamanan premium.</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('booking') }}" class="inline-flex items-center gap-2 bg-white text-emerald-700 font-semibold px-8 py-3.5 rounded-xl hover:bg-emerald-50 transition-colors shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Booking Sekarang
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 bg-white/10 backdrop-blur text-white font-medium px-8 py-3.5 rounded-xl hover:bg-white/20 transition-all border border-white/20">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
