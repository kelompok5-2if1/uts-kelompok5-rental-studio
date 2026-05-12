<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatBandController;
use App\Http\Controllers\BookingStudioController;
use App\Http\Controllers\RentalAlatController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('studio', StudioController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('alat-band', AlatBandController::class);
    Route::resource('booking-studio', BookingStudioController::class);
    Route::resource('rental-alat', RentalAlatController::class);

    
    
   

});

require __DIR__.'/auth.php';