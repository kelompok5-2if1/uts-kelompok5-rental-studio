<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Data Kategori
</h1>

<a href="{{ route('kategori.create') }}"
   class="bg-blue-500 text-white px-4 py-2 rounded">

    Tambah Kategori

</a>

<table class="table-auto w-full mt-4 border">

<tr class="bg-gray-200">

    <th class="border p-2">Nama Kategori</th>
    <th class="border p-2">Deskripsi</th>
    <th class="border p-2">Aksi</th>

</tr>

@foreach($kategori as $item)

<tr>

    <td class="border p-2">
        {{ $item->nama_kategori }}
    </td>

    <td class="border p-2">
        {{ $item->deskripsi }}
    </td>

    <td class="border p-2">

        <a href="{{ route('kategori.edit', $item->id) }}"
           class="bg-yellow-400 px-3 py-1 rounded">

            Edit

        </a>

        <form action="{{ route('kategori.destroy', $item->id) }}"
              method="POST"
              class="inline">

            @csrf
            @method('DELETE')

            <button type="submit"
                    onclick="return confirm('Yakin ingin menghapus kategori ini?')"
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