<x-app-layout>

<div class="p-6">

<h1 class="text-3xl font-bold mb-5">
    Edit Alat Band
</h1>

<form action="{{ route('alat-band.update', $alatBand->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Kategori</label>

        <select name="kategori_alat_id"
                class="border p-2 w-full">

            @foreach($kategori as $item)

                <option value="{{ $item->id }}"
                    {{ $alatBand->kategori_alat_id == $item->id ? 'selected' : '' }}>

                    {{ $item->nama_kategori }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Nama Alat</label>

        <input type="text"
               name="nama_alat"
               value="{{ $alatBand->nama_alat }}"
               class="border p-2 w-full">

    </div>

    <div class="mb-3">

        <label>Stok</label>

        <input type="number"
               name="stok"
               value="{{ $alatBand->stok }}"
               class="border p-2 w-full">

    </div>

    <div class="mb-3">

        <label>Harga Sewa</label>

        <input type="number"
               name="harga_sewa"
               value="{{ $alatBand->harga_sewa }}"
               class="border p-2 w-full">

    </div>

    <div class="mb-3">

        <label>Kondisi</label>

        <select name="kondisi"
                class="border p-2 w-full">

            <option value="Baik"
                {{ $alatBand->kondisi == 'Baik' ? 'selected' : '' }}>

                Baik

            </option>

            <option value="Rusak"
                {{ $alatBand->kondisi == 'Rusak' ? 'selected' : '' }}>

                Rusak

            </option>

        </select>

    </div>

    <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded">

        Update

    </button>

</form>

</div>

</x-app-layout>