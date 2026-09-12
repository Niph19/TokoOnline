<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/dashboard', fn () => redirect()->route('landing'))->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/checkout/{produk}', [PesananController::class, 'create'])->name('pesanan.create');
    Route::post('/checkout/{produk}', [PesananController::class, 'store'])->name('pesanan.store');
});

Route::middleware(['auth', 'verified', 'cek.Role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [ProdukController::class, 'dashboard'])->name('dashboard');
    Route::resource('produk', ProdukController::class)->except(['show']);
    Route::get('/pesanan', [PesananController::class, 'adminIndex'])->name('pesanan.index');
    Route::patch('/pesanan/{pesanan}', [PesananController::class, 'updateStatus'])->name('pesanan.status');
});

Route::middleware(['auth', 'cek.Role:user'])->group(function () {
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');

});

require __DIR__.'/auth.php';
