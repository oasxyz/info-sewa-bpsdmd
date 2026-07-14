<?php

use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PengaturanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// User Routes
Route::get('/', fn() => view('home-infosewa'))->name('home');
Route::get('/pesan', [PemesananController::class, 'index'])->name('pesan');
Route::post('/pesan', [PemesananController::class, 'store']);
Route::get('/pesan/sukses', [PemesananController::class, 'sukses'])->name('pesan.sukses');

// Admin Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.proses');
Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/pemesanan', [AdminAuthController::class, 'daftarPemesan'])->name('admin.pemesanan');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout'); 
Route::post('/admin/pemesanan/{id}/status', [AdminAuthController::class, 'ubahStatus'])->name('admin.pemesanan.status');

// API Jadwal
Route::get('/api/jadwal', function () {
    return DB::table('pemesan')
        ->whereIn('status', ['proses', 'terverifikasi', 'dipesan'])
        ->select('tanggal_pakai', 'keperluan', 'gedung', 'status')
        ->get()
        ->map(fn($e) => [
            'title' => $e->keperluan,
            'start' => $e->tanggal_pakai,
            'color' => $e->status === 'dipesan'
                ? ($e->gedung === 'Balai Sasana Widya Praja' ? '#7a1f1f' : '#1e4d20')   // gelap = fix
                : ($e->gedung === 'Balai Sasana Widya Praja' ? '#e8834e' : '#6aa84f'),  // terang = proses
        ]);
});

Route::get('/admin/pengaturan', [PengaturanController::class, 'index'])->name('admin.pengaturan');
 
// Manage User
Route::post('/admin/pengaturan/user', [PengaturanController::class, 'storeUser']);
Route::put('/admin/pengaturan/user/{no}', [PengaturanController::class, 'updateUser']);
Route::delete('/admin/pengaturan/user/{no}', [PengaturanController::class, 'destroyUser']);
 
// Contact Person
Route::post('/admin/pengaturan/kontak', [PengaturanController::class, 'storeKontak']);
Route::put('/admin/pengaturan/kontak/{no}', [PengaturanController::class, 'updateKontak']);
Route::delete('/admin/pengaturan/kontak/{no}', [PengaturanController::class, 'destroyKontak']);
 
// Sekretaris / Bendahara
Route::put('/admin/pengaturan/pejabat/{posisi}', [PengaturanController::class, 'updatePejabat']);
 
// Tarif Gedung
Route::put('/admin/pengaturan/gedung/{kode}', [PengaturanController::class, 'updateGedung']);
 
// Fasilitas
Route::put('/admin/pengaturan/fasilitas/{id}', [PengaturanController::class, 'updateFasilitas']);

Route::get('/informasi', function () {
    $gedungs = DB::table('gedung')->orderBy('kode')->get();
    $kontaks = DB::table('kontak')->orderBy('no')->get();

    return view('informasi', compact('gedungs', 'kontaks'));
})->name('informasi');