<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CekAdmin;
use App\Http\Controllers\LaporanController;

// ========================================================
// HALAMAN UTAMA (Publik)
// ========================================================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ========================================================
// CEK STATUS CUCIAN (Publik - Tanpa Login)
// ========================================================
Route::get('/cek-status', function (Illuminate\Http\Request $request) {
    $nota = $request->input('nota');
    $transaksi = null;
    $pesan = null;

    if ($nota) {
        $transaksi = App\Models\Transaksi::with(['pelanggan', 'layanan', 'details.layanan'])
            ->where('no_nota', $nota)->first();
        if (!$transaksi) {
            $pesan = 'Nomor nota "' . $nota . '" tidak ditemukan. Pastikan nomor nota ditulis dengan benar.';
        }
    }

    return view('cek-status', compact('transaksi', 'nota', 'pesan'));
})->name('cek.status');

// ========================================================
// DASHBOARD
// ========================================================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ========================================================
// RUTE BUTUH LOGIN
// ========================================================
Route::middleware('auth')->group(function () {

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pelanggan & Transaksi (Admin + Kasir)
    Route::get('/pelanggan/lookup/by-phone', [PelangganController::class, 'lookup'])->name('pelanggan.lookup');
    Route::resource('pelanggan', PelangganController::class);
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
    Route::resource('transaksi', TransaksiController::class);

    // Khusus Admin
    Route::middleware([CekAdmin::class])->group(function () {
        Route::resource('layanan', LayananController::class);
        Route::resource('user', UserController::class);
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });
});

require __DIR__.'/auth.php';
