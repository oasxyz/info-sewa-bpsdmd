<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use App\Models\Pemakai;
use App\Models\Gedung;
use Illuminate\Http\Request;
use App\Support\TanggalIndonesia;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
    $kodeBooking = 'PES-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    $pemesan = Pemesan::create([
    'kode_booking' => $kodeBooking,
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

    return redirect()->route('pesan.sukses', $kodeBooking);
}

public function sukses($kode_booking)
{
    $pemesanan = Pemesan::where('kode_booking', $kode_booking)->firstOrFail();
    return view('pesan-sukses', compact('pemesanan'));
}

public function cetakBukti($kode_booking)
{
    $pemesan = Pemesan::where('kode_booking', $kode_booking)->firstOrFail();
    $gedung = DB::table('gedung')->where('gedung', $pemesan->gedung)->first();

    $tanggalPakai = Carbon::parse($pemesan->tanggal_pakai);
    $tanggalPesan = Carbon::parse($pemesan->tanggal_pesan);

    $tarif = match ($pemesan->waktu) {
        'SIANG' => $gedung->hargasiang ?? 0,
        'MALAM' => $gedung->hargamalam ?? 0,
        '1HARI' => $gedung->hargahari ?? 0,
        default => 0,
    };

    $data = [
        'pemesan' => $pemesan,
        'hari' => TanggalIndonesia::hari($tanggalPakai),
        'tanggal' => $tanggalPakai->format('d'),
        'bulan' => TanggalIndonesia::bulan($tanggalPakai),
        'tahun' => $tanggalPakai->format('Y'),
        'waktu' => $pemesan->waktu,
        'tarif' => $tarif,
        'terbilang' => TanggalIndonesia::rupiahTerbilang($tarif),
        'tanggalPesan' => $tanggalPesan->format('d/m/Y H:i:s'),
        'tanggalskr' => now()->format('d/m/Y H:i:s'),
    ];

    $pdf = Pdf::loadView('pdf.bukti-pemesanan', $data);
    return $pdf->stream('Bukti Pemesanan - ' . $pemesan->pemesan . '.pdf');
}
}
