<?php

use App\Http\Controllers\PemesananController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home-infosewa');
})->name('home');

Route::get('/pesan', [PemesananController::class, 'index'])->name('pesan');
Route::post('/pesan', [PemesananController::class, 'store']);
Route::get('/pesan/sukses', [PemesananController::class, 'sukses'])->name('pesan.sukses');

Route::get('/informasi', function () {
    return view('informasi');
})->name('informasi');