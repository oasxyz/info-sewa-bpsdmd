<?php

use App\Http\Controllers\PemesananController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
    return view('home-infosewa');
})->name('home');

Route::get('/pesan', [PemesananController::class, 'index'])->name('pesan');
Route::post('/pesan', [PemesananController::class, 'store']);
Route::get('/pesan/sukses', [PemesananController::class, 'sukses'])->name('pesan.sukses');

Route::get('/informasi', function () {
    return view('informasi');
})->name('informasi');

<<<<<<< HEAD
Route::get('/admin/login', function () {
    return view('auth.login'); 
=======
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
>>>>>>> 0675b9703696603ef1de5d3678bbd95d6d9e7f02
});