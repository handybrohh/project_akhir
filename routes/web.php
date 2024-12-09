<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController; // Tambahkan baris ini
use App\Http\Controllers\PenjualanController; // Tambahkan baris ini
use Illuminate\Support\Facades\Route;

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Halaman dashboard utama untuk pengguna biasa
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {
    // Halaman Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Halaman Admin Dashboard (hanya untuk admin)
    Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware('admin')->name('admin.dashboard');
});

// Tambahkan rute autentikasi default (dari Breeze)
require __DIR__ . '/auth.php';

// Produk Routes
Route::get('/produk', [ProdukController::class, 'tampil'])->name('produk');
Route::post('/produk/tambah', [ProdukController::class, 'tambah'])->name('produk.tambah');
Route::put('/produk/edit/{produk}', [ProdukController::class, 'edit'])->name('produk.edit');
Route::delete('/produk/delete/{produk}', [ProdukController::class, 'delete'])->name('produk.delete');

// Penjualan Routes
Route::get('/penjualan', [PenjualanController::class, 'tampil'])->name('penjualan');
Route::post('/penjualan/tambah', [PenjualanController::class, 'tambah'])->name('penjualan.tambah');
Route::put('/penjualan/edit/{penjualan}', [PenjualanController::class, 'edit'])->name('penjualan.edit');
Route::delete('/penjualan/delete/{penjualan}', [PenjualanController::class, 'delete'])->name('penjualan.delete');
