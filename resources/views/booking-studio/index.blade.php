<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Booking Studio
    </h1>

    <a href="{{ route('booking-studio.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">

        Tambah Booking

    </a>

    <table class="table-auto w-full mt-5 border">

        <thead>

            <tr class="bg-gray-200">

                <th class="border p-2">No</th>
                <th class="border p-2">Pelanggan</th>
                <th class="border p-2">Studio</th>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Jam</th>
                <th class="border p-2">Total</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @foreach($bookingStudio as $item)

            <tr>

                <td class="border p-2">
                    {{ $loop->iteration }}
                </td>

                <td class="border p-2">
                    {{ $item->pelanggan->nama }}
                </td>

                <td class="border p-2">
                    {{ $item->studio->nama_studio }}
                </td>

                <td class="border p-2">
                    {{ $item->tanggal_booking }}
                </td>

                <td class="border p-2">
                    {{ $item->jam_mulai }}
                    -
                    {{ $item->jam_selesai }}
                </td>

                <td class="border p-2">
                    Rp {{ number_format($item->total_harga) }}
                </td>

                <td class="border p-2">
                    {{ $item->status }}
                </td>

                <td class="border p-2">

                    <a href="{{ route('booking-studio.edit', $item->id) }}"
                       class="bg-yellow-400 px-3 py-1 rounded">

                        Edit

                    </a>

                    <form action="{{ route('booking-studio.destroy', $item->id) }}"
                          method="POST"
                          class="inline">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

</x-app-layout>