<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Data Pembayaran
</h1>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
    <a href="{{ route('pembayaran.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">

        Tambah Data

    </a>
    
    <form action="{{ route('pembayaran.index') }}" method="GET" class="w-full md:w-auto">
        <div class="flex flex-col md:flex-row gap-2">
            <input type="text" 
                   name="search" 
                   value="{{ $search }}" 
                   placeholder="Cari metode bayar..."
                   class="px-4 py-2 border rounded w-full md:w-48">
            <select name="status" 
                    class="px-4 py-2 border rounded w-full md:w-auto"
                    onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="Pending" {{ $status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Lunas" {{ $status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
            <button type="submit" 
                    class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition whitespace-nowrap">
                Cari
            </button>
            @if($search || $status)
                <a href="{{ route('pembayaran.index') }}" 
                   class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition whitespace-nowrap">
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
            <th class="border p-2">Metode</th>
            <th class="border p-2">Total</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($pembayaran as $item)

        <tr>

        <td class="border p-2">
            {{ $pembayaran->firstItem() + $loop->index }}
        </td>

        <td class="border p-2">
            {{ $item->tanggal_bayar }}
        </td>

        <td class="border p-2">
            {{ $item->metode_bayar }}
        </td>

        <td class="border p-2">
            Rp {{ number_format($item->total_bayar, 0, ',', '.') }}
        </td>

        <td class="border p-2 text-center">
            <span class="px-3 py-1 rounded text-white text-sm
                {{ $item->status == 'Lunas' ? 'bg-green-500' : 'bg-yellow-500' }}">
                {{ $item->status }}
            </span>
        </td>

        <td class="border p-2 text-center">

        <a href="{{ route('pembayaran.edit', $item->id) }}"
           class="bg-yellow-400 px-3 py-1 rounded text-sm hover:bg-yellow-500 transition">

            Edit

        </a>

        <form action="{{ route('pembayaran.destroy', $item->id) }}"
              method="POST"
              class="inline">

            @csrf
            @method('DELETE')

            <button type="submit"
                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                    class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition">

                Hapus

            </button>

        </form>

        </td>

        </tr>

        @empty

        <tr>
            <td class="border p-2 text-center" colspan="6">
                Tidak ada data pembayaran
            </td>
        </tr>

        @endforelse
    </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $pembayaran->links() }}
</div>

</div>

</x-app-layout>