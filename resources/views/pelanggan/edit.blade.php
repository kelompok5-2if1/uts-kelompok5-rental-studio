<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Edit Pelanggan
</h1>

<form action="{{ route('pelanggan.update', $pelanggan->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <input type="text"
           name="nama"
           value="{{ $pelanggan->nama }}"
           class="border p-2 w-full mb-3">

    <input type="text"
           name="no_hp"
           value="{{ $pelanggan->no_hp }}"
           class="border p-2 w-full mb-3">

    <textarea name="alamat"
              class="border p-2 w-full mb-3">{{ $pelanggan->alamat }}</textarea>

    <input type="email"
           name="email"
           value="{{ $pelanggan->email }}"
           class="border p-2 w-full mb-3">

    <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded">

        Update

    </button>

</form>

</div>

</x-app-layout>