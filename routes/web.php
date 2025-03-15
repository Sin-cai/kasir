<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LpetugasController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;



// Route::middleware(['guest'])->group (function() {
    
// });
Route::get('/', [LoginController::class, 'index']);
    Route::post('/', [LoginController::class, 'login']);


Route::get('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth' => 'admin'])->group(function () 
{
    Route::resource('admin', AdminController::class);
    Route::resource('kategori', KategoriController::class);
    Route::post('/kategori/bulk-delete', [kategoriController::class, 'bulkDelete'])->name('kategori.bulk_delete');

    Route::resource('produk', ProdukController::class);
    Route::post('/produk/bulk-delete', [produkController::class, 'bulkDelete'])->name('produk.bulk_delete');


    Route::resource('pelanggan', PelangganController::class);
    Route::post('/pelanggan/bulk-delete', [pelangganController::class, 'bulkDelete'])->name('pelanggan.bulk_delete');

    Route::resource('users', UserController::class);
    Route::post('/user/bulk-delete', [UserController::class, 'bulkDelete'])->name('user.bulk_delete');

    Route::resource('penjualan', PenjualanController::class);
    Route::post('/penjualan/bulk-delete', [PenjualanController::class, 'bulkDelete'])->name('penjualan.bulk_delete')
    ;
    Route::resource('laporan', LaporanController::class);
    Route::post('/penjualan/bulk-delete', [PenjualanController::class, 'bulkDelete'])->name('penjualan.bulk_delete');
});

Route::middleware(['auth' => 'petugas'])->group(function () 
{
    Route::resource('petugas', PetugasController::class);
});

// Route::middleware(['auth' => 'guest'])->group(function () {});