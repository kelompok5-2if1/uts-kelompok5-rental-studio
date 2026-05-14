<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Edit Laporan Rental
</h1>

<form action="{{ route('laporan-rental.update', $laporan->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <input type="date"
           name="tanggal_laporan"
           value="{{ $laporan->tanggal_laporan }}"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="total_transaksi"
           value="{{ $laporan->total_transaksi }}"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="total_pendapatan"
           value="{{ $laporan->total_pendapatan }}"
           class="border p-2 w-full mb-3">

    <textarea name="keterangan"
              class="border p-2 w-full mb-3">{{ $laporan->keterangan }}</textarea>

    <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded">

        Update

    </button>

</form>

</div>

</x-app-layout>