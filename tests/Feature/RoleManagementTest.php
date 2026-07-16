<?php

use App\Models\BookingStudio;
use App\Models\Pelanggan;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleManagementTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function test_kasir_can_open_dashboard_and_payment_but_not_pelanggan(): void
    {
        $kasir = User::factory()->create([
            'name' => 'Kasir Test',
            'email' => 'kasir.test@example.com',
            'role' => 'kasir',
        ]);

        $this->actingAs($kasir);

        $this->get('/dashboard')->assertOk();
        $this->get('/pembayaran')->assertOk();
        $this->get('/pelanggan')->assertForbidden();
    }

    public function test_owner_can_open_read_only_pages_but_not_create(): void
    {
        $owner = User::factory()->create([
            'name' => 'Owner Test',
            'email' => 'owner.test@example.com',
            'role' => 'owner',
        ]);

        $this->actingAs($owner);

        $this->get('/pelanggan')->assertOk();
        $this->get('/pelanggan/create')->assertForbidden();
        $this->get('/booking-studio/create')->assertForbidden();
    }

    public function test_owner_views_hide_crud_buttons_but_keep_export(): void
    {
        $owner = User::factory()->create([
            'name' => 'Owner UI Test',
            'email' => 'owner.ui@example.com',
            'role' => 'owner',
        ]);

        $this->actingAs($owner);

        $pelanggan = Pelanggan::factory()->create();

        $this->get('/pelanggan')
            ->assertOk()
            ->assertSee($pelanggan->nama)
            ->assertDontSeeText('Tambah Data')
            ->assertDontSee(route('pelanggan.edit', $pelanggan->id))
            ->assertDontSee(route('pelanggan.destroy', $pelanggan->id))
            ->assertSeeText('Export Excel');
    }

    public function test_kasir_can_only_access_dashboard_and_payment_modules(): void
    {
        $kasir = User::factory()->create([
            'name' => 'Kasir Restricted Test',
            'email' => 'kasir.restricted@example.com',
            'role' => 'kasir',
        ]);

        $this->actingAs($kasir);

        $this->get('/dashboard')->assertOk();
        $this->get('/pembayaran')->assertOk();
        $this->get('/pembayaran/create')->assertOk();

        $this->get('/pelanggan')->assertForbidden();
        $this->get('/kategori')->assertForbidden();
        $this->get('/studio')->assertForbidden();
        $this->get('/alat-band')->assertForbidden();
        $this->get('/booking-studio')->assertForbidden();
        $this->get('/rental-alat')->assertForbidden();
        $this->get('/detail-rental')->assertForbidden();
        $this->get('/laporan-rental')->assertForbidden();
    }

    public function test_kasir_views_hide_menu_and_crud_controls(): void
    {
        $kasir = User::factory()->create([
            'name' => 'Kasir UI Test',
            'email' => 'kasir.ui@example.com',
            'role' => 'kasir',
        ]);

        $this->actingAs($kasir);

        $pelanggan = Pelanggan::factory()->create(['nama' => 'Pelanggan Kasir']);
        $studio = Studio::factory()->create(['nama_studio' => 'Studio Kasir']);
        $booking = BookingStudio::create([
            'pelanggan_id' => $pelanggan->id,
            'studio_id' => $studio->id,
            'tanggal_booking' => now()->toDateString(),
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '12:00:00',
            'total_harga' => 250000,
            'status' => 'Pending',
        ]);

        $this->get('/dashboard')
            ->assertOk()
            ->assertSee('/pembayaran')
            ->assertDontSee('/pelanggan')
            ->assertDontSee('/laporan-rental');

        $this->get('/booking-studio')->assertForbidden();
    }
}
