<?php

use App\Models\AlatBand;
use App\Models\BookingStudio;
use App\Models\Pelanggan;
use App\Models\RentalAlat;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessFlowTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function test_booking_total_is_calculated_from_studio_price_and_duration(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $pelanggan = Pelanggan::factory()->create();
        $studio = Studio::factory()->create(['harga_per_jam' => 120000, 'status' => 'Tersedia']);

        $response = $this->post('/booking-studio', [
            'pelanggan_id' => $pelanggan->id,
            'studio_id' => $studio->id,
            'tanggal_booking' => now()->toDateString(),
            'jam_mulai' => '10:00',
            'jam_selesai' => '13:00',
            'status' => 'Pending',
        ]);

        $response->assertRedirect('/booking-studio');
        $this->assertDatabaseHas('booking_studios', [
            'pelanggan_id' => $pelanggan->id,
            'studio_id' => $studio->id,
            'total_harga' => 360000,
            'status' => 'Pending',
        ]);
    }

    public function test_rental_total_and_stock_are_updated_from_selected_alat(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $pelanggan = Pelanggan::factory()->create();
        $alat = AlatBand::factory()->create(['stok' => 3, 'harga_sewa' => 50000]);

        $response = $this->post('/rental-alat', [
            'pelanggan_id' => $pelanggan->id,
            'alat_band_id' => $alat->id,
            'tanggal_sewa' => now()->toDateString(),
            'tanggal_kembali' => now()->addDay()->toDateString(),
            'jumlah' => 2,
            'status' => 'Dipinjam',
        ]);

        $response->assertRedirect('/rental-alat');
        $this->assertDatabaseHas('rental_alats', [
            'pelanggan_id' => $pelanggan->id,
            'alat_band_id' => $alat->id,
            'total_harga' => 100000,
            'status' => 'Dipinjam',
        ]);
        $this->assertDatabaseHas('alat_bands', [
            'id' => $alat->id,
            'stok' => 1,
        ]);
    }

    public function test_payment_rejects_nominal_that_is_less_than_total_bill(): void
    {
        $kasir = User::factory()->create(['role' => 'kasir']);
        $this->actingAs($kasir);

        $rental = RentalAlat::create([
            'pelanggan_id' => Pelanggan::factory()->create()->id,
            'alat_band_id' => AlatBand::factory()->create(['stok' => 3, 'harga_sewa' => 50000])->id,
            'tanggal_sewa' => now()->toDateString(),
            'tanggal_kembali' => now()->addDay()->toDateString(),
            'jumlah' => 1,
            'total_harga' => 50000,
            'status' => 'Dipinjam',
        ]);

        $response = $this->post('/pembayaran', [
            'jenis_transaksi' => 'Rental Alat',
            'rental_alat_id' => $rental->id,
            'metode_bayar' => 'Cash',
            'nominal_dibayar' => 40000,
            'status' => 'Pending',
        ]);

        $response->assertSessionHasErrors(['nominal_dibayar']);
    }
}
