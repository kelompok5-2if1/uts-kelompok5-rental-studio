<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Tambah Pembayaran
</h1>

<form action="{{ route('pembayaran.store') }}"
      method="POST">

    @csrf

    <select name="rental_alat_id"
            class="border p-2 w-full mb-3">

        @foreach($rental as $r)

        <option value="{{ $r->id }}">
            Rental {{ $r->id }}
        </option>

        @endforeach

    </select>

    <input type="date"
           name="tanggal_bayar"
           class="border p-2 w-full mb-3">

    <input type="text"
           name="metode_bayar"
           placeholder="Metode Bayar"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="total_bayar"
           placeholder="Total Bayar"
           class="border p-2 w-full mb-3">

    <select name="status"
            class="border p-2 w-full mb-3">

        <option value="Lunas">Lunas</option>
        <option value="Belum Lunas">Belum Lunas</option>

    </select>

    <button type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded">

        Simpan

    </button>

</form>

</div>

</x-app-layout>