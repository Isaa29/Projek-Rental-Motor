<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisMotorController;
use App\Http\Controllers\Admin\UnitMotorController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\TransaksiController   as AdminTransaksiController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Customer\BerandaController;
use App\Http\Controllers\Customer\RentalController;
use App\Http\Controllers\Customer\TransaksiController as CustomerTransaksiController;
use App\Http\Controllers\Customer\AkunController;

// ── LANDING PAGE ──────────────────────────────────────
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('customer.beranda');
    }

    $motors = \App\Models\JenisMotor::withCount([
        'motors as tersedia_count' => fn($q) => $q->where('status', 'tersedia'),
    ])->take(4)->get();

    return view('welcome', compact('motors'));
})->name('landing');


// ── AUTH ──────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class,'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class,'login'])->name('login.post');
    Route::get('/register', [AuthController::class,'showRegister'])->name('register');
    Route::post('/register',[AuthController::class,'register'])->name('register.post');
});
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

// ── ADMIN ─────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('auth', 'admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // Jenis Motor
    Route::get('/jenis-motor/cari',          [JenisMotorController::class,'search'])->name('jenis-motor.search');
    Route::get('/jenis-motor',               [JenisMotorController::class,'index'])->name('jenis-motor.index');
    Route::get('/jenis-motor/tambah',        [JenisMotorController::class,'create'])->name('jenis-motor.create');
    Route::post('/jenis-motor/tambah',       [JenisMotorController::class,'store'])->name('jenis-motor.store');
    Route::get('/jenis-motor/{id}/edit',     [JenisMotorController::class,'edit'])->name('jenis-motor.edit');
    Route::put('/jenis-motor/{id}',          [JenisMotorController::class,'update'])->name('jenis-motor.update');
    Route::delete('/jenis-motor/{id}',       [JenisMotorController::class,'destroy'])->name('jenis-motor.destroy');

    // Unit Motor
    Route::get('/unit-motor',            [UnitMotorController::class,'index'])->name('unit-motor.index');
    Route::get('/unit-motor/tambah',     [UnitMotorController::class,'create'])->name('unit-motor.create');
    Route::post('/unit-motor/tambah',    [UnitMotorController::class,'store'])->name('unit-motor.store');
    Route::get('/unit-motor/{id}/edit',  [UnitMotorController::class,'edit'])->name('unit-motor.edit');
    Route::put('/unit-motor/{id}',       [UnitMotorController::class,'update'])->name('unit-motor.update');
    Route::delete('/unit-motor/{id}',    [UnitMotorController::class,'destroy'])->name('unit-motor.destroy');

    // Customer
    Route::get('/customer',       [CustomerController::class,'index'])->name('customer.index');
    Route::get('/customer/{id}',  [CustomerController::class,'show'])->name('customer.show');

    // Transaksi
    Route::get('/transaksi',                     [AdminTransaksiController::class,'index'])->name('transaksi.index');
    Route::post('/transaksi/{id}/status',        [AdminTransaksiController::class,'updateStatus'])->name('transaksi.updateStatus');
    Route::post('/transaksi/{id}/bayar',         [AdminTransaksiController::class,'verifikasiBayar'])->name('transaksi.verifikasiBayar');
    Route::delete('/transaksi/{id}',             [AdminTransaksiController::class,'destroy'])->name('transaksi.destroy');

    // Laporan
    Route::get('/laporan', [LaporanController::class,'index'])->name('laporan.index');
});

// ── CUSTOMER ──────────────────────────────────────────
Route::prefix('customer')->name('customer.')->middleware('auth', 'customer')->group(function () {

    Route::get('/beranda', [BerandaController::class,'index'])->name('beranda');

    // Rental
    Route::get('/rental/cari',   [RentalController::class,'search'])->name('rental.search');
    Route::get('/rental',        [RentalController::class,'index'])->name('rental.index');
    Route::get('/rental/{id}',   [RentalController::class,'show'])->name('rental.show');

    // Sewa & Transaksi
    Route::get('/sewa/{jenis_id}',  [CustomerTransaksiController::class,'create'])->name('sewa.create');
    Route::post('/sewa',            [CustomerTransaksiController::class,'store'])->name('sewa.store');
    Route::get('/riwayat',          [CustomerTransaksiController::class,'index'])->name('riwayat.index');
    Route::delete('/riwayat/{id}/batal', [CustomerTransaksiController::class,'cancel'])->name('riwayat.cancel');

    // Syarat & Kontak
    Route::get('/syarat', fn()=>view('customer.syarat'))->name('syarat');
    Route::get('/kontak', fn()=>view('customer.kontak'))->name('kontak');

    // ── Profil Customer ──────────────────────────────────────────
    Route::get('/profil',         [AkunController::class, 'show'])   ->name('akun');
    Route::put('/profil/update',  [AkunController::class, 'update']) ->name('akun.update');

});
