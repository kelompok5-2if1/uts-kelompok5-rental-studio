<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Edit Kategori
</h1>

<form action="{{ route('kategori.update', $kategori->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <input type="text"
           name="nama_kategori"
           value="{{ $kategori->nama_kategori }}"
           class="border p-2 w-full mb-3">

    <textarea name="deskripsi"
              class="border p-2 w-full mb-3">{{ $kategori->deskripsi }}</textarea>

    <div class="flex gap-3">

        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded">

            Update

        </button>

        <a href="{{ route('kategori.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">

            Back

        </a>

    </div>

</form>

</div>

</x-app-layout>