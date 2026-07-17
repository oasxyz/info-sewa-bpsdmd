<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Gedung;
use App\Models\Pemakai;
use App\Models\Pemesan; 


class AdminAuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.login'); 
    }

    public function login(Request $request) {
        $request->validate(['username' => 'required', 'password' => 'required']);

        $admin = DB::table('admin')->where('user', $request->username)->first();

        // Cek pakai Hash::check (Pastikan di DB passwordnya sudah di-hash)
        // Kalau password di DB masih format lama, pakai: $admin->password == $request->password
        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['login_user' => $admin->user]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function dashboard()
    {
    if (!session()->has('login_user')) return redirect()->route('admin.login');

    $rows = DB::table('pemakai')
        ->selectRaw('YEAR(tanggal_pakai) as tahun, MONTH(tanggal_pakai) as bulan, COUNT(*) as jumlah')
        ->groupBy('tahun', 'bulan')
        ->orderBy('tahun')
        ->get();

    $rekap = [];
    foreach ($rows as $row) {
        $rekap[$row->tahun][$row->bulan] = $row->jumlah;
    }

    // Padding biar tahun tanpa data tetep muncul (0), dari tahun paling lama sampe tahun depan
    $minYear = $rows->min('tahun') ?? now()->year;
    $maxYear = now()->year + 1;
    for ($y = $minYear; $y <= $maxYear; $y++) {
        if (!isset($rekap[$y])) $rekap[$y] = [];
    }
    ksort($rekap);

    return view('auth.dashboard', compact('rekap'));
    }

    public function daftarPemesan(Request $request)
    {
        if (!session()->has('login_user')) return redirect()->route('admin.login');

        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        // Default ke bulan & tahun sekarang kalau belum ada filter yang dipilih
        $bulanAktif = $bulan ?: now()->month;
        $tahunAktif = $tahun ?: now()->year;

        $pemesanan = Pemesan::whereMonth('tanggal_pakai', $bulanAktif)
            ->whereYear('tanggal_pakai', $tahunAktif)
            ->orderBy('tanggal_pesan', 'desc')
            ->paginate(20)
            ->withQueryString();

        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
        $judulBulan = $namaBulan[$bulanAktif];

        $tahunMin = Pemesan::selectRaw('MIN(YEAR(tanggal_pakai)) as tahun')->value('tahun') ?? now()->year;
        $tahunOptions = range($tahunMin, now()->year + 1);

        return view('auth.pemesanan', compact('pemesanan', 'judulBulan', 'tahunAktif', 'tahunOptions'));
    }

public function ubahStatus($id)
{
    if (!session()->has('login_user')) return redirect()->route('admin.login');

    $pemesan = Pemesan::findOrFail($id);
    $request = request();

    if ($request->status == 'terverifikasi' && $pemesan->status == 'proses') {
        $pemesan->update(['status' => 'terverifikasi']);
    } elseif ($request->status == 'dipesan' && $pemesan->status == 'terverifikasi') {
        $pemesan->update(['status' => 'dipesan']);
    } elseif ($request->status == 'dibatalkan') {
        $pemesan->update(['status' => 'dibatalkan']);
    }

    return back()->with('success', 'Status berhasil diupdate');
}

    public function tambahPemesan()
{
    if (!session()->has('login_user')) return redirect()->route('admin.login');

    $gedungs = Gedung::all();
    return view('auth.pemesanan-tambah', compact('gedungs'));
}

public function storePemesan(Request $request)
{
    if (!session()->has('login_user')) return redirect()->route('admin.login');

    $request->validate([
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

    // Simpan ke tabel pemesan (status langsung terverifikasi)
    $pemesan = Pemesan::create([
        'kode_booking' => $kodeBooking = 'PES-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4)),
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
        'status' => 'terverifikasi',
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

    return redirect()->route('admin.pemesanan.tambah')->with('success', 'Pemesanan berhasil ditambahkan');
}

    public function logout() {
        session()->forget('login_user');
        return redirect()->route('admin.login');
    }
}