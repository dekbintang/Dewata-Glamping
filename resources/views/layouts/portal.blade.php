<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GlampERP - @yield('title', 'Glamping Booking')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-white text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <span class="text-lg font-bold text-gray-800">GlampERP</span>
            </a>
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">Beranda</a>
                <a href="{{ route('booking') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">Booking</a>
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">Staff Login</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 border-t border-gray-100 mt-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-7 h-7 bg-blue-600 rounded-md flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <span class="font-bold text-gray-800">GlampERP</span>
                    </div>
                    <p class="text-sm text-gray-500">Sistem informasi terintegrasi untuk manajemen glamping modern.</p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="{{ route('home') }}" class="hover:text-gray-800">Beranda</a></li>
                        <li><a href="{{ route('booking') }}" class="hover:text-gray-800">Booking Online</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li>📍 Jl. Alam Indah No. 1, Indonesia</li>
                        <li>📞 +62 812 3456 7890</li>
                        <li>📧 info@glamperp.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-200 mt-8 pt-6 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} GlampERP. All rights reserved.
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
