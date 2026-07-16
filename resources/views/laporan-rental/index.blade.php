<x-app-layout>
@php
    $userRole = strtolower(Auth::user()->role ?? 'admin');
    $canManage = $userRole === 'admin';
    $canExport = in_array($userRole, ['admin', 'owner'], true);
@endphp

<div class="p-6">
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold text-slate-800">Laporan Rental</h1>
        <p class="mt-1 text-sm text-slate-500">Laporan menampilkan data booking, rental, dan pembayaran secara terintegrasi.</p>
    </div>

    <div class="mb-6 grid gap-4 md:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Total Booking</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $summary['total_booking'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Total Rental</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $summary['total_rental'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm text-slate-500">Total Pendapatan</p>
            <p class="mt-2 text-2xl font-bold text-emerald-600">Rp {{ number_format($summary['total_pendapatan'], 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="mb-6 flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm md:flex-row md:items-center md:justify-between">
        @if($canExport)
            <div class="flex gap-2">
                <a href="{{ route('laporan-rental.export-pdf') }}" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">Export PDF</a>
                <a href="{{ route('laporan-rental.export.excel') }}" class="rounded-xl bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">Export Excel</a>
            </div>
        @endif
        <form action="{{ route('laporan-rental.index') }}" method="GET" class="w-full md:w-auto">
            <div class="flex gap-2">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari pelanggan atau jenis transaksi..." class="w-full rounded-xl border border-slate-300 px-3 py-2 md:w-72">
                <button type="submit" class="rounded-xl bg-slate-700 px-4 py-2 text-sm font-semibold text-white">Cari</button>
                @if($search)
                    <a href="{{ route('laporan-rental.index') }}" class="rounded-xl bg-slate-400 px-4 py-2 text-sm font-semibold text-white">Reset</a>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Pelanggan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Jenis Transaksi</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Metode Pembayaran</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Total</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($laporan as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $item['pelanggan'] }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $item['jenis_transaksi'] }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $item['tanggal'] }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $item['metode_pembayaran'] }}</td>
                        <td class="px-4 py-3 text-sm font-semibold text-slate-800">Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $item['status'] === 'Lunas' || $item['status'] === 'Selesai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ $item['status'] }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-sm text-slate-500">Belum ada data laporan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>