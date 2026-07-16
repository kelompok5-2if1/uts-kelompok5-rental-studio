<x-app-layout>
<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold text-slate-800">Tambah Pembayaran</h1>
        <p class="mt-1 text-sm text-slate-500">Pilih jenis transaksi, lalu isi nominal pembayaran. Total tagihan dan kembalian dihitung otomatis.</p>
    </div>

    <form action="{{ route('pembayaran.store') }}" method="POST" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Jenis Transaksi</label>
                <select id="jenisTransaksi" name="jenis_transaksi" class="w-full rounded-xl border border-slate-300 p-3" required>
                    <option value="">-- Pilih Transaksi --</option>
                    <option value="Booking Studio">Booking Studio</option>
                    <option value="Rental Alat">Rental Alat</option>
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
                <input type="date" name="tanggal_bayar" class="w-full rounded-xl border border-slate-300 p-3" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Metode Pembayaran</label>
                <select name="metode_bayar" class="w-full rounded-xl border border-slate-300 p-3" required>
                    <option value="Cash">Cash</option>
                    <option value="Transfer">Transfer</option>
                    <option value="QRIS">QRIS</option>
                    <option value="Debit">Debit</option>
                </select>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Nominal Dibayar</label>
                <input type="number" id="nominalInput" name="nominal_dibayar" class="w-full rounded-xl border border-slate-300 p-3" min="0" required>
            </div>
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                <select name="status" class="w-full rounded-xl border border-slate-300 p-3" required>
                    <option value="Pending">Pending</option>
                    <option value="Lunas">Lunas</option>
                </select>
            </div>
        </div>

        <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-4">
            <p class="text-sm font-semibold text-slate-700">Informasi Tagihan</p>
            <div id="tagihanInfo" class="mt-2 text-sm text-slate-600">Pilih transaksi untuk melihat tagihan.</div>
            <div id="kembalianInfo" class="mt-2 text-sm font-semibold text-emerald-600"></div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="rounded-xl bg-green-600 px-5 py-2.5 font-semibold text-white transition hover:bg-green-700">Simpan</button>
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

    const buildOptions = (items, type) => {
        const options = items.map((item) => {
            const label = type === 'Booking Studio'
                ? `${item.pelanggan?.nama || '-'} - ${item.studio?.nama_studio || '-'} - Rp ${Number(item.total_harga || 0).toLocaleString('id-ID')}`
                : `${item.pelanggan?.nama || '-'} - ${item.alat_band?.nama_alat || '-'} - Rp ${Number(item.total_harga || 0).toLocaleString('id-ID')}`;
            return `<option value="${item.id}">${label}</option>`;
        });
        return options.join('');
    };

    jenisTransaksi.addEventListener('change', () => {
        const value = jenisTransaksi.value;
        transaksiSelect.innerHTML = '<option value="">-- Pilih Transaksi --</option>';
        if (value === 'Booking Studio') {
            transaksiSelect.innerHTML += buildOptions(bookings, 'Booking Studio');
            transaksiSelect.name = 'booking_studio_id';
        }
        if (value === 'Rental Alat') {
            transaksiSelect.innerHTML += buildOptions(rentals, 'Rental Alat');
            transaksiSelect.name = 'rental_alat_id';
        }
        tagihanInfo.textContent = 'Pilih transaksi untuk melihat tagihan.';
        kembalianInfo.textContent = '';
    });

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