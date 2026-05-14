<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Edit Pembayaran
</h1>

<form action="{{ route('pembayaran.update', $pembayaran->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <select name="rental_alat_id"
            class="border p-2 w-full mb-3">

        @foreach($rental as $r)

        <option value="{{ $r->id }}"
            {{ $pembayaran->rental_alat_id == $r->id ? 'selected' : '' }}>

            Rental {{ $r->id }}

        </option>

        @endforeach

    </select>

    <input type="date"
           name="tanggal_bayar"
           value="{{ $pembayaran->tanggal_bayar }}"
           class="border p-2 w-full mb-3">

    <input type="text"
           name="metode_bayar"
           value="{{ $pembayaran->metode_bayar }}"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="total_bayar"
           value="{{ $pembayaran->total_bayar }}"
           class="border p-2 w-full mb-3">

    <select name="status"
            class="border p-2 w-full mb-3">

        <option value="Lunas"
            {{ $pembayaran->status == 'Lunas' ? 'selected' : '' }}>

            Lunas

        </option>

        <option value="Belum Lunas"
            {{ $pembayaran->status == 'Belum Lunas' ? 'selected' : '' }}>

            Belum Lunas

        </option>

    </select>

    <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded">

        Update

    </button>

</form>

</div>

</x-app-layout>