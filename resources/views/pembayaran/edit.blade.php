<x-app-layout>
<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold text-slate-800">Edit Pembayaran</h1>
        <p class="mt-1 text-sm text-slate-500">Perbarui transaksi yang dibayar dan catat nominal yang diterima.</p>
    </div>

    <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Jenis Transaksi</label>
                <select id="jenisTransaksi" name="jenis_transaksi" class="w-full rounded-xl border border-slate-300 p-3" required>
                    <option value="Booking Studio" {{ $pembayaran->jenis_transaksi === 'Booking Studio' ? 'selected' : '' }}>Booking Studio</option>
                    <option value="Rental Alat" {{ $pembayaran->jenis_transaksi === 'Rental Alat' ? 'selected' : '' }}>Rental Alat</option>
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Transaksi</label>
                <select id="transaksiSelect" name="booking_studio_id" class="w-full rounded-xl border border-slate-300 p-3">
                    <option value="">-- Pilih Transaksi --</option>
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Bayar</label>
                <input type="date" name="tanggal_bayar" value="{{ $pembayaran->tanggal_bayar }}" class="w-full rounded-xl border border-slate-300 p-3" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Metode Pembayaran</label>
                <select name="metode_bayar" class="w-full rounded-xl border border-slate-300 p-3" required>
                    <option value="Cash" {{ $pembayaran->metode_bayar === 'Cash' ? 'selected' : '' }}>Cash</option>
                    <option value="Transfer" {{ $pembayaran->metode_bayar === 'Transfer' ? 'selected' : '' }}>Transfer</option>
                    <option value="QRIS" {{ $pembayaran->metode_bayar === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                    <option value="Debit" {{ $pembayaran->metode_bayar === 'Debit' ? 'selected' : '' }}>Debit</option>
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Nominal Dibayar</label>
                <input type="number" id="nominalInput" name="nominal_dibayar" value="{{ $pembayaran->nominal_dibayar }}" class="w-full rounded-xl border border-slate-300 p-3" min="0" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="w-full rounded-xl border border-slate-300 p-3" required>
                    <option value="Pending" {{ $pembayaran->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Lunas" {{ $pembayaran->status === 'Lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>
        </div>

        <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-4">
            <p class="text-sm font-semibold text-slate-700">Informasi Tagihan</p>
            <div id="tagihanInfo" class="mt-2 text-sm text-slate-600">Pilih transaksi untuk melihat tagihan.</div>
            <div id="kembalianInfo" class="mt-2 text-sm font-semibold text-emerald-600"></div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="rounded-xl bg-blue-600 px-5 py-2.5 font-semibold text-white transition hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>

<script>
    const jenisTransaksi = document.getElementById('jenisTransaksi');
    const transaksiSelect = document.getElementById('transaksiSelect');
    const nominalInput = document.getElementById('nominalInput');
    const tagihanInfo = document.getElementById('tagihanInfo');
    const kembalianInfo = document.getElementById('kembalianInfo');

    const bookings = @json($bookings ?? []);
    const rentals = @json($rentals ?? []);
    const currentType = '{{ $pembayaran->jenis_transaksi }}';
    const currentValue = '{{ $pembayaran->booking_studio_id ?? $pembayaran->rental_alat_id ?? '' }}';

    const buildOptions = (items, type) => {
        const options = items.map((item) => {
            const label = type === 'Booking Studio'
                ? `${item.pelanggan?.nama || '-'} - ${item.studio?.nama_studio || '-'} - Rp ${Number(item.total_harga || 0).toLocaleString('id-ID')}`
                : `${item.pelanggan?.nama || '-'} - ${item.alat_band?.nama_alat || '-'} - Rp ${Number(item.total_harga || 0).toLocaleString('id-ID')}`;
            return `<option value="${item.id}" ${String(item.id) === String(currentValue) ? 'selected' : ''}>${label}</option>`;
        });
        return options.join('');
    };

    const renderOptions = () => {
        transaksiSelect.innerHTML = '<option value="">-- Pilih Transaksi --</option>';
        if (jenisTransaksi.value === 'Booking Studio') {
            transaksiSelect.innerHTML += buildOptions(bookings, 'Booking Studio');
            transaksiSelect.name = 'booking_studio_id';
        }
        if (jenisTransaksi.value === 'Rental Alat') {
            transaksiSelect.innerHTML += buildOptions(rentals, 'Rental Alat');
            transaksiSelect.name = 'rental_alat_id';
        }
    };

    jenisTransaksi.value = currentType || 'Booking Studio';
    renderOptions();

    jenisTransaksi.addEventListener('change', renderOptions);

    transaksiSelect.addEventListener('change', () => {
        const selectedValue = transaksiSelect.value;
        if (!selectedValue) {
            tagihanInfo.textContent = 'Pilih transaksi untuk melihat tagihan.';
            kembalianInfo.textContent = '';
            return;
        }

        const items = jenisTransaksi.value === 'Booking Studio' ? bookings : rentals;
        const selected = items.find((item) => String(item.id) === String(selectedValue));
        if (!selected) {
            tagihanInfo.textContent = 'Transaksi tidak ditemukan.';
            return;
        }

        const total = Number(selected.total_harga || 0);
        tagihanInfo.textContent = `Total tagihan: Rp ${total.toLocaleString('id-ID')}`;
        const nominal = Number(nominalInput.value || 0);
        const kembalian = nominal - total;
        kembalianInfo.textContent = kembalian >= 0 ? `Kembalian: Rp ${kembalian.toLocaleString('id-ID')}` : 'Pembayaran tidak mencukupi.';
    });

    nominalInput.addEventListener('input', () => {
        transaksiSelect.dispatchEvent(new Event('change'));
    });
</script>
</x-app-layout>