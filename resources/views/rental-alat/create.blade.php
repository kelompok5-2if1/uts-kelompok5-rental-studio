<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Tambah Rental Alat
    </h1>

    <form action="{{ route('rental-alat.store') }}"
          method="POST">

        @csrf

        <div class="mb-4">

            <label class="block mb-2">
                Pelanggan
            </label>

            <select name="pelanggan_id"
                    class="border rounded w-full p-2"
                    required>

                <option value="">
                    -- Pilih Pelanggan --
                </option>

                @foreach($pelanggan as $item)

                <option value="{{ $item->id }}">

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
                    class="border rounded w-full p-2"
                    required>

                <option value="">
                    -- Pilih Alat --
                </option>

                @foreach($alatBand as $item)

                <option value="{{ $item->id }}">

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
                   class="border rounded w-full p-2"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Tanggal Kembali
            </label>

            <input type="date"
                   name="tanggal_kembali"
                   class="border rounded w-full p-2"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Jumlah
            </label>

            <input type="number"
                   name="jumlah"
                   class="border rounded w-full p-2"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Total Harga
            </label>

            <input type="number"
                   name="total_harga"
                   class="border rounded w-full p-2"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Status
            </label>

            <select name="status"
                    class="border rounded w-full p-2">

                <option value="Dipinjam">
                    Dipinjam
                </option>

                <option value="Dikembalikan">
                    Dikembalikan
                </option>

            </select>

        </div>

        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded">

            Simpan

        </button>

    </form>

</div>

</x-app-layout>