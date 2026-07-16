<x-app-layout>
<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold text-slate-800">Tambah Rental Alat</h1>
        <p class="mt-1 text-sm text-slate-500">Pilih alat dan jumlah, lalu sistem menghitung total otomatis dan mengurangi stok.</p>
    </div>

    <form action="{{ route('rental-alat.store') }}" method="POST" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Pelanggan</label>
                <select name="pelanggan_id" class="w-full rounded-xl border border-slate-300 p-3" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggan as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Alat Band</label>
                <select id="alatSelect" name="alat_band_id" class="w-full rounded-xl border border-slate-300 p-3" required>
                    <option value="">-- Pilih Alat --</option>
                    @foreach($alatBand as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->harga_sewa }}" data-stock="{{ $item->stok }}">{{ $item->nama_alat }} (Stok {{ $item->stok }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Sewa</label>
                <input type="date" name="tanggal_sewa" class="w-full rounded-xl border border-slate-300 p-3" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="w-full rounded-xl border border-slate-300 p-3" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Jumlah</label>
                <input type="number" id="jumlahInput" name="jumlah" class="w-full rounded-xl border border-slate-300 p-3" min="1" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="w-full rounded-xl border border-slate-300 p-3">
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Dikembalikan">Dikembalikan</option>
                </select>
            </div>
        </div>

        <div class="mt-6 rounded-xl border border-emerald-100 bg-emerald-50 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-emerald-700">Total otomatis</p>
                    <p class="text-xs text-emerald-600">Harga sewa x jumlah</p>
                </div>
                <div class="text-right">
                    <p id="totalPreview" class="text-xl font-bold text-emerald-800">Rp 0</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-2.5 font-semibold text-white transition hover:bg-emerald-700">Simpan</button>
        </div>
    </form>
</div>

<script>
    const alatSelect = document.getElementById('alatSelect');
    const jumlahInput = document.getElementById('jumlahInput');
    const totalPreview = document.getElementById('totalPreview');

    const updateTotal = () => {
        const selectedOption = alatSelect.options[alatSelect.selectedIndex];
        const price = Number(selectedOption?.dataset?.price || 0);
        const jumlah = Number(jumlahInput.value || 0);
        const total = price * jumlah;
        totalPreview.textContent = `Rp ${total.toLocaleString('id-ID')}`;
    };

    [alatSelect, jumlahInput].forEach((el) => el.addEventListener('change', updateTotal));
    [alatSelect, jumlahInput].forEach((el) => el.addEventListener('input', updateTotal));
</script>
</x-app-layout>