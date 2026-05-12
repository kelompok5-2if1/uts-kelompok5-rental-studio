<x-app-layout>

<div class="p-6">

    <h1 class="text-3xl font-bold mb-5">
        Data Alat Band
    </h1>

    <a href="{{ route('alat-band.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">

        Tambah Alat

    </a>

    <table class="table-auto w-full mt-5 border">

        <thead>

            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Nama Alat</th>
                <th class="border p-2">Stok</th>
            </tr>

        </thead>

        <tbody>

            @foreach($alatBand as $item)

            <tr>

                <td class="border p-2">
                    {{ $loop->iteration }}
                </td>

                <td class="border p-2">
                    {{ $item->nama_alat }}
                </td>

                <td class="border p-2">
                    {{ $item->stok }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

</x-app-layout>