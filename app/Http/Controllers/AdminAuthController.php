<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function daftarPemesan()
{
    if (!session()->has('login_user')) return redirect()->route('admin.login');

    $pemesanan = Pemesan::orderBy('tanggal_pesan', 'desc')->paginate(20);
    return view('auth.pemesanan', compact('pemesanan'));
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

    public function logout() {
        session()->forget('login_user');
        return redirect()->route('admin.login');
    }
}