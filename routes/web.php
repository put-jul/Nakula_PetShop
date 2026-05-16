<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NakulaController;
use App\Http\Controllers\GroomingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CustomerController;

// Rute bawaan Laravel Breeze
Route::get('/', function () { return view('auth.login'); });
require __DIR__.'/auth.php';

// ==========================================
// 1. JALUR KHUSUS ADMIN (Hanya boleh diakses Role = Admin)
// ==========================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [NakulaController::class, 'index'])->name('dashboard');
    Route::post('/barang/simpan', [NakulaController::class, 'simpanBarang']);
    
    // ---> JALUR BARU UNTUK FITUR EDIT BARANG ✨
    Route::get('/barang/edit/{id}', [NakulaController::class, 'editBarang']);
    Route::post('/barang/update/{id}', [NakulaController::class, 'updateBarang']);
    
    Route::get('/barang/hapus/{id}', [NakulaController::class, 'hapusBarang']);

    Route::get('/transaksi', [NakulaController::class, 'transaksi']);
    Route::post('/transaksi/tambah', [NakulaController::class, 'tambahKeKeranjang']);
    Route::get('/transaksi/hapus', [NakulaController::class, 'hapusKeranjang']);
    Route::post('/transaksi/simpan', [NakulaController::class, 'simpanTransaksi']);
    Route::get('/transaksi/cetak/{id}', [NakulaController::class, 'cetakStruk']);
    Route::get('/laporan/excel', [NakulaController::class, 'exportExcel']);

    Route::get('/grooming', [GroomingController::class, 'index']);
    Route::post('/grooming/simpan', [GroomingController::class, 'simpan']);
    Route::get('/grooming/selesai/{id}', [GroomingController::class, 'selesai']);
    Route::get('/grooming/hapus/{id}', [GroomingController::class, 'hapus']);

    Route::get('/member', [MemberController::class, 'index']);
    Route::post('/member/simpan', [MemberController::class, 'simpan']);
    Route::post('/member/poin/{id}', [MemberController::class, 'tambahPoin']); 
    Route::get('/member/hapus/{id}', [MemberController::class, 'hapus']);
});

// ==========================================
// 2. JALUR KHUSUS CUSTOMER (Hanya boleh diakses Role = Customer)
// ==========================================
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/portal-pelanggan', [CustomerController::class, 'index'])->name('customer.dashboard');
    Route::post('/portal-pelanggan/reservasi', [CustomerController::class, 'reservasi']);
    Route::get('/portal-pelanggan/batal/{id}', [CustomerController::class, 'batalkan']);
    
    // Fitur Poin Reward
    Route::get('/poin-reward', [CustomerController::class, 'poin']); 
    
    // ---> INI DIA JALUR KATALOG YANG BIKIN 404 KALAU TIDAK ADA
    Route::get('/katalog', [CustomerController::class, 'katalog']); 
});