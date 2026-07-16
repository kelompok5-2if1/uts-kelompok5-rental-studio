<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Studio Rental Musik') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 font-sans text-slate-900 antialiased">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.25),_transparent_35%),linear-gradient(135deg,_#020617_0%,_#0f172a_45%,_#1d4ed8_100%)]">
        <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-8 sm:px-6 lg:px-8">
            <header class="flex items-center justify-between rounded-full border border-white/15 bg-white/10 px-4 py-3 text-white backdrop-blur">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/90 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v18M3 8h18M6 8v10a2 2 0 002 2h8a2 2 0 002-2V8" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold">Studio Rental Musik</p>
                        <p class="text-xs text-blue-100">Sistem Informasi Operasional</p>
                    </div>
                </div>
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">
                        Ke Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">
                        Masuk Sekarang
                    </a>
                @endauth
            </header>

            <main class="flex flex-1 items-center">
                <div class="grid w-full gap-8 py-10 lg:grid-cols-[1.1fr_0.9fr] lg:py-16">
                    <div class="max-w-2xl text-white">
                        <div class="mb-5 inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3 py-1 text-sm font-medium text-blue-100 backdrop-blur">
                            <span class="mr-2">🎵</span> Modern, cepat, dan terintegrasi
                        </div>
                        <h1 class="text-4xl font-bold leading-tight sm:text-5xl lg:text-6xl">
                            Kelola booking studio dan rental alat dengan lebih nyaman.
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-slate-200">
                            Pantau pelanggan, studio, alat musik, transaksi, pembayaran, dan laporan dari satu dashboard yang siap digunakan untuk presentasi UAS.
                        </p>
                        <div class="mt-8 flex flex-wrap gap-3">
                            @auth
                                <a href="{{ route('dashboard') }}" class="rounded-2xl bg-blue-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:bg-blue-600">
                                    Lihat Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="rounded-2xl bg-blue-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:bg-blue-600">
                                    Masuk ke Sistem
                                </a>
                            @endauth
                            <a href="#fitur" class="rounded-2xl border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/20">
                                Lihat Fitur Utama
                            </a>
                        </div>
                    </div>

                    <div class="rounded-[2rem] border border-white/15 bg-white/90 p-6 shadow-2xl shadow-black/20 backdrop-blur sm:p-8">
                        <div class="rounded-[1.5rem] bg-slate-950 p-6 text-white">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-blue-300">Ringkasan</p>
                            <div class="mt-5 space-y-4">
                                <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
                                    <p class="text-sm text-slate-300">Booking Studio</p>
                                    <p class="mt-1 text-2xl font-semibold">Kelola jadwal secara real-time</p>
                                </div>
                                <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
                                    <p class="text-sm text-slate-300">Rental Alat</p>
                                    <p class="mt-1 text-2xl font-semibold">Pantau peminjaman dan pengembalian</p>
                                </div>
                                <div class="rounded-2xl border border-white/10 bg-white/10 p-4">
                                    <p class="text-sm text-slate-300">Laporan</p>
                                    <p class="mt-1 text-2xl font-semibold">Lihat pendapatan dan performa harian</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <section id="fitur" class="bg-slate-100 px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-blue-600">Fitur utama</p>
                <h2 class="mt-3 text-3xl font-bold text-slate-900">Semua kebutuhan studio rental ada di satu tempat</h2>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <div class="rounded-3xl bg-white p-6 shadow-sm">
                    <h3 class="text-xl font-semibold text-slate-900">Master Data</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Kelola pelanggan, studio, kategori, dan alat musik dengan panel yang rapi.</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-sm">
                    <h3 class="text-xl font-semibold text-slate-900">Transaksi</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Lakukan booking, rental, detail rental, dan pembayaran dengan alur yang jelas.</p>
                </div>
                <div class="rounded-3xl bg-white p-6 shadow-sm">
                    <h3 class="text-xl font-semibold text-slate-900">Laporan</h3>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Pantau tren pendapatan dan lihat ringkasan operasional dengan cepat.</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
