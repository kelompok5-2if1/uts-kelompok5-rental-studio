<x-app-layout>

<div class="p-6">

<h1 class="text-3xl font-bold mb-5">
    Tambah Alat Band
</h1>

<form action="{{ route('alat-band.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="mb-3">

        <label>Kategori</label>

        <select name="kategori_alat_id"
                class="border p-2 w-full @error('kategori_alat_id') border-red-500 @enderror">

            <option value="">-- Pilih Kategori --</option>

            @foreach($kategori as $item)

                <option value="{{ $item->id }}"
                    {{ old('kategori_alat_id') == $item->id ? 'selected' : '' }}>

                    {{ $item->nama_kategori }}

                </option>

            @endforeach

        </select>

        @error('kategori_alat_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

    </div>

    <div class="mb-3">

        <label>Nama Alat</label>

        <input type="text"
               name="nama_alat"
               value="{{ old('nama_alat') }}"
               class="border p-2 w-full @error('nama_alat') border-red-500 @enderror">

        @error('nama_alat')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

    </div>

    <div class="mb-3">

        <label>Stok</label>

        <input type="number"
               name="stok"
               value="{{ old('stok', 0) }}"
               class="border p-2 w-full @error('stok') border-red-500 @enderror">

        @error('stok')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

    </div>

    <div class="mb-3">

        <label>Harga Sewa</label>

        <input type="number"
               name="harga_sewa"
               value="{{ old('harga_sewa') }}"
               class="border p-2 w-full @error('harga_sewa') border-red-500 @enderror">

        @error('harga_sewa')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

    </div>

    <div class="mb-3">

        <label>Kondisi</label>

        <select name="kondisi"
                class="border p-2 w-full @error('kondisi') border-red-500 @enderror">

            <option value="">-- Pilih Kondisi --</option>

            <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>
                Baik
            </option>

            <option value="Rusak" {{ old('kondisi') == 'Rusak' ? 'selected' : '' }}>
                Rusak
            </option>

            <option value="Maintenance" {{ old('kondisi') == 'Maintenance' ? 'selected' : '' }}>
                Maintenance
            </option>

        </select>

        @error('kondisi')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

    </div>

    <div class="mb-3">

        <label>Foto Alat (Max 5 MB)</label>

        <input type="file"
               name="foto"
               accept="image/*"
               class="border p-2 w-full @error('foto') border-red-500 @enderror"
               onchange="previewImage(this)">

        @error('foto')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <div id="imagePreview" class="mt-3" style="display: none;">
            <img id="preview" src="" alt="Preview" style="max-width: 300px; max-height: 300px;">
        </div>

    </div>

    <div class="flex gap-3">

        <button type="submit"
                class="bg-green-500 text-white px-4 py-2 rounded">

            Simpan

        </button>

        <a href="{{ route('alat-band.index') }}"
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