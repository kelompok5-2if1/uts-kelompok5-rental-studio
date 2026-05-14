<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Tambah Detail Rental
</h1>

<form action="{{ route('detail-rental.store') }}"
      method="POST">

    @csrf

    <select name="rental_alat_id"
            class="border p-2 w-full mb-3">

        @foreach($rental as $r)

        <option value="{{ $r->id }}">
            {{ $r->id }}
        </option>

        @endforeach

    </select>

    <select name="alat_band_id"
            class="border p-2 w-full mb-3">

        @foreach($alat as $a)

        <option value="{{ $a->id }}">
            {{ $a->nama_alat }}
        </option>

        @endforeach

    </select>

    <input type="number"
           name="jumlah"
           placeholder="Jumlah"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="durasi"
           placeholder="Durasi"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="subtotal"
           placeholder="Subtotal"
           class="border p-2 w-full mb-3">

    <button type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded">

        Simpan

    </button>

</form>

</div>

</x-app-layout>