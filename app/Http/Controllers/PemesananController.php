<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use App\Models\Pemakai;
use App\Models\Gedung;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
{
    $gedungs = Gedung::all();
    return view('pesan-infosewa', compact('gedungs'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'no_ktp' => 'required|numeric|digits:16',
        'nama_pemesan' => 'required',
        'nama_pemakai' => 'required',
        'no_telepon_pemesan' => 'required|numeric',
        'no_telepon_pemakai' => 'required|numeric',
        'email' => 'required|email',
        'alamat' => 'required',
        'tanggal_pemakaian' => 'required|date',
        'waktu_pakai' => 'required|in:siang,malam,sehari',
        'keperluan' => 'required',
        'gedung' => 'required',
    ]);

    // Simpan ke tabel pemesan
    $pemesan = Pemesan::create([
    'no' => $request->no_ktp,
    'pemesan' => $request->nama_pemesan,
    'pemakai' => $request->nama_pemakai,
    'email' => $request->email,
    'alamat' => $request->alamat,
    'telp' => $request->no_telepon_pemesan,
    'hp' => $request->no_telepon_pemesan,
    'keperluan' => $request->keperluan,
    'tanggal_pakai' => $request->tanggal_pemakaian,
    'waktu' => strtoupper($request->waktu_pakai),
    'gedung' => $request->gedung,
    'fasilitas' => '',       
    'instansi' => '',        
    'temp' => 0,            
    'tanggal_pesan' => now(),
    ]);

    // Simpan ke tabel pemakai
    Pemakai::create([
        'no' => $request->no_ktp,
        'pemesan' => $request->nama_pemesan,
        'pemakai' => $request->nama_pemakai,
        'alamat' => $request->alamat,
        'telp' => $request->no_telepon_pemesan,
        'hp' => $request->no_telepon_pemakai,
        'keperluan' => $request->keperluan,
        'fasilitas' => '',
        'instansi' => '',
        'tanggal_pakai' => $request->tanggal_pemakaian,
        'waktu' => strtoupper($request->waktu_pakai),
        'gedung' => $request->gedung,
        'retribusi' => 0,
    ]);

    return redirect()->route('pesan.sukses')->with('data', [
        'no_ktp' => $request->no_ktp,
        'nama_pemesan' => $request->nama_pemesan,
        'nama_pemakai' => $request->nama_pemakai,
        'gedung' => $request->gedung,
        'tanggal_pemakaian' => $request->tanggal_pemakaian,
        'waktu_pakai' => $request->waktu_pakai,
        'keperluan' => $request->keperluan,
    ]);
}

public function sukses()
{
    $data = session('data');
    if (!$data) {
        return redirect()->route('pesan');
    }
    return view('pesan-sukses', compact('data'));
}
}
