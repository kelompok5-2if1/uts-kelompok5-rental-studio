<?php

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
    }
}
