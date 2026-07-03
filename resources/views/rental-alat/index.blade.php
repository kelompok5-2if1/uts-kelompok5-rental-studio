<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Rental Alat
    </h1>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-5">
        <a href="{{ route('rental-alat.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">

            Tambah Rental

        </a>
        
        <form action="{{ route('rental-alat.index') }}" method="GET" class="w-full md:w-auto">
            <div class="flex flex-col md:flex-row gap-2">
                <input type="text" 
                       name="search" 
                       value="{{ $search }}" 
                       placeholder="Cari pelanggan atau alat..."
                       class="px-4 py-2 border rounded w-full md:w-48">
                <select name="status" 
                        class="px-4 py-2 border rounded w-full md:w-auto"
                        onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="Dipinjam" {{ $status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Dikembalikan" {{ $status == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
                <button type="submit" 
                        class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition whitespace-nowrap">
                    Cari
                </button>
                @if($search || $status)
                    <a href="{{ route('rental-alat.index') }}" 
                       class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition whitespace-nowrap">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

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