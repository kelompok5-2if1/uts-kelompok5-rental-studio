<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Tambah Laporan Rental
</h1>

<form action="{{ route('laporan-rental.store') }}"
      method="POST">

    @csrf

    <input type="date"
           name="tanggal_laporan"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="total_transaksi"
           placeholder="Total Transaksi"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="total_pendapatan"
           placeholder="Total Pendapatan"
           class="border p-2 w-full mb-3">

    <textarea name="keterangan"
              placeholder="Keterangan"
              class="border p-2 w-full mb-3"></textarea>

    <button type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded">

        Simpan

    </button>

</form>

</div>

</x-app-layout>