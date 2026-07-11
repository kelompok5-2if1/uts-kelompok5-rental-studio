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
    $monthExpression = DB::connection()->getDriverName() === 'sqlite'
        ? "CAST(strftime('%m', created_at) AS INTEGER)"
        : 'MONTH(created_at)';

    $bookingChart = BookingStudio::select(
            DB::raw("{$monthExpression} as bulan"),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    $rentalChart = RentalAlat::select(
            DB::raw("{$monthExpression} as bulan"),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    return view('dashboard', [
        'totalPelanggan'  => Pelanggan::count(),
        'totalStudio'     => Studio::count(),
        'totalAlat'       => AlatBand::count(),
        'totalBooking'    => BookingStudio::count(),
        'totalRental'     => RentalAlat::count(),
        'totalPembayaran' => Pembayaran::count(),
        'totalPendapatan' => Pembayaran::sum('total_bayar') ?? 0,
        'bookingTerbaru' => BookingStudio::with(['studio', 'pelanggan'])
                            ->latest()
                            ->take(5)
                            ->get(),
        'rentalTerbaru'  => RentalAlat::with(['pelanggan', 'alatBand'])
                            ->latest()
                            ->take(5)
                            ->get(),
        'bookingChart' => $bookingChart,
        'rentalChart'  => $rentalChart,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,kasir,owner'])->group(function () {

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
    | index: admin, owner | create/edit/delete: admin saja
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,owner')->group(function () {
        Route::resource('pelanggan', PelangganController::class)->only(['index']);
        Route::resource('kategori', KategoriController::class)->only(['index']);
        Route::resource('studio', StudioController::class)->only(['index']);
        Route::resource('alat-band', AlatBandController::class)->only(['index']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('pelanggan', PelangganController::class)->except(['index']);
        Route::resource('kategori', KategoriController::class)->except(['index']);
        Route::resource('studio', StudioController::class)->except(['index']);
        Route::resource('alat-band', AlatBandController::class)->except(['index']);
    });

    /*
    |--------------------------------------------------------------------------
    | Transaksi
    | index: admin, owner, kasir | create/edit/delete: admin, owner
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,owner,kasir')->group(function () {
        Route::resource('booking-studio', BookingStudioController::class)->only(['index']);
        Route::resource('rental-alat', RentalAlatController::class)->only(['index']);
        Route::resource('detail-rental', DetailRentalController::class)->only(['index']);
        Route::resource('pembayaran', PembayaranController::class)->only(['index']);
    });

    Route::middleware('role:admin,owner')->group(function () {
        Route::resource('booking-studio', BookingStudioController::class)->except(['index']);
        Route::resource('rental-alat', RentalAlatController::class)->except(['index']);
        Route::resource('detail-rental', DetailRentalController::class)->except(['index']);
    });

    Route::middleware('role:admin,kasir,owner')->group(function () {
        Route::resource('pembayaran', PembayaranController::class)->except(['index']);
    });

    /*
    |--------------------------------------------------------------------------
    | Laporan (Full CRUD)
    | admin, owner
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,owner')->group(function () {
        Route::resource('laporan-rental', LaporanRentalController::class);

        Route::get('/laporan-rental-export-pdf',
            [LaporanRentalController::class, 'exportPdf'])
            ->name('laporan-rental.export-pdf');

        Route::get('laporan-rental/export/excel',
            [LaporanRentalController::class, 'exportExcel'])
            ->name('laporan-rental.export.excel');

        /*
        |----------------------------------------------------------------------
        | Export Excel (Modul Lain)
        |----------------------------------------------------------------------
        */

        Route::get('/pelanggan/export/excel',
            [PelangganController::class, 'exportExcel'])
            ->name('pelanggan.export.excel');

        Route::get('/kategori/export/excel',
            [KategoriController::class, 'exportExcel'])
            ->name('kategori.export.excel');

        Route::get('/studio/export/excel',
            [StudioController::class, 'exportExcel'])
            ->name('studio.export.excel');

        Route::get('/alat-band/export/excel',
            [AlatBandController::class, 'exportExcel'])
            ->name('alat-band.export.excel');

        Route::get('/booking-studio/export/excel',
            [BookingStudioController::class, 'exportExcel'])
            ->name('booking-studio.export.excel');

        Route::get('/rental-alat/export/excel',
            [RentalAlatController::class, 'exportExcel'])
            ->name('rental-alat.export.excel');

        Route::get('/detail-rental/export/excel',
            [DetailRentalController::class, 'exportExcel'])
            ->name('detail-rental.export.excel');

        Route::get('/pembayaran/export/excel',
            [PembayaranController::class, 'exportExcel'])
            ->name('pembayaran.export.excel');
    });
});

require __DIR__.'/auth.php';