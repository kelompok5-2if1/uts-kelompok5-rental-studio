<x-app-layout>
@php
    $userRole = strtolower(Auth::user()->role ?? 'admin');
    $canManage = $userRole === 'admin';
    $canExport = in_array($userRole, ['admin', 'owner'], true);
@endphp

<div class="p-6">
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold text-slate-800">Detail Rental</h1>
        <p class="mt-1 text-sm text-slate-500">Halaman ini menampilkan transaksi rental sebagai detail operasional yang terhubung ke pelanggan dan alat.</p>
    </div>

    <div class="mb-6 flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm md:flex-row md:items-center md:justify-between">
        <div class="flex items-center gap-2 text-sm text-slate-600">
            <span class="rounded-full bg-blue-50 px-3 py-1 text-blue-700">Transaksi terhubung</span>
            <span>Data diambil dari rental alat yang sudah tersimpan</span>
        </div>
        @if($canExport)
            <a href="{{ route('detail-rental.export.excel') }}" class="rounded-xl bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">Export Excel</a>
        @endif
    </div>

    <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Pelanggan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Alat</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Jumlah</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Tanggal Sewa</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($detailRental as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $item->pelanggan->nama ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $item->alatBand->nama_alat ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $item->jumlah }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $item->tanggal_sewa }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $item->status === 'Dikembalikan' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">{{ $item->status }}</span>
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold text-slate-800">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-sm text-slate-500">Belum ada data detail rental.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $detailRental->links() }}
    </div>
</div>
</x-app-layout>