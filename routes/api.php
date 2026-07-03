<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\StudioController;
use App\Http\Controllers\Api\AlatBandController;
use App\Http\Controllers\Api\BookingStudioController;
use App\Http\Controllers\Api\RentalAlatController;
use App\Http\Controllers\Api\DetailRentalController;
use App\Http\Controllers\Api\PembayaranController;
use App\Http\Controllers\Api\LaporanRentalController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Resource Routes
Route::prefix('v1')->group(function () {
    Route::apiResource('pelanggan', PelangganController::class);
    Route::apiResource('kategori', KategoriController::class);
    Route::apiResource('studio', StudioController::class);
    Route::apiResource('alat-band', AlatBandController::class);
    Route::apiResource('booking-studio', BookingStudioController::class);
    Route::apiResource('rental-alat', RentalAlatController::class);
    Route::apiResource('detail-rental', DetailRentalController::class);
    Route::apiResource('pembayaran', PembayaranController::class);
    Route::apiResource('laporan-rental', LaporanRentalController::class);
});
