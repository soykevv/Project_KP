<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangSatuanController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SupplierController;


use App\Models\Barang;
use App\Models\Supplier;
use App\Models\LogAktivitas;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'role:gudang'])->group(function () {

    Route::get('/dashboard-gudang', function () {
        $totalBarang = Barang::count();
        $totalSupplier = Supplier::count();
        $totalStok = Barang::sum('stok');

        $logTerakhir = LogAktivitas::with('user','barang')
            ->latest()
            ->limit(5)
            ->get();

        return view('gudang.dashboard', compact(
            'totalBarang',
            'totalSupplier',
            'totalStok',
            'logTerakhir'
        ));
    });

    Route::get('/barang', [BarangController::class, 'index']);
    Route::get('/barang/tambah', [BarangController::class, 'create']);
    Route::post('/barang', [BarangController::class, 'store']);
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
    Route::put('/barang/{id}', [BarangController::class, 'update']);
    Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
    Route::get('/barang/{id}/satuan/tambah', [BarangSatuanController::class, 'create']);
    Route::post('/barang-satuan/store', [BarangSatuanController::class, 'store'])
    ->name('barang-satuan.store');


    Route::get('/gudang/log-aktivitas', [LogAktivitasController::class, 'index'])->name('gudang.log_aktivitas');

    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::get('/supplier/tambah', [SupplierController::class, 'create']);
    Route::post('/supplier', [SupplierController::class, 'store']);
    Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit']);
    Route::put('/supplier/{id}', [SupplierController::class, 'update']);
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']);

});

Route::get('/barang/{id}/satuan', function ($id) {
    return \App\Models\BarangSatuan::where('barang_id', $id)->get();
});



Route::middleware(['auth', 'role:sales'])->group(function () {
    
    Route::get('/dashboard-sales', [BarangController::class, 'dashboardSales']);
    Route::get('/dashboard', [TransaksiController::class, 'dashboard']);

    Route::get('/produk', [BarangController::class, 'indexSales']);
    Route::get('/barang/{id}/satuan', [BarangController::class, 'getSatuan']);

    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::get('/transaksi/tambah', [TransaksiController::class, 'create']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::get('/transaksi/cetak/{id}', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');


});
Route::middleware(['auth'])->group(function () {
    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index']);
});



