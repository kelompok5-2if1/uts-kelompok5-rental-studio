<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Edit Booking Studio
    </h1>

    <form action="{{ route('booking-studio.update', $bookingStudio->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block mb-2">
                Pelanggan
            </label>

            <select name="pelanggan_id"
                    class="border rounded w-full p-2"
                    required>

                @foreach($pelanggan as $item)

                <option value="{{ $item->id }}"
                    {{ $bookingStudio->pelanggan_id == $item->id ? 'selected' : '' }}>

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

                @foreach($studio as $item)

                <option value="{{ $item->id }}"
                    {{ $bookingStudio->studio_id == $item->id ? 'selected' : '' }}>

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
                   value="{{ $bookingStudio->tanggal_booking }}"
                   class="border rounded w-full p-2"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Jam Mulai
            </label>

            <input type="time"
                   name="jam_mulai"
                   value="{{ $bookingStudio->jam_mulai }}"
                   class="border rounded w-full p-2"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Jam Selesai
            </label>

            <input type="time"
                   name="jam_selesai"
                   value="{{ $bookingStudio->jam_selesai }}"
                   class="border rounded w-full p-2"
                   required>

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Total Harga
            </label>

            <input type="number"
                   name="total_harga"
                   value="{{ $bookingStudio->total_harga }}"
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

                <option value="Pending"
                    {{ $bookingStudio->status == 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="Selesai"
                    {{ $bookingStudio->status == 'Selesai' ? 'selected' : '' }}>
                    Selesai
                </option>

                <option value="Batal"
                    {{ $bookingStudio->status == 'Batal' ? 'selected' : '' }}>
                    Batal
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