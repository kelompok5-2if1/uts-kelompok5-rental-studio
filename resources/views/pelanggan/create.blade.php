<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Tambah Pelanggan
</h1>

<form action="{{ route('pelanggan.store') }}"
      method="POST">

    @csrf

    <input type="text"
           name="nama"
           placeholder="Nama"
           class="border p-2 w-full mb-3">

    <input type="text"
           name="no_hp"
           placeholder="No HP"
           class="border p-2 w-full mb-3">

    <textarea name="alamat"
              placeholder="Alamat"
              class="border p-2 w-full mb-3"></textarea>

    <input type="email"
           name="email"
           placeholder="Email"
           class="border p-2 w-full mb-3">

    <button type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded">

        Simpan

    </button>

</form>

</div>

</x-app-layout>