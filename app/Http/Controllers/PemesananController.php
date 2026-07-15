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
        'no_ktp' => 'required|numeric',
        'nama_pemesan' => 'required',
        'nama_pemakai' => 'required',
        'no_telepon_pemesan' => 'required|numeric',
        'no_telepon_pemakai' => 'required|numeric',
        'email' => 'required|email',
        'alamat' => 'required',
        'tanggal_pemakaian' => 'required|date',
        'waktu_pakai' => 'required|in:siang,malam,1hari',
        'keperluan' => 'required',
        'gedung' => 'required',
    ]);

// CEK ATURAN GEDUNG BALAI SASANA WIDYA PRAJA
if ($request->gedung === 'Balai Sasana Widya Praja') {
    $tanggal = $request->tanggal_pemakaian;
    $hariInggris = date('l', strtotime($tanggal));

    $tahun = date('Y', strtotime($tanggal));
    $responseLibur = @file_get_contents("https://api-hari-libur.vercel.app/api?year=$tahun");
    $dataLibur = $responseLibur ? json_decode($responseLibur, true)['data'] : [];
    $isLibur = false;
    foreach ($dataLibur as $libur) {
        if ($libur['date'] === $tanggal) {
            $isLibur = true;
            break;
        }
    }

    $isJumat = $hariInggris === 'Friday';
    $isSabtu = $hariInggris === 'Saturday';
    $isMinggu = $hariInggris === 'Sunday';

    if (!$isJumat && !$isSabtu && !$isMinggu && !$isLibur) {
        return back()->withErrors([
            'tanggal_pemakaian' => 'Gedung Sasana Widya Praja hanya dapat disewa pada hari Jumat Malam, Sabtu, Minggu, dan hari libur nasional.'
        ])->withInput();
    }

    if ($isJumat && !$isLibur && $request->waktu_pakai !== 'malam') {
        return back()->withErrors([
            'waktu_pakai' => 'Untuk hari Jumat, Gedung Sasana Widya Praja hanya tersedia sesi malam.'
        ])->withInput();
    }
}

    // Cek duplikat slot
    $cek = Pemesan::where('tanggal_pakai', $request->tanggal_pemakaian)
        ->where('gedung', $request->gedung)
        ->get();

    foreach ($cek as $c) {
        if ($c->waktu === '1HARI') {
            return back()->withErrors(['tanggal_pemakaian' => 'Tanggal ini sudah dipesan FULL DAY untuk gedung ' . $request->gedung])->withInput();
        }
        if ($request->waktu_pakai === 'siang' && $c->waktu === 'SIANG') {
            return back()->withErrors(['waktu_pakai' => 'Slot siang sudah dipesan di tanggal dan gedung ini'])->withInput();
        }
        if ($request->waktu_pakai === 'malam' && $c->waktu === 'MALAM') {
            return back()->withErrors(['waktu_pakai' => 'Slot malam sudah dipesan di tanggal dan gedung ini'])->withInput();
        }
        if ($request->waktu_pakai === '1hari' && in_array($c->waktu, ['SIANG', 'MALAM'])) {
            return back()->withErrors(['waktu_pakai' => 'Tidak bisa booking full day, karena slot siang/malam sudah ada yang pesan'])->withInput();
        }
    }

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
    'status' => 'proses',           
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
