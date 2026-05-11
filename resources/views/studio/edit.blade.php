<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
    Edit Studio
</h1>

<form action="{{ route('studio.update', $studio->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <input type="text"
           name="nama_studio"
           value="{{ $studio->nama_studio }}"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="kapasitas"
           value="{{ $studio->kapasitas }}"
           class="border p-2 w-full mb-3">

    <input type="number"
           name="harga_per_jam"
           value="{{ $studio->harga_per_jam }}"
           class="border p-2 w-full mb-3">

    <select name="status"
            class="border p-2 w-full mb-3">

        <option value="Tersedia"
            {{ $studio->status == 'Tersedia' ? 'selected' : '' }}>

            Tersedia

        </option>

        <option value="Dipakai"
            {{ $studio->status == 'Dipakai' ? 'selected' : '' }}>

            Dipakai

        </option>

    </select>

    <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded">

        Update

    </button>

</form>

</div>

</x-app-layout>