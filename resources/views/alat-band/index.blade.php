<x-app-layout>

<div class="max-w-7xl mx-auto p-4 md:p-6">

    {{-- Judul --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Data Alat Band
        </h1>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    {{-- Toolbar --}}
    <div class="flex flex-col lg:flex-row gap-4 justify-between mb-6">

        <a href="{{ route('alat-band.create') }}"
           class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 text-center">

            + Tambah Alat

        </a>

        <form action="{{ route('alat-band.index') }}"
              method="GET"
              class="flex flex-col md:flex-row gap-2">

            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Cari alat..."
                class="border rounded-lg px-4 py-2">

            <select
                name="kondisi"
                class="border rounded-lg px-4 py-2">

                <option value="">
                    Semua Kondisi
                </option>

                <option value="Baik"
                    {{ $kondisi=='Baik'?'selected':'' }}>
                    Baik
                </option>

                <option value="Rusak"
                    {{ $kondisi=='Rusak'?'selected':'' }}>
                    Rusak
                </option>

                <option value="Maintenance"
                    {{ $kondisi=='Maintenance'?'selected':'' }}>
                    Maintenance
                </option>

            </select>

            <button
                type="submit"
                class="bg-gray-700 text-white px-4 py-2 rounded-lg">

                Cari

            </button>

            @if($search || $kondisi)

                <a href="{{ route('alat-band.index') }}"
                   class="bg-red-500 text-white px-4 py-2 rounded-lg text-center">

                    Reset

                </a>

            @endif

        </form>

    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-center">Foto</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3 text-center">Stok</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3 text-center">Kondisi</th>
                        <th class="p-3 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($alatBand as $item)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-3 text-center">
                            {{ $alatBand->firstItem() + $loop->index }}
                        </td>

                        <td class="p-3 text-center">

                            @if($item->foto)

                                <img
                                    src="{{ asset('storage/'.$item->foto) }}"
                                    class="w-20 h-20 object-cover rounded-lg mx-auto">

                            @else

                                <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center mx-auto text-xs">

                                    No Image

                                </div>

                            @endif

                        </td>

                        <td class="p-3 font-medium">
                            {{ $item->nama_alat }}
                        </td>

                        <td class="p-3">
                            {{ $item->kategori->nama_kategori ?? '-' }}
                        </td>

                        <td class="p-3 text-center">
                            {{ $item->stok }}
                        </td>

                        <td class="p-3">
                            Rp {{ number_format($item->harga_sewa,0,',','.') }}
                        </td>

                        <td class="p-3 text-center">

                            @if($item->kondisi=='Baik')

                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                                    Baik
                                </span>

                            @elseif($item->kondisi=='Rusak')

                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm">
                                    Rusak
                                </span>

                            @else

                                <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm">
                                    Maintenance
                                </span>

                            @endif

                        </td>

                        <td class="p-3">

                            <div class="flex flex-col md:flex-row gap-2 justify-center">

                                <a href="{{ route('alat-band.edit',$item->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-2 rounded text-center">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('alat-band.destroy',$item->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus data?')"
                                        class="bg-red-500 text-white px-3 py-2 rounded w-full">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="8"
                            class="text-center py-10">

                            Tidak ada data alat band

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Pagination --}}
    <div class="mt-6">

        {{ $alatBand->links() }}

    </div>

</div>

</x-app-layout>