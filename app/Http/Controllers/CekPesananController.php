<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use Illuminate\Http\Request;

class CekPesananController extends Controller
{
    public function index()
    {
        return view('cek-pesanan');
    }

    public function cek(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|numeric',
        ]);

        $pemesanan = Pemesan::where('no', $request->no_ktp)
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        return view('cek-pesanan', compact('pemesanan'));
    }
    public function status($kode_booking)
    {
        $pemesanan = Pemesan::where('kode_booking', $kode_booking)->firstOrFail();
        return view('cek-status', compact('pemesanan'));
    }
}