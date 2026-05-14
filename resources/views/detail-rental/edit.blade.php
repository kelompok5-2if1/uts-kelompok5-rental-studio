<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Detail Rental
</h1>

<a href="{{ route('detail-rental.create') }}"
   class="bg-blue-500 text-white px-4 py-2 rounded">

    Tambah Data

</a>

<table class="table-auto w-full mt-4 border">

<tr class="bg-gray-200">

    <th class="border p-2">Rental</th>
    <th class="border p-2">Alat</th>
    <th class="border p-2">Jumlah</th>
    <th class="border p-2">Durasi</th>
    <th class="border p-2">Subtotal</th>
    <th class="border p-2">Aksi</th>

</tr>

@foreach($detailRental as $item)

<tr>

<td class="border p-2">
    {{ $item->rental_alat_id }}
</td>

<td class="border p-2">
    {{ $item->alat_band_id }}
</td>

<td class="border p-2">
    {{ $item->jumlah }}
</td>

<td class="border p-2">
    {{ $item->durasi }}
</td>

<td class="border p-2">
    {{ $item->subtotal }}
</td>

<td class="border p-2">

<a href="{{ route('detail-rental.edit', $item->id) }}"
   class="bg-yellow-400 px-3 py-1 rounded">

    Edit

</a>

<form action="{{ route('detail-rental.destroy', $item->id) }}"
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