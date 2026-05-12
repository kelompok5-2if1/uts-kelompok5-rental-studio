<x-app-layout>

<div class="p-6">

<h1 class="text-3xl font-bold mb-5">
    Tambah Alat Band
</h1>

<form action="{{ route('alat-band.store') }}"
      method="POST">

    @csrf

    <div class="mb-3">

        <label>Kategori</label>

        <select name="kategori_alat_id"
                class="border p-2 w-full">

            @foreach($kategori as $item)

                <option value="{{ $item->id }}">

                    {{ $item->nama_kategori }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Nama Alat</label>

        <input type="text"
               name="nama_alat"
               class="border p-2 w-full">

    </div>

    <div class="mb-3">

        <label>Stok</label>

        <input type="number"
               name="stok"
               class="border p-2 w-full">

    </div>

    <div class="mb-3">

        <label>Harga Sewa</label>

        <input type="number"
               name="harga_sewa"
               class="border p-2 w-full">

    </div>

    <div class="mb-3">

        <label>Kondisi</label>

        <select name="kondisi"
                class="border p-2 w-full">

            <option value="Baik">
                Baik
            </option>

            <option value="Rusak">
                Rusak
            </option>

        </select>

    </div>

    <button type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded">

        Simpan

    </button>

</form>

</div>

</x-app-layout>