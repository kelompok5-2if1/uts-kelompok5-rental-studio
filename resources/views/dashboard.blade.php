<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Dashboard Rental Studio
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome -->
            <div class="bg-indigo-600 text-white rounded-xl shadow-lg p-6 mb-8">
                <h1 class="text-3xl font-bold">
                    Selamat Datang, {{ Auth::user()->name }}
                </h1>

                <p class="mt-2 text-indigo-100">
                    Sistem Informasi Rental Studio dan Alat Band
                </p>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500 text-sm">Total Pelanggan</h3>

                    <p class="text-3xl font-bold text-blue-600 mt-2">
                        {{ \App\Models\Pelanggan::count() }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500 text-sm">Total Studio</h3>

                    <p class="text-3xl font-bold text-green-600 mt-2">
                        {{ \App\Models\Studio::count() }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500 text-sm">Alat Band</h3>

                    <p class="text-3xl font-bold text-purple-600 mt-2">
                        {{ \App\Models\AlatBand::count() }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="text-gray-500 text-sm">Rental Alat</h3>

                    <p class="text-3xl font-bold text-red-600 mt-2">
                        {{ \App\Models\RentalAlat::count() }}
                    </p>
                </div>

            </div>

            <!-- Menu -->
            <div class="bg-white rounded-xl shadow-lg p-6">

                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Menu CRUD
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <a href="{{ url('/pelanggan') }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white p-6 rounded-xl transition duration-300 shadow">

                        <h3 class="text-xl font-bold mb-2">
                            Pelanggan
                        </h3>

                        <p>
                            Kelola data pelanggan.
                        </p>
                    </a>

                    <a href="{{ url('/kategori') }}"
                       class="bg-purple-500 hover:bg-purple-600 text-white p-6 rounded-xl transition duration-300 shadow">

                        <h3 class="text-xl font-bold mb-2">
                            Kategori
                        </h3>

                        <p>
                            Kelola kategori alat.
                        </p>
                    </a>

                    <a href="{{ url('/studio') }}"
                       class="bg-green-500 hover:bg-green-600 text-white p-6 rounded-xl transition duration-300 shadow">

                        <h3 class="text-xl font-bold mb-2">
                            Studio
                        </h3>

                        <p>
                            Kelola data studio.
                        </p>
                    </a>

                    <a href="{{ url('/alat-band') }}"
                       class="bg-orange-500 hover:bg-orange-600 text-white p-6 rounded-xl transition duration-300 shadow">

                        <h3 class="text-xl font-bold mb-2">
                            Alat Band
                        </h3>

                        <p>
                            Kelola alat musik.
                        </p>
                    </a>

                    <a href="{{ url('/booking-studio') }}"
                       class="bg-indigo-500 hover:bg-indigo-600 text-white p-6 rounded-xl transition duration-300 shadow">

                        <h3 class="text-xl font-bold mb-2">
                            Booking Studio
                        </h3>

                        <p>
                            Kelola booking studio.
                        </p>
                    </a>

                    <a href="{{ url('/rental-alat') }}"
                       class="bg-pink-500 hover:bg-pink-600 text-white p-6 rounded-xl transition duration-300 shadow">

                        <h3 class="text-xl font-bold mb-2">
                            Rental Alat
                        </h3>

                        <p>
                            Kelola rental alat band.
                        </p>
                    </a>

                    <a href="{{ url('/detail-rental') }}"
                       class="bg-teal-500 hover:bg-teal-600 text-white p-6 rounded-xl transition duration-300 shadow">

                        <h3 class="text-xl font-bold mb-2">
                            Detail Rental
                        </h3>

                        <p>
                            Kelola detail rental.
                        </p>
                    </a>

                    <a href="{{ url('/pembayaran') }}"
                       class="bg-red-500 hover:bg-red-600 text-white p-6 rounded-xl transition duration-300 shadow">

                        <h3 class="text-xl font-bold mb-2">
                            Pembayaran
                        </h3>

                        <p>
                            Kelola pembayaran.
                        </p>
                    </a>

                    <a href="{{ url('/laporan-rental') }}"
                       class="bg-gray-700 hover:bg-gray-800 text-white p-6 rounded-xl transition duration-300 shadow">

                        <h3 class="text-xl font-bold mb-2">
                            Laporan Rental
                        </h3>

                        <p>
                            Lihat laporan rental.
                        </p>
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>