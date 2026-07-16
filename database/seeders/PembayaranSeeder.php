<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;
use App\Models\RentalAlat;
use App\Models\BookingStudio;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        Pembayaran::truncate();

        // Pembayaran Booking Studio
        foreach (BookingStudio::all() as $booking) {

            $total = $booking->total_harga ?? 0;

            Pembayaran::create([
                'jenis_transaksi'   => 'Booking Studio',
                'booking_studio_id' => $booking->id,
                'rental_alat_id'    => null,

                'tanggal_bayar'     => now(),
                'metode_bayar'      => 'Cash',

                'total_bayar'       => $total,
                'nominal_dibayar'   => $total,
                'kembalian'         => 0,

                'status'            => 'Lunas',
            ]);
        }

        // Pembayaran Rental Alat
        foreach (RentalAlat::all() as $rental) {

            $total = $rental->total_harga ?? 0;

            Pembayaran::create([
                'jenis_transaksi'   => 'Rental Alat',
                'booking_studio_id' => null,
                'rental_alat_id'    => $rental->id,

                'tanggal_bayar'     => now(),
                'metode_bayar'      => 'Transfer',

                'total_bayar'       => $total,
                'nominal_dibayar'   => $total,
                'kembalian'         => 0,

                'status'            => 'Lunas',
            ]);
        }
    }
}