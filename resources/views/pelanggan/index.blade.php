<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Data Pelanggan
    </h1>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-5">
        <a href="{{ route('pelanggan.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition whitespace-nowrap">
            Tambah Data
        </a>

         <a href="{{ route('pelanggan.export.excel') }}"
        class="bg-green-600 text-white px-4 py-2 rounded">

        Export Excel

        </a>

        <form action="{{ route('pelanggan.index') }}" method="GET" class="w-full md:w-auto">
            <div class="flex flex-col md:flex-row gap-2">
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Cari nama, email, no HP, atau alamat..."
                       class="px-4 py-2 border rounded w-full md:w-64">
                <select name="filter"
                        class="px-4 py-2 border rounded w-full md:w-auto"
                        onchange="this.form.submit()">
                    <option value="">Semua Pelanggan</option>
                    <option value="booking" {{ $filter == 'booking' ? 'selected' : '' }}>Punya Booking Studio</option>
                    <option value="rental" {{ $filter == 'rental' ? 'selected' : '' }}>Punya Rental Alat</option>
                    <option value="baru" {{ $filter == 'baru' ? 'selected' : '' }}>Belum Ada Transaksi</option>
                </select>
                <button type="submit"
                        class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition whitespace-nowrap">
                    Cari
                </button>
                @if($search || $filter)
                    <a href="{{ route('pelanggan.index') }}"
                       class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition whitespace-nowrap text-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-x-auto shadow rounded-lg">
        <table class="min-w-full table-auto w-full border">

            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2 whitespace-nowrap">No</th>
                    <th class="border p-2 whitespace-nowrap">Nama</th>
                    <th class="border p-2 whitespace-nowrap">No HP</th>
                    <th class="border p-2 whitespace-nowrap">Email</th>
                    <th class="border p-2 whitespace-nowrap">Alamat</th>
                    <th class="border p-2 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pelanggan as $item)
                <tr>
                    <td class="border p-2 text-center whitespace-nowrap">
                        {{ $pelanggan->firstItem() + $loop->index }}
                    </td>
                    <td class="border p-2 whitespace-nowrap">
                        {{ $item->nama }}
                    </td>
                    <td class="border p-2 whitespace-nowrap">
                        {{ $item->no_hp }}
                    </td>
                    <td class="border p-2">
                        {{ $item->email }}
                    </td>
                    <td class="border p-2 max-w-xs truncate" title="{{ $item->alamat }}">
                        {{ $item->alamat }}
                    </td>
                    <td class="border p-2 text-center whitespace-nowrap">
                        <a href="{{ route('pelanggan.edit', $item->id) }}"
                           class="bg-yellow-400 px-3 py-1 rounded text-sm hover:bg-yellow-500 transition">
                            Edit
                        </a>
                        <form action="{{ route('pelanggan.destroy', $item->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="event.preventDefault(); confirmDelete(event);"
                                    class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="border p-2 text-center" colspan="6">
                        @if($search || $filter)
                            Tidak ada data pelanggan yang sesuai dengan pencarian atau filter
                        @else
                            Tidak ada data pelanggan
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-6">
        {{ $pelanggan->links() }}
    </div>

</div>

</x-app-layout>
