<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Rental Alat
    </h1>

    <a href="{{ route('rental-alat.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">

        Tambah Rental

    </a>

    <table class="table-auto w-full mt-5 border">

        <thead>

            <tr class="bg-gray-200">

                <th class="border p-2">No</th>
                <th class="border p-2">Pelanggan</th>
                <th class="border p-2">Alat Band</th>
                <th class="border p-2">Tanggal Sewa</th>
                <th class="border p-2">Tanggal Kembali</th>
                <th class="border p-2">Jumlah</th>
                <th class="border p-2">Total Harga</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @forelse($rentalAlat as $item)

            <tr>

                <td class="border p-2">
                    {{ $loop->iteration }}
                </td>

                <td class="border p-2">
                    {{ $item->pelanggan->nama ?? '-' }}
                </td>

                <td class="border p-2">
                    {{ $item->alatBand->nama_alat ?? '-' }}
                </td>

                <td class="border p-2">
                    {{ $item->tanggal_sewa }}
                </td>

                <td class="border p-2">
                    {{ $item->tanggal_kembali }}
                </td>

                <td class="border p-2">
                    {{ $item->jumlah }}
                </td>

                <td class="border p-2">
                    Rp {{ number_format($item->total_harga) }}
                </td>

                <td class="border p-2">
                    {{ $item->status }}
                </td>

                <td class="border p-2">

                    <a href="{{ route('rental-alat.edit', $item->id) }}"
                       class="bg-yellow-400 px-3 py-1 rounded">

                        Edit

                    </a>

                    <form action="{{ route('rental-alat.destroy', $item->id) }}"
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

            @empty

            <tr>

                <td colspan="9" class="border p-2 text-center">

                    Data rental alat masih kosong

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

</x-app-layout>