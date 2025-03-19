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
use App\Http\Controllers\MemberController;
use App\Http\Controllers\KasirController;
use App\Exports\LaporanPenjualanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;



// Route::middleware(['guest'])->group (function() {

// });
Route::get('/', [LoginController::class, 'index']);
Route::post('/', [LoginController::class, 'login']);


Route::get('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth' => 'admin'])->group(function () {
    Route::resource('admin', AdminController::class);
    Route::resource('kategori', KategoriController::class);
    Route::post('/kategori/bulk-delete', [kategoriController::class, 'bulkDelete'])->name('kategori.bulk_delete');

    Route::resource('produk', ProdukController::class);
    Route::post('/produk/bulk-delete', [produkController::class, 'bulkDelete'])->name('produk.bulk_delete');


    Route::resource('pelanggan', PelangganController::class);
    Route::post('/pelanggan/bulk-delete', [pelangganController::class, 'bulkDelete'])->name('pelanggan.bulk_delete');

    Route::resource('users', UserController::class);
    Route::post('/user/bulk-delete', [UserController::class, 'bulkDelete'])->name('user.bulk_delete');

    // Route::resource('penjualan', PenjualanController::class);

    Route::post('/penjualan/bulk-delete', [PenjualanController::class, 'bulkDelete'])->name('penjualan.bulk_delete');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/penjualan/bulk-delete', [PenjualanController::class, 'bulkDelete'])->name('penjualan.bulk_delete');
    Route::get('/laporan/filter', [LaporanController::class, 'filterLaporan'])->name('laporan.filter');
});

Route::get('/penjualan/nota/{id}', [PenjualanController::class, 'printPage'])->name('print');
Route::get('/kasir/nota/{id}', [KasirController::class, 'printtPage'])->name('print2');


Route::get('/penjualan/nota/print/{id}', [PenjualanController::class, 'show'])->name('nota');
Route::get('/penjualan/invoice/print/{id}', [PenjualanController::class, 'cetakInvoice'])->name('invoice');
Route::get('/invoice/pdf/{id}', [PenjualanController::class, 'cetakInvoicePDF'])->name('invoice.pdf');

Route::get('/laporan/pdf', [LaporanController::class, 'cetakLaporanPDF'])->name('laporan.cetak.pdf');


Route::resource('pelanggan', PelangganController::class);
Route::post('/pelanggan/bulk-delete', [pelangganController::class, 'bulkDelete'])->name('pelanggan.bulk_delete');

// Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
// Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
// Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
Route::resource('penjualan', PenjualanController::class);
Route::post('/penjualan/bulk-delete', [PenjualanController::class, 'bulkDelete'])->name('penjualan.bulk_delete');

Route::get('/search-product', [PenjualanController::class, 'searchProduct']);
Route::get('/search-member', [PenjualanController::class, 'searchMember']);
Route::post('/store-transaction', [PenjualanController::class, 'storeTransaction']);
Route::post('/store-transaction', [KasirController::class, 'storeTransaction']);

Route::get('/laporan/export-excel', function (Request $request) {
    $startDate = $request->query('tanggal_mulai', now()->startOfMonth()->toDateString());
    $endDate = $request->query('tanggal_selesai', now()->endOfMonth()->toDateString());

    return Excel::download(new LaporanPenjualanExport($startDate, $endDate), 'laporan_penjualan.xlsx');
})->name('laporan.export.excel');


Route::middleware(['auth' => 'petugas'])->group(function () {
    Route::resource('petugas', PetugasController::class);
    Route::resource('member', MemberController::class);
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::get('/kasir/create', [KasirController::class, 'create'])->name('kasir.create');
});

// Route::middleware(['auth' => 'guest'])->group(function () {});