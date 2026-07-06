<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatBandController;
use App\Http\Controllers\BookingStudioController;
use App\Http\Controllers\RentalAlatController;
use App\Http\Controllers\DetailRentalController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanRentalController;

use App\Models\Pelanggan;
use App\Models\Studio;
use App\Models\AlatBand;
use App\Models\BookingStudio;
use App\Models\RentalAlat;
use App\Models\Pembayaran;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    // booking per bulan
    $bookingChart = BookingStudio::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    // rental per bulan
    $rentalChart = RentalAlat::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    return view('dashboard', [

        // statistik utama
        'totalPelanggan'  => Pelanggan::count(),
        'totalStudio'     => Studio::count(),
        'totalAlat'       => AlatBand::count(),
        'totalBooking'    => BookingStudio::count(),
        'totalRental'     => RentalAlat::count(),
        'totalPembayaran' => Pembayaran::count(),

        // pendapatan
        'totalPendapatan' => Pembayaran::sum('total_bayar') ?? 0,

        // tambahan dashboard
        'bookingTerbaru' => BookingStudio::with(['studio', 'pelanggan'])
                            ->latest()
                            ->take(5)
                            ->get(),

        'rentalTerbaru'  => RentalAlat::with(['pelanggan', 'alatBand'])
                            ->latest()
                            ->take(5)
                            ->get(),

        // chart per bulan
        'bookingChart' => $bookingChart,
        'rentalChart'  => $rentalChart,

    ]);

})->middleware(['auth', 'verified'])
  ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile',
        [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile',
        [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile',
        [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Master Data
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'pelanggan',
        PelangganController::class
    );

    Route::resource(
        'kategori',
        KategoriController::class
    );

    Route::resource(
        'studio',
        StudioController::class
    );

    Route::resource(
        'alat-band',
        AlatBandController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Transaksi
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'booking-studio',
        BookingStudioController::class
    );

    Route::resource(
        'rental-alat',
        RentalAlatController::class
    );

    Route::resource(
        'detail-rental',
        DetailRentalController::class
    );

    Route::resource(
        'pembayaran',
        PembayaranController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Laporan
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'laporan-rental',
        LaporanRentalController::class
    );

    Route::get(
    '/laporan-rental-export-pdf',
    [LaporanRentalController::class, 'exportPdf']
    )->name('laporan-rental.export-pdf');

    Route::get(
    'laporan-rental/export/excel',
    [LaporanRentalController::class,'exportExcel']
    )->name('laporan-rental.export.excel');
});

require __DIR__.'/auth.php';