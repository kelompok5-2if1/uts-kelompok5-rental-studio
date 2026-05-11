<x-app-layout>

<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">
        Data Studio
    </h1>

    <a href="{{ route('studio.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">

        Tambah Studio

    </a>

    <table class="table-auto w-full mt-4 border">

        <tr class="bg-gray-200">

            <th class="border p-2">Nama Studio</th>
            <th class="border p-2">Kapasitas</th>
            <th class="border p-2">Harga per Jam</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Aksi</th>

        </tr>

        @foreach($studio as $item)

        <tr>

            <td class="border p-2">
                {{ $item->nama_studio }}
            </td>

            <td class="border p-2">
                {{ $item->kapasitas }}
            </td>

            <td class="border p-2">
                Rp. {{ $item->harga_per_jam }}
            </td>

            <td class="border p-2">
                {{ $item->status }}
            </td>

            <td class="border p-2">

                <a href="{{ route('studio.edit', $item->id) }}"
                   class="bg-yellow-400 px-3 py-1 rounded">

                    Edit

                </a>

                <form action="{{ route('studio.destroy', $item->id) }}"
                      method="POST"
                      class="inline">

                    @csrf
                    @method('DELETE')

                   <button type="submit"
                            onclick="return confirm('Yakin ingin menghapus studio ini?')"
                            class="bg-red-500 text-white px-3 py-1 rounded">

                        Hapus

                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>

</div>

</x-app-layout>