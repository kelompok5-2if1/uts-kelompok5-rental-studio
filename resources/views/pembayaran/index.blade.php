<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Data Pembayaran
</h1>

<a href="{{ route('pembayaran.create') }}"
   class="bg-blue-500 text-white px-4 py-2 rounded">

    Tambah Data

</a>

<table class="table-auto w-full mt-4 border">

<tr class="bg-gray-200">

    <th class="border p-2">Rental</th>
    <th class="border p-2">Tanggal</th>
    <th class="border p-2">Metode</th>
    <th class="border p-2">Total</th>
    <th class="border p-2">Status</th>
    <th class="border p-2">Aksi</th>

</tr>

@foreach($pembayaran as $item)

<tr>

<td class="border p-2">
    {{ $item->rental_alat_id }}
</td>

<td class="border p-2">
    {{ $item->tanggal_bayar }}
</td>

<td class="border p-2">
    {{ $item->metode_bayar }}
</td>

<td class="border p-2">
    {{ $item->total_bayar }}
</td>

<td class="border p-2">
    {{ $item->status }}
</td>

<td class="border p-2">

<a href="{{ route('pembayaran.edit', $item->id) }}"
   class="bg-yellow-400 px-3 py-1 rounded">

    Edit

</a>

<form action="{{ route('pembayaran.destroy', $item->id) }}"
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