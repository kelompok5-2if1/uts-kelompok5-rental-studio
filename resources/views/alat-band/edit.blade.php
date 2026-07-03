<x-app-layout>
    <div class="max-w-5xl mx-auto py-6 px-4">

        <div class="bg-white shadow-lg rounded-xl overflow-hidden">

            <!-- Header -->
            <div class="bg-blue-600 text-white px-6 py-4">
                <h1 class="text-2xl font-bold">
                    Edit Alat Band
                </h1>
                <p class="text-sm opacity-90">
                    Ubah data alat band dan upload gambar.
                </p>
            </div>

            <!-- Form -->
            <div class="p-6">

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('alat-band.update', $alatBand->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Kategori -->
                        <div>
                            <label class="block mb-2 font-semibold">
                                Kategori
                            </label>

                            <select
                                name="kategori_alat_id"
                                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                                @foreach($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $alatBand->kategori_alat_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach

                            </select>

                            @error('kategori_alat_id')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Nama Alat -->
                        <div>
                            <label class="block mb-2 font-semibold">
                                Nama Alat
                            </label>

                            <input
                                type="text"
                                name="nama_alat"
                                value="{{ old('nama_alat', $alatBand->nama_alat) }}"
                                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                            @error('nama_alat')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Stok -->
                        <div>
                            <label class="block mb-2 font-semibold">
                                Stok
                            </label>

                            <input
                                type="number"
                                name="stok"
                                value="{{ old('stok', $alatBand->stok) }}"
                                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                            @error('stok')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div>
                            <label class="block mb-2 font-semibold">
                                Harga Sewa
                            </label>

                            <input
                                type="number"
                                name="harga_sewa"
                                value="{{ old('harga_sewa', $alatBand->harga_sewa) }}"
                                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                            @error('harga_sewa')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Kondisi -->
                        <div class="md:col-span-2">
                            <label class="block mb-2 font-semibold">
                                Kondisi
                            </label>

                            <select
                                name="kondisi"
                                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                                <option value="Baik"
                                    {{ $alatBand->kondisi == 'Baik' ? 'selected' : '' }}>
                                    Baik
                                </option>

                                <option value="Rusak"
                                    {{ $alatBand->kondisi == 'Rusak' ? 'selected' : '' }}>
                                    Rusak
                                </option>

                                <option value="Maintenance"
                                    {{ $alatBand->kondisi == 'Maintenance' ? 'selected' : '' }}>
                                    Maintenance
                                </option>

                            </select>

                            @error('kondisi')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Foto -->
                        <div class="md:col-span-2">

                            <label class="block mb-2 font-semibold">
                                Foto Alat
                            </label>

                            @if($alatBand->foto)
                                <div class="mb-4">
                                    <img
                                        src="{{ asset('storage/'.$alatBand->foto) }}"
                                        alt="{{ $alatBand->nama_alat }}"
                                        class="w-48 h-48 object-cover rounded-lg border shadow">

                                    <p class="text-sm text-gray-500 mt-2">
                                        Gambar saat ini
                                    </p>
                                </div>
                            @endif

                            <input
                                type="file"
                                name="foto"
                                accept="image/*"
                                onchange="previewImage(this)"
                                class="w-full border rounded-lg px-4 py-2">

                            @error('foto')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror

                            <div
                                id="previewContainer"
                                class="mt-4 hidden">

                                <img
                                    id="preview"
                                    class="w-48 h-48 object-cover rounded-lg border shadow">

                                <p class="text-sm text-gray-500 mt-2">
                                    Preview gambar baru
                                </p>
                            </div>

                        </div>

                    </div>

                    <!-- Button -->
                    <div class="flex flex-col sm:flex-row gap-3 mt-8">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                            Update Data

                        </button>

                        <a
                            href="{{ route('alat-band.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg text-center">

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>
        function previewImage(input) {

            const preview = document.getElementById('preview');
            const container = document.getElementById('previewContainer');

            if (input.files && input.files[0]) {

                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</x-app-layout>