<x-app-layout>

<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">
        Data Pelanggan
    </h1>

    <a href="{{ route('pelanggan.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">

        Tambah Data

    </a>

    <table class="table-auto w-full mt-4 border">

        <tr class="bg-gray-200">

            <th class="border p-2">Nama</th>
            <th class="border p-2">No HP</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Aksi</th>

        </tr>

        @foreach($pelanggan as $item)

        <tr>

            <td class="border p-2">
                {{ $item->nama }}
            </td>

            <td class="border p-2">
                {{ $item->no_hp }}
            </td>

            <td class="border p-2">
                {{ $item->email }}
            </td>

            <td class="border p-2">

                <a href="{{ route('pelanggan.edit', $item->id) }}"
                   class="bg-yellow-400 px-3 py-1 rounded">

                    Edit

                </a>

                <form action="{{ route('pelanggan.destroy', $item->id) }}"
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

    </table>

</div>

</x-app-layout>