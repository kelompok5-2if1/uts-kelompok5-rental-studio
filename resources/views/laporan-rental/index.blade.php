<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Data Laporan Rental
</h1>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
    <a href="{{ route('laporan-rental.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">

        Tambah Data

    </a>
    <a href="{{ route('laporan-rental.export-pdf') }}"
       class="bg-red-500 text-white px-4 py-2 rounded">
        Export PDF
    </a>
    <a href="{{ route('laporan-rental.export.excel') }}"
        class="bg-green-600 text-white px-4 py-2 rounded">

        Export Excel

    </a>
    
    <form action="{{ route('laporan-rental.index') }}" method="GET" class="w-full md:w-auto">
        <div class="flex gap-2">
            <input type="text" 
                   name="search" 
                   value="{{ $search }}" 
                   placeholder="Cari tanggal atau total transaksi..."
                   class="px-4 py-2 border rounded w-full md:w-64">
            <button type="submit" 
                    class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                Cari
            </button>
            @if($search)
                <a href="{{ route('laporan-rental.index') }}" 
                   class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>

<div class="overflow-x-auto shadow rounded-lg">
    <table class="table-auto w-full border">

    <thead>
        <tr class="bg-gray-200">
            <th class="border p-2">No</th>
            <th class="border p-2">Tanggal</th>
            <th class="border p-2">Total Transaksi</th>
            <th class="border p-2">Pendapatan</th>
            <th class="border p-2">Keterangan</th>
            <th class="border p-2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($laporan as $item)

        <tr>

        <td class="border p-2">
            {{ $laporan->firstItem() + $loop->index }}
        </td>

        <td class="border p-2">
            {{ $item->tanggal_laporan }}
        </td>

        <td class="border p-2 text-center">
            {{ $item->total_transaksi }}
        </td>

        <td class="border p-2">
            Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}
        </td>

        <td class="border p-2">
            {{ $item->keterangan }}
        </td>

        <td class="border p-2 text-center">

        <a href="{{ route('laporan-rental.edit', $item->id) }}"
           class="bg-yellow-400 px-3 py-1 rounded text-sm hover:bg-yellow-500 transition">

            Edit

        </a>

        <form action="{{ route('laporan-rental.destroy', $item->id) }}"
              method="POST"
              class="inline">

            @csrf
            @method('DELETE')

            <button type="submit"
                    onclick="event.preventDefault(); confirmDelete(event);"
                    class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition">

                Hapus

            </button>

        </form>

        </td>

        </tr>

        @empty

        <tr>
            <td class="border p-2 text-center" colspan="6">
                Tidak ada data laporan rental
            </td>
        </tr>

        @endforelse
    </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $laporan->links() }}
</div>

</div>

</x-app-layout>