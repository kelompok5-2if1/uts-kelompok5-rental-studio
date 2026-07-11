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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col items-center justify-center bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.25),_transparent_40%),linear-gradient(135deg,_#0f172a_0%,_#1e3a8a_50%,_#2563eb_100%)] px-4 py-10">
            <div class="mb-6 rounded-full border border-white/20 bg-white/10 p-3 shadow-lg backdrop-blur">
                <a href="/">
                    <x-application-logo class="h-16 w-16 fill-current text-white" />
                </a>
            </div>

            <div class="w-full max-w-md overflow-hidden rounded-3xl border border-white/20 bg-white/90 p-2 shadow-2xl shadow-black/20 backdrop-blur">
                <div class="rounded-[1.3rem] bg-white p-6 sm:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
