<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Tambah Studio
</h1>

<form action="{{ route('studio.store') }}"
      method="POST">

    @csrf

    <input type="text"
           name="nama_studio"
           placeholder="Nama Studio"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="kapasitas"
           placeholder="Kapasitas"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="harga_per_jam"
           placeholder="Harga per Jam"
           class="border p-2 w-full mb-3">

    <select name="status"
            class="border p-2 w-full mb-3">

        <option value="Tersedia">
            Tersedia
        </option>

        <option value="Dipakai">
            Dipakai
        </option>

    </select>

    <button type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded">

        Simpan

    </button>

</form>

</div>

</x-app-layout>