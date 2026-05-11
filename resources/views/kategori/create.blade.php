<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Tambah Kategori
</h1>

<form action="{{ route('kategori.store') }}"
      method="POST">

    @csrf

    <input type="text"
           name="nama_kategori"
           placeholder="Nama Kategori"
           class="border p-2 w-full mb-3">

    <textarea name="deskripsi"
              placeholder="Deskripsi"
              class="border p-2 w-full mb-3"></textarea>

    <div class="flex gap-3">

        <button type="submit"
                class="bg-green-500 text-white px-4 py-2 rounded">

            Simpan

        </button>

        <a href="{{ route('kategori.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">

            Back

        </a>

    </div>

</form>

</div>

</x-app-layout>