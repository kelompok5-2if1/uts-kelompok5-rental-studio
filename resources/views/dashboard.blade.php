<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-4 md:py-8">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">

            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg shadow-lg p-4 md:p-8 mb-6 md:mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h1 class="text-2xl md:text-4xl font-bold mb-2">
                            👋 Selamat Datang, {{ Auth::user()->name }}!
                        </h1>
                        <p class="text-blue-100 text-sm md:text-base">
                            Sistem Informasi Rental Studio dan Alat Band
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <p class="text-blue-100 text-xs md:text-sm">
                            📅 {{ now()->format('l, d F Y') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8">

                <!-- Total Pelanggan -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 p-4 md:p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs md:text-sm font-semibold uppercase tracking-wide">
                                Total Pelanggan
                            </p>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">
                                {{ $totalPelanggan }}
                            </p>
                        </div>
                        <div class="text-4xl opacity-20">👤</div>
                    </div>
                </div>

                <!-- Total Studio -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 p-4 md:p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs md:text-sm font-semibold uppercase tracking-wide">
                                Total Studio
                            </p>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">
                                {{ $totalStudio }}
                            </p>
                        </div>
                        <div class="text-4xl opacity-20">🎤</div>
                    </div>
                </div>

                <!-- Alat Band -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 p-4 md:p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs md:text-sm font-semibold uppercase tracking-wide">
                                Alat Band
                            </p>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">
                                {{ $totalAlat }}
                            </p>
                        </div>
                        <div class="text-4xl opacity-20">🎸</div>
                    </div>
                </div>

                <!-- Total Booking -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 p-4 md:p-6 border-l-4 border-orange-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs md:text-sm font-semibold uppercase tracking-wide">
                                Total Booking
                            </p>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">
                                {{ $totalBooking }}
                            </p>
                        </div>
                        <div class="text-4xl opacity-20">📅</div>
                    </div>
                </div>

                <!-- Total Rental -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 p-4 md:p-6 border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs md:text-sm font-semibold uppercase tracking-wide">
                                Total Rental
                            </p>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">
                                {{ $totalRental }}
                            </p>
                        </div>
                        <div class="text-4xl opacity-20">🎁</div>
                    </div>
                </div>

                <!-- Total Pendapatan -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 p-4 md:p-6 border-l-4 border-cyan-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-xs md:text-sm font-semibold uppercase tracking-wide">
                                Total Pendapatan
                            </p>
                            <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">
                                Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-4xl opacity-20">💳</div>
                    </div>
                </div>

            </div>

            <!-- Statistics Cards (Tambahan Baru) -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-5 mb-6 md:mb-8">
                <div class="bg-white p-5 rounded-xl shadow">
                    <h3 class="text-gray-500">Pelanggan</h3>
                    <p class="text-3xl font-bold">
                        {{ $totalPelanggan }}
                    </p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow">
                    <h3 class="text-gray-500">Studio</h3>
                    <p class="text-3xl font-bold">
                        {{ $totalStudio }}
                    </p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow">
                    <h3 class="text-gray-500">Alat Band</h3>
                    <p class="text-3xl font-bold">
                        {{ $totalAlat }}
                    </p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow">
                    <h3 class="text-gray-500">Booking</h3>
                    <p class="text-3xl font-bold">
                        {{ $totalBooking }}
                    </p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow">
                    <h3 class="text-gray-500">Rental</h3>
                    <p class="text-3xl font-bold">
                        {{ $totalRental }}
                    </p>
                </div>
                <div class="bg-green-600 text-white p-5 rounded-xl shadow">
                    <h3>Total Pendapatan</h3>
                    <p class="text-2xl font-bold">
                        Rp {{ number_format($totalPendapatan,0,',','.') }}
                    </p>
                </div>
            </div>

            <!-- Latest Transactions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                <!-- Latest Bookings -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-4 md:p-6">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <span class="text-2xl mr-2">📋</span>
                        Booking Terbaru
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-xs md:text-sm">
                            <thead>
                                <tr class="border-b-2 border-gray-200">
                                    <th class="text-left py-2 px-2 md:px-4 font-semibold text-gray-600">Studio</th>
                                    <th class="text-left py-2 px-2 md:px-4 font-semibold text-gray-600">Pelanggan</th>
                                    <th class="text-left py-2 px-2 md:px-4 font-semibold text-gray-600">Status</th>
                                    <th class="text-right py-2 px-2 md:px-4 font-semibold text-gray-600">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookingTerbaru as $booking)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 px-2 md:px-4 text-gray-700">
                                        {{ $booking->studio->nama_studio ?? 'N/A' }}
                                    </td>
                                    <td class="py-3 px-2 md:px-4 text-gray-700">
                                        {{ $booking->pelanggan->nama ?? 'N/A' }}
                                    </td>
                                    <td class="py-3 px-2 md:px-4">
                                        <span class="px-2 py-1 rounded-full text-white text-xs font-semibold
                                            {{ $booking->status == 'Selesai' ? 'bg-green-500' : ($booking->status == 'Batal' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-2 md:px-4 text-gray-700 text-right font-semibold">
                                        Rp. {{ number_format($booking->total_harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-4 px-2 md:px-4 text-center text-gray-500">
                                        Tidak ada booking
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Latest Rentals -->
                <div class="bg-white rounded-lg shadow-lg p-4 md:p-6">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <span class="text-2xl mr-2">🎁</span>
                        Rental Terbaru
                    </h2>
                    <div class="space-y-3">
                        @forelse($rentalTerbaru as $rental)
                        <div class="border-b border-gray-200 pb-3 last:border-b-0">
                            <p class="font-semibold text-gray-700 text-sm">
                                {{ $rental->pelanggan->nama ?? 'N/A' }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $rental->alatBand->nama_alat ?? 'N/A' }}
                            </p>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-xs font-semibold
                                    {{ $rental->status == 'Dikembalikan' ? 'text-green-600' : 'text-blue-600' }}">
                                    {{ $rental->status }}
                                </span>
                                <span class="text-xs font-bold text-gray-700">
                                    Rp. {{ number_format($rental->total_harga, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <p class="text-center text-gray-500 py-4 text-sm">
                            Tidak ada rental
                        </p>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- Quick Menu -->
            <div class="bg-white rounded-lg shadow-lg p-4 md:p-6">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 md:mb-6">
                    ⚡ Menu Cepat
                </h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">

                    <a href="{{ url('/pelanggan') }}"
                       class="group bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-3 md:p-4 rounded-lg transition duration-300 shadow hover:shadow-lg">
                        <div class="text-2xl md:text-3xl mb-2">👤</div>
                        <h3 class="font-semibold text-xs md:text-sm">Pelanggan</h3>
                        <p class="text-xs text-blue-100 mt-1">Kelola data</p>
                    </a>

                    <a href="{{ url('/kategori') }}"
                       class="group bg-gradient-to-br from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white p-3 md:p-4 rounded-lg transition duration-300 shadow hover:shadow-lg">
                        <div class="text-2xl md:text-3xl mb-2">📂</div>
                        <h3 class="font-semibold text-xs md:text-sm">Kategori</h3>
                        <p class="text-xs text-purple-100 mt-1">Kelola alat</p>
                    </a>

                    <a href="{{ url('/studio') }}"
                       class="group bg-gradient-to-br from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white p-3 md:p-4 rounded-lg transition duration-300 shadow hover:shadow-lg">
                        <div class="text-2xl md:text-3xl mb-2">🎤</div>
                        <h3 class="font-semibold text-xs md:text-sm">Studio</h3>
                        <p class="text-xs text-green-100 mt-1">Kelola studio</p>
                    </a>

                    <a href="{{ url('/alat-band') }}"
                       class="group bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white p-3 md:p-4 rounded-lg transition duration-300 shadow hover:shadow-lg">
                        <div class="text-2xl md:text-3xl mb-2">🎸</div>
                        <h3 class="font-semibold text-xs md:text-sm">Alat Band</h3>
                        <p class="text-xs text-orange-100 mt-1">Kelola alat</p>
                    </a>

                    <a href="{{ url('/booking-studio') }}"
                       class="group bg-gradient-to-br from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white p-3 md:p-4 rounded-lg transition duration-300 shadow hover:shadow-lg">
                        <div class="text-2xl md:text-3xl mb-2">📅</div>
                        <h3 class="font-semibold text-xs md:text-sm">Booking</h3>
                        <p class="text-xs text-indigo-100 mt-1">Kelola booking</p>
                    </a>

                    <a href="{{ url('/rental-alat') }}"
                       class="group bg-gradient-to-br from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white p-3 md:p-4 rounded-lg transition duration-300 shadow hover:shadow-lg">
                        <div class="text-2xl md:text-3xl mb-2">🎁</div>
                        <h3 class="font-semibold text-xs md:text-sm">Rental</h3>
                        <p class="text-xs text-pink-100 mt-1">Kelola rental</p>
                    </a>

                    <a href="{{ url('/detail-rental') }}"
                       class="group bg-gradient-to-br from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white p-3 md:p-4 rounded-lg transition duration-300 shadow hover:shadow-lg">
                        <div class="text-2xl md:text-3xl mb-2">📝</div>
                        <h3 class="font-semibold text-xs md:text-sm">Detail</h3>
                        <p class="text-xs text-teal-100 mt-1">Kelola detail</p>
                    </a>

                    <a href="{{ url('/pembayaran') }}"
                       class="group bg-gradient-to-br from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700 text-white p-3 md:p-4 rounded-lg transition duration-300 shadow hover:shadow-lg">
                        <div class="text-2xl md:text-3xl mb-2">💳</div>
                        <h3 class="font-semibold text-xs md:text-sm">Pembayaran</h3>
                        <p class="text-xs text-cyan-100 mt-1">Kelola bayar</p>
                    </a>

                    <a href="{{ url('/laporan-rental') }}"
                       class="group bg-gradient-to-br from-slate-500 to-slate-600 hover:from-slate-600 hover:to-slate-700 text-white p-3 md:p-4 rounded-lg transition duration-300 shadow hover:shadow-lg">
                        <div class="text-2xl md:text-3xl mb-2">📊</div>
                        <h3 class="font-semibold text-xs md:text-sm">Laporan</h3>
                        <p class="text-xs text-slate-100 mt-1">Lihat laporan</p>
                    </a>

                </div>
            </div>

            <!-- Welcome Info -->
            <div class="bg-white shadow-lg rounded-lg mt-6 md:mt-8 p-4 md:p-6">
                <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3">
                    Selamat Datang
                </h3>
                <p class="text-gray-600">
                    Selamat datang di Sistem Informasi Rental Studio Musik.
                </p>
                <p class="mt-2 text-gray-600">
                    Login sebagai: <strong>{{ Auth::user()->name }}</strong>
                </p>
            </div>

            <!-- Statistik Sistem (Chart) -->
            <div class="bg-white p-6 rounded-xl shadow mt-8">
                <h2 class="text-xl font-bold mb-4">
                    Statistik Sistem
                </h2>
                <canvas id="dashboardChart"></canvas>
            </div>

            <script>
            const ctx =
                document.getElementById(
                    'dashboardChart'
                );
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        'Pelanggan',
                        'Studio',
                        'Alat',
                        'Booking',
                        'Rental'
                    ],
                    datasets: [{
                        label: 'Jumlah Data',
                        data: [
                            {{ $totalPelanggan }},
                            {{ $totalStudio }},
                            {{ $totalAlat }},
                            {{ $totalBooking }},
                            {{ $totalRental }}
                        ],
                        backgroundColor: [
                            '#3b82f6',
                            '#10b981',
                            '#f59e0b',
                            '#ef4444',
                            '#8b5cf6'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
            </script>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-bold mb-4">
                        Grafik Booking Studio
                    </h3>

                    <canvas id="bookingChart"></canvas>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-lg font-bold mb-4">
                        Grafik Rental Alat
                    </h3>

                    <canvas id="rentalChart"></canvas>
            </div>

            </div>

            <script>
const bookingLabel = @json(
    $bookingChart->pluck('bulan')
);

const bookingData = @json(
    $bookingChart->pluck('total')
);

new Chart(
    document.getElementById('bookingChart'),
    {
        type: 'bar',
        data: {
            labels: bookingLabel,
            datasets: [{
                label: 'Booking',
                data: bookingData
            }]
        }
    }
);

const rentalLabel = @json(
    $rentalChart->pluck('bulan')
);

const rentalData = @json(
    $rentalChart->pluck('total')
);

new Chart(
    document.getElementById('rentalChart'),
    {
        type: 'line',
        data: {
            labels: rentalLabel,
            datasets: [{
                label: 'Rental',
                data: rentalData
            }]
        }
    }
);
</script>

        </div>
    </div>

</x-app-layout>