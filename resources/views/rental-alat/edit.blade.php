<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Edit Rental Alat
    </h1>

    <form action="{{ route('rental-alat.update', $rentalAlat->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block mb-2">
                Pelanggan
            </label>

            <select name="pelanggan_id"
                    class="border rounded w-full p-2">

                @foreach($pelanggan as $item)

                <option value="{{ $item->id }}"
                    {{ $rentalAlat->pelanggan_id == $item->id ? 'selected' : '' }}>

                    {{ $item->nama }}

                </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Alat Band
            </label>

            <select name="alat_band_id"
                    class="border rounded w-full p-2">

                @foreach($alatBand as $item)

                <option value="{{ $item->id }}"
                    {{ $rentalAlat->alat_band_id == $item->id ? 'selected' : '' }}>

                    {{ $item->nama_alat }}

                </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Tanggal Sewa
            </label>

            <input type="date"
                   name="tanggal_sewa"
                   value="{{ $rentalAlat->tanggal_sewa }}"
                   class="border rounded w-full p-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Tanggal Kembali
            </label>

            <input type="date"
                   name="tanggal_kembali"
                   value="{{ $rentalAlat->tanggal_kembali }}"
                   class="border rounded w-full p-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Jumlah
            </label>

            <input type="number"
                   name="jumlah"
                   value="{{ $rentalAlat->jumlah }}"
                   class="border rounded w-full p-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Total Harga
            </label>

            <input type="number"
                   name="total_harga"
                   value="{{ $rentalAlat->total_harga }}"
                   class="border rounded w-full p-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Status
            </label>

            <select name="status"
                    class="border rounded w-full p-2">

                <option value="Dipinjam"
                    {{ $rentalAlat->status == 'Dipinjam' ? 'selected' : '' }}>
                    Dipinjam
                </option>

                <option value="Dikembalikan"
                    {{ $rentalAlat->status == 'Dikembalikan' ? 'selected' : '' }}>
                    Dikembalikan
                </option>

            </select>

        </div>

        <button type="submit"
                class="bg-yellow-500 text-white px-4 py-2 rounded">

            Update

        </button>

    </form>

</div>

</x-app-layout>