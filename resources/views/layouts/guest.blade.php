<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="min-h-screen flex flex-col items-center justify-center bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.25),_transparent_40%),linear-gradient(135deg,_#020617_0%,_#1d4ed8_45%,_#38bdf8_100%)] px-4 py-10">
            <div class="mb-6 flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2 shadow-lg backdrop-blur">
                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-white/90 text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v18M3 8h18M6 8v10a2 2 0 002 2h8a2 2 0 002-2V8" />
                    </svg>
                </div>
                <div class="text-left text-white">
                    <p class="text-sm font-semibold">Studio Rental Musik</p>
                    <p class="text-xs text-blue-100">Panel operasional</p>
                </div>
            </div>

            <div class="w-full max-w-md overflow-hidden rounded-[1.75rem] border border-white/20 bg-white/90 p-2 shadow-2xl shadow-black/20 backdrop-blur">
                <div class="rounded-[1.4rem] bg-white p-6 sm:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
