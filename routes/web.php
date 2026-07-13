<?php

use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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