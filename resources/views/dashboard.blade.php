<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-4 md:py-8">
        <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
            @php
                $hour = now()->hour;
                $greeting = $hour < 12 ? 'Selamat Pagi' : ($hour < 15 ? 'Selamat Siang' : ($hour < 18 ? 'Selamat Sore' : 'Selamat Malam'));
                $userRole = strtolower(Auth::user()->role ?? 'admin');
            @endphp

            <div class="mb-6 overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-blue-800 to-cyan-700 p-4 text-white shadow-2xl shadow-blue-900/20 md:p-8">
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                    <div>
                        <div class="mb-3 inline-flex items-center rounded-full bg-white/15 px-3 py-1 text-sm font-medium backdrop-blur">
                            <span class="mr-2">🎵</span> Sistem Informasi Rental Studio Musik
                        </div>
                        <h1 class="mb-2 text-2xl font-bold md:text-4xl">{{ $greeting }}, {{ Auth::user()->name }}!</h1>
                        <p class="text-sm text-blue-100 md:text-base">Pantau transaksi, stok, dan pendapatan secara real-time.</p>
                    </div>
                    <div class="rounded-2xl border border-white/20 bg-white/10 px-4 py-3 backdrop-blur">
                        <p class="text-xs uppercase tracking-[0.3em] text-blue-100">Hari ini</p>
                        <p class="mt-1 text-lg font-semibold">{{ now()->format('l, d F Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                @if(in_array($userRole, ['admin', 'owner']))
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pelanggan</p>
                        <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalPelanggan }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Studio</p>
                        <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalStudio }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Alat</p>
                        <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalAlat }}</p>
                    </div>
                @endif
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Booking</p>
                    <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalBooking }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Rental</p>
                    <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalRental }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pembayaran</p>
                    <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalPembayaran }}</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pendapatan</p>
                    <p class="mt-2 text-2xl font-bold text-emerald-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="mb-8 grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-lg font-bold text-slate-800">Booking Terbaru</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-slate-200 text-left text-slate-600">
                                    <th class="py-2">Studio</th>
                                    <th class="py-2">Pelanggan</th>
                                    <th class="py-2">Status</th>
                                    <th class="py-2 text-right">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookingTerbaru as $booking)
                                    <tr class="border-b border-slate-100">
                                        <td class="py-3 text-slate-700">{{ $booking->studio->nama_studio ?? 'N/A' }}</td>
                                        <td class="py-3 text-slate-700">{{ $booking->pelanggan->nama ?? 'N/A' }}</td>
                                        <td class="py-3"><span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $booking->status == 'Selesai' ? 'bg-green-100 text-green-700' : ($booking->status == 'Batal' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">{{ $booking->status }}</span></td>
                                        <td class="py-3 text-right font-semibold text-slate-800">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="py-4 text-center text-slate-500">Tidak ada booking.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-lg font-bold text-slate-800">Rental Terbaru</h2>
                    <div class="space-y-3">
                        @forelse($rentalTerbaru as $rental)
                            <div class="border-b border-slate-100 pb-3 last:border-b-0">
                                <p class="font-semibold text-slate-700">{{ $rental->pelanggan->nama ?? 'N/A' }}</p>
                                <p class="text-sm text-slate-500">{{ $rental->alatBand->nama_alat ?? 'N/A' }}</p>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="text-xs font-semibold {{ $rental->status == 'Dikembalikan' ? 'text-green-600' : 'text-blue-600' }}">{{ $rental->status }}</span>
                                    <span class="text-sm font-semibold text-slate-800">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-sm text-slate-500">Tidak ada rental.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-bold text-slate-800">Statistik Sistem</h2>
                <canvas id="dashboardChart"></canvas>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-lg font-bold text-slate-800">Grafik Booking Studio per Bulan</h3>
                    <canvas id="bookingChart"></canvas>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-lg font-bold text-slate-800">Grafik Rental Alat per Bulan</h3>
                    <canvas id="rentalChart"></canvas>
                </div>
            </div>

            <script>
            const ctx = document.getElementById('dashboardChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Pelanggan', 'Studio', 'Alat', 'Booking', 'Rental'],
                    datasets: [{
                        label: 'Jumlah Data',
                        data: [{{ $totalPelanggan }}, {{ $totalStudio }}, {{ $totalAlat }}, {{ $totalBooking }}, {{ $totalRental }}],
                        backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6']
                    }]
                },
                options: { responsive: true, plugins: { legend: { display: false } } }
            });
            const bookingCtx = document.getElementById('bookingChart');
            new Chart(bookingCtx, {
                type: 'bar',
                data: {
                    labels: [@foreach($bookingChart as $item)'{{ $item->bulan }}',@endforeach],
                    datasets: [{ label: 'Booking', data: [@foreach($bookingChart as $item){{ $item->total }},@endforeach], backgroundColor: ['#3B82F6'] }]
                },
                options: { responsive: true }
            });
            const rentalCtx = document.getElementById('rentalChart');
            new Chart(rentalCtx, {
                type: 'line',
                data: {
                    labels: [@foreach($rentalChart as $item)'{{ $item->bulan }}',@endforeach],
                    datasets: [{ label: 'Rental', data: [@foreach($rentalChart as $item){{ $item->total }},@endforeach], borderColor: '#EF4444', fill: false, tension: 0.3 }]
                },
                options: { responsive: true }
            });
            </script>
        </div>
    </div>
</x-app-layout>