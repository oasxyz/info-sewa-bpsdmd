<?php

use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PengaturanController;

// User Routes
Route::get('/', fn() => view('home-infosewa'))->name('home');
Route::get('/pesan', [PemesananController::class, 'index'])->name('pesan');
Route::post('/pesan', [PemesananController::class, 'store']);
Route::get('/pesan/sukses', [PemesananController::class, 'sukses'])->name('pesan.sukses');
Route::get('/informasi', fn() => view('informasi'))->name('informasi');

// Admin Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.proses');
Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout'); // Ubah ke GET

// API Jadwal
Route::get('/api/jadwal', function () {
    $events = DB::table('pemesan')
        ->select('tanggal_pakai', 'keperluan')
        ->get()
        ->map(fn($e) => [
            'title' => $e->keperluan,
            'start' => $e->tanggal_pakai,
            'color' => '#e8834e',
        ]);
    return response()->json($events);
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