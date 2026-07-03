<x-app-layout>

<div class="p-6">

<h1 class="text-3xl font-bold mb-5">
    Tambah Studio
</h1>

<form action="{{ route('studio.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="mb-3">

        <label class="block mb-1 font-semibold">Nama Studio</label>

        <input type="text"
               name="nama_studio"
               value="{{ old('nama_studio') }}"
               placeholder="Nama Studio"
               class="border p-2 w-full @error('nama_studio') border-red-500 @enderror">

        @error('nama_studio')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

    </div>

    <div class="mb-3">

        <label class="block mb-1 font-semibold">Kapasitas</label>

        <input type="number"
               name="kapasitas"
               value="{{ old('kapasitas', 0) }}"
               placeholder="Kapasitas"
               class="border p-2 w-full @error('kapasitas') border-red-500 @enderror">

        @error('kapasitas')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

    </div>

    <div class="mb-3">

        <label class="block mb-1 font-semibold">Harga per Jam</label>

        <input type="number"
               name="harga_per_jam"
               step="0.01"
               value="{{ old('harga_per_jam') }}"
               placeholder="Harga per Jam"
               class="border p-2 w-full @error('harga_per_jam') border-red-500 @enderror">

        @error('harga_per_jam')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

    </div>

    <div class="mb-3">

        <label class="block mb-1 font-semibold">Status</label>

        <select name="status"
                class="border p-2 w-full @error('status') border-red-500 @enderror">

            <option value="">-- Pilih Status --</option>

            <option value="Tersedia" {{ old('status') == 'Tersedia' ? 'selected' : '' }}>
                Tersedia
            </option>

            <option value="Maintenance" {{ old('status') == 'Maintenance' ? 'selected' : '' }}>
                Maintenance
            </option>

        </select>

        @error('status')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

    </div>

    <div class="mb-3">

        <label class="block mb-1 font-semibold">Foto Studio (Max 5 MB)</label>

        <input type="file"
               name="foto"
               accept="image/*"
               class="border p-2 w-full @error('foto') border-red-500 @enderror"
               onchange="previewImage(this)">

        @error('foto')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <div id="imagePreview" class="mt-3" style="display: none;">
            <img id="preview" src="" alt="Preview" style="max-width: 300px; max-height: 300px; border: 1px solid #ccc; padding: 5px;">
        </div>

    </div>

    <div class="flex gap-3">

        <button type="submit"
                class="bg-green-500 text-white px-4 py-2 rounded">

            Simpan

        </button>

        <a href="{{ route('studio.index') }}"
        class="bg-gray-500 text-white px-4 py-2 rounded">

            Batal

        </a>

    </div>

</form>

</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const previewDiv = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewDiv.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</x-app-layout>