<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Data Studio
    </h1>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-5">
        <a href="{{ route('studio.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition whitespace-nowrap">
            Tambah Studio
        </a>

        <form action="{{ route('studio.index') }}" method="GET" class="w-full md:w-auto">
            <div class="flex flex-col md:flex-row gap-2">
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Cari nama studio atau status..."
                       class="px-4 py-2 border rounded w-full md:w-64">
                <select name="filter"
                        class="px-4 py-2 border rounded w-full md:w-auto"
                        onchange="this.form.submit()">
                    <option value="">Semua Studio</option>
                    <option value="Tersedia" {{ $filter == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Maintenance" {{ $filter == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="booking" {{ $filter == 'booking' ? 'selected' : '' }}>Punya Booking Studio</option>
                    <option value="kosong" {{ $filter == 'kosong' ? 'selected' : '' }}>Belum Pernah Dibooking</option>
                </select>
                <button type="submit"
                        class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition whitespace-nowrap">
                    Cari
                </button>
                @if($search || $filter)
                    <a href="{{ route('studio.index') }}"
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
                    <th class="border p-2 whitespace-nowrap">Foto</th>
                    <th class="border p-2 whitespace-nowrap">Nama Studio</th>
                    <th class="border p-2 whitespace-nowrap">Kapasitas</th>
                    <th class="border p-2 whitespace-nowrap">Harga per Jam</th>
                    <th class="border p-2 whitespace-nowrap">Status</th>
                    <th class="border p-2 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($studio as $item)
                <tr>
                    <td class="border p-2 text-center whitespace-nowrap">
                        {{ $studio->firstItem() + $loop->index }}
                    </td>
                    <td class="border p-2 text-center whitespace-nowrap">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                 alt="{{ $item->nama_studio }}"
                                 class="mx-auto rounded"
                                 style="max-width: 80px; max-height: 80px;">
                        @else
                            <span class="text-gray-500 text-sm">Tidak ada foto</span>
                        @endif
                    </td>
                    <td class="border p-2 whitespace-nowrap">
                        {{ $item->nama_studio }}
                    </td>
                    <td class="border p-2 text-center whitespace-nowrap">
                        {{ $item->kapasitas }} orang
                    </td>
                    <td class="border p-2 whitespace-nowrap">
                        Rp. {{ number_format($item->harga_per_jam, 0, ',', '.') }}
                    </td>
                    <td class="border p-2 text-center whitespace-nowrap">
                        <span class="px-3 py-1 rounded text-white text-sm
                            {{ $item->status == 'Tersedia' ? 'bg-green-500' : 'bg-yellow-500' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="border p-2 text-center whitespace-nowrap">
                        <a href="{{ route('studio.edit', $item->id) }}"
                           class="bg-yellow-400 px-3 py-1 rounded text-sm hover:bg-yellow-500 transition">
                            Edit
                        </a>
                        <form action="{{ route('studio.destroy', $item->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus studio ini?')"
                                    class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="border p-2 text-center" colspan="7">
                        @if($search || $filter)
                            Tidak ada data studio yang sesuai dengan pencarian atau filter
                        @else
                            Tidak ada data studio
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-6">
        {{ $studio->links() }}
    </div>

</div>

</x-app-layout>
