<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Tambah Booking Studio
    </h1>

    <form action="{{ route('booking-studio.store') }}"
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
                Studio
            </label>

            <select name="studio_id"
                    class="border rounded w-full p-2"
                    required>

                <option value="">
                    -- Pilih Studio --
                </option>

                @foreach($studio as $item)

                <option value="{{ $item->id }}">

                    {{ $item->nama_studio }}

                </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Tanggal Booking
            </label>

            <input type="date"
                   name="tanggal_booking"
                   class="border rounded w-full p-2"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Jam Mulai
            </label>

            <input type="time"
                   name="jam_mulai"
                   class="border rounded w-full p-2"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Jam Selesai
            </label>

            <input type="time"
                   name="jam_selesai"
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
                    class="border rounded w-full p-2"
                    required>

                <option value="Pending">
                    Pending
                </option>

                <option value="Selesai">
                    Selesai
                </option>

                <option value="Batal">
                    Batal
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