<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Dewata Glamping - Login</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            <!-- Left Side - Image -->
            <div class="hidden lg:flex lg:w-1/2 relative">
                <img src="/images/hero.png" alt="Dewata Glamping" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/90 via-emerald-900/50 to-transparent"></div>
                <div class="relative p-12 flex flex-col justify-end">
                    <div class="flex items-center gap-2.5 mb-6">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <span class="text-2xl font-bold text-white">Dewata Glamping</span>
                    </div>
                    <p class="text-emerald-100 text-lg leading-relaxed max-w-md">"Pengalaman glamping premium di jantung Pulau Dewata dengan pemandangan alam yang memukau."</p>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 bg-white">
                <div class="w-full max-w-sm">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden flex items-center gap-2.5 mb-8 justify-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <span class="text-xl font-bold text-gray-800">Dewata Glamping</span>
                    </div>

                    {{ $slot }}

                    <p class="text-xs text-gray-400 mt-8 text-center">&copy; {{ date('Y') }} Dewata Glamping. All rights reserved.</p>
                </div>
            </div>
        </div>
    </body>
</html>
