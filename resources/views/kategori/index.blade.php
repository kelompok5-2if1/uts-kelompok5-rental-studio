<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Data Kategori
    </h1>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-5">
        <a href="{{ route('kategori.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition whitespace-nowrap">
            Tambah Kategori
        </a>

        <form action="{{ route('kategori.index') }}" method="GET" class="w-full md:w-auto">
            <div class="flex flex-col md:flex-row gap-2">
                <input type="text"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Cari nama kategori atau deskripsi..."
                       class="px-4 py-2 border rounded w-full md:w-64">
                <select name="filter"
                        class="px-4 py-2 border rounded w-full md:w-auto"
                        onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="alat" {{ $filter == 'alat' ? 'selected' : '' }}>Punya Alat Band</option>
                    <option value="kosong" {{ $filter == 'kosong' ? 'selected' : '' }}>Belum Digunakan</option>
                </select>
                <button type="submit"
                        class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition whitespace-nowrap">
                    Cari
                </button>
                @if($search || $filter)
                    <a href="{{ route('kategori.index') }}"
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
                    <th class="border p-2 whitespace-nowrap">Nama Kategori</th>
                    <th class="border p-2 whitespace-nowrap">Deskripsi</th>
                    <th class="border p-2 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kategori as $item)
                <tr>
                    <td class="border p-2 text-center whitespace-nowrap">
                        {{ $kategori->firstItem() + $loop->index }}
                    </td>
                    <td class="border p-2 whitespace-nowrap">
                        {{ $item->nama_kategori }}
                    </td>
                    <td class="border p-2 max-w-xs truncate" title="{{ $item->deskripsi }}">
                        {{ $item->deskripsi }}
                    </td>
                    <td class="border p-2 text-center whitespace-nowrap">
                        <a href="{{ route('kategori.edit', $item->id) }}"
                           class="bg-yellow-400 px-3 py-1 rounded text-sm hover:bg-yellow-500 transition">
                            Edit
                        </a>
                        <form action="{{ route('kategori.destroy', $item->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                    class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="border p-2 text-center" colspan="4">
                        @if($search || $filter)
                            Tidak ada data kategori yang sesuai dengan pencarian atau filter
                        @else
                            Tidak ada data kategori
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-6">
        {{ $kategori->links() }}
    </div>

</div>

</x-app-layout>
