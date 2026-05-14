<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Data Laporan Rental
</h1>

<a href="{{ route('laporan-rental.create') }}"
   class="bg-blue-500 text-white px-4 py-2 rounded">

    Tambah Data

</a>

<table class="table-auto w-full mt-4 border">

<tr class="bg-gray-200">

    <th class="border p-2">Tanggal</th>
    <th class="border p-2">Total Transaksi</th>
    <th class="border p-2">Pendapatan</th>
    <th class="border p-2">Keterangan</th>
    <th class="border p-2">Aksi</th>

</tr>

@foreach($laporan as $item)

<tr>

<td class="border p-2">
    {{ $item->tanggal_laporan }}
</td>

<td class="border p-2">
    {{ $item->total_transaksi }}
</td>

<td class="border p-2">
    {{ $item->total_pendapatan }}
</td>

<td class="border p-2">
    {{ $item->keterangan }}
</td>

<td class="border p-2">

<a href="{{ route('laporan-rental.edit', $item->id) }}"
   class="bg-yellow-400 px-3 py-1 rounded">

    Edit

</a>

<form action="{{ route('laporan-rental.destroy', $item->id) }}"
      method="POST"
      class="inline">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="bg-red-500 text-white px-3 py-1 rounded">

        Hapus

    </button>

</form>

</td>

</tr>

@endforeach

</table>

</div>

</x-app-layout>