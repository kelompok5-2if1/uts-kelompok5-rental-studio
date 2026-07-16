<x-app-layout>
<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold text-slate-800">Edit Booking Studio</h1>
        <p class="mt-1 text-sm text-slate-500">Perubahan studio atau jam akan memperbarui total otomatis.</p>
    </div>

    <form action="{{ route('booking-studio.update', $bookingStudio->id) }}" method="POST" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Pelanggan</label>
                <select name="pelanggan_id" class="w-full rounded-xl border border-slate-300 p-3" required>
                    @foreach($pelanggan as $item)
                        <option value="{{ $item->id }}" {{ $bookingStudio->pelanggan_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Studio</label>
                <select id="studioSelect" name="studio_id" class="w-full rounded-xl border border-slate-300 p-3" required>
                    @foreach($studio as $item)
                        <option value="{{ $item->id }}" data-price="{{ $item->harga_per_jam }}" {{ $bookingStudio->studio_id == $item->id ? 'selected' : '' }}>{{ $item->nama_studio }} (Rp {{ number_format($item->harga_per_jam, 0, ',', '.') }}/jam)</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Booking</label>
                <input type="date" name="tanggal_booking" value="{{ $bookingStudio->tanggal_booking }}" class="w-full rounded-xl border border-slate-300 p-3" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Jam Mulai</label>
                <input type="time" id="jamMulai" name="jam_mulai" value="{{ $bookingStudio->jam_mulai }}" class="w-full rounded-xl border border-slate-300 p-3" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Jam Selesai</label>
                <input type="time" id="jamSelesai" name="jam_selesai" value="{{ $bookingStudio->jam_selesai }}" class="w-full rounded-xl border border-slate-300 p-3" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="w-full rounded-xl border border-slate-300 p-3" required>
                    <option value="Pending" {{ $bookingStudio->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Selesai" {{ $bookingStudio->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Batal" {{ $bookingStudio->status == 'Batal' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>
        </div>

        <div class="mt-6 rounded-xl border border-blue-100 bg-blue-50 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-blue-700">Total otomatis</p>
                    <p class="text-xs text-blue-600">Durasi x harga studio</p>
                </div>
                <div class="text-right">
                    <p id="totalPreview" class="text-xl font-bold text-blue-800">Rp {{ number_format($bookingStudio->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="rounded-xl bg-yellow-600 px-5 py-2.5 font-semibold text-white transition hover:bg-yellow-700">Update</button>
        </div>
    </form>
</div>

<script>
    const studioSelect = document.getElementById('studioSelect');
    const jamMulai = document.getElementById('jamMulai');
    const jamSelesai = document.getElementById('jamSelesai');
    const totalPreview = document.getElementById('totalPreview');

    const updateTotal = () => {
        const selectedOption = studioSelect.options[studioSelect.selectedIndex];
        const price = Number(selectedOption?.dataset?.price || 0);
        if (!jamMulai.value || !jamSelesai.value || !price) {
            totalPreview.textContent = 'Rp 0';
            return;
        }

        const start = new Date(`1970-01-01T${jamMulai.value}:00`);
        const end = new Date(`1970-01-01T${jamSelesai.value}:00`);
        const diffMinutes = Math.max(0, (end - start) / 60000);
        const hours = Math.max(1, Math.ceil(diffMinutes / 60));
        const total = hours * price;
        totalPreview.textContent = `Rp ${total.toLocaleString('id-ID')}`;
    };

    [studioSelect, jamMulai, jamSelesai].forEach((el) => el.addEventListener('change', updateTotal));
    [studioSelect, jamMulai, jamSelesai].forEach((el) => el.addEventListener('input', updateTotal));
</script>
</x-app-layout>