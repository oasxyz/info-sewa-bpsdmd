<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
  public function bayarDimuka(Request $request)
  {
    if (!session()->has('login_user')) return redirect()->route('admin.login');
    $tahun = $request->tahun ?? date('Y');
    $bulan = $request->bulan ?? '';

    $data = DB::table('pemesan')
      ->join('pemakai', 'pemesan.no', '=', 'pemakai.no')
      ->select('pemesan.no', 'pemesan.pemesan', 'pemesan.pemakai', 'pemesan.gedung', 'pemesan.tanggal_pakai', 'pemesan.waktu', 'pemakai.retribusi')
      ->whereYear('pemesan.tanggal_pakai', $tahun)
      ->when($bulan, fn($q) => $q->whereMonth('pemesan.tanggal_pakai', $bulan))
      ->orderBy('pemesan.tanggal_pakai')
      ->get();

    $total = $data->sum('retribusi');
    $tahunList = DB::table('pemesan')->selectRaw('YEAR(tanggal_pakai) thn')->distinct()->orderBy('thn')->pluck('thn');

    return view('laporan.bayar-dimuka', compact('data', 'total', 'tahun', 'bulan', 'tahunList'));
  }

  public function penerimaan(Request $request)
  {
    if (!session()->has('login_user')) return redirect()->route('admin.login');
    $tahun = $request->tahun ?? date('Y');
    $bulan = $request->bulan ?? '';

    $data = DB::table('pemesan')
      ->join('pemakai', 'pemesan.no', '=', 'pemakai.no')
      ->select('pemesan.no', 'pemesan.pemakai', 'pemesan.gedung', 'pemesan.tanggal_pakai', 'pemesan.waktu', 'pemakai.retribusi')
      ->whereYear('pemesan.tanggal_pakai', $tahun)
      ->when($bulan, fn($q) => $q->whereMonth('pemesan.tanggal_pakai', $bulan))
      ->orderBy('pemesan.tanggal_pakai')
      ->get();

    $total = $data->sum('retribusi');
    $tahunList = DB::table('pemesan')->selectRaw('YEAR(tanggal_pakai) thn')->distinct()->orderBy('thn')->pluck('thn');

    return view('laporan.penerimaan', compact('data', 'total', 'tahun', 'bulan', 'tahunList'));
  }

  public function pemakaiGedung(Request $request)
  {
    if (!session()->has('login_user')) return redirect()->route('admin.login');
    $tahun = $request->tahun ?? date('Y');
    $bulan = $request->bulan ?? '';

    $data = DB::table('pemesan')
      ->select('no', 'tanggal_pakai', 'pemesan', 'pemakai', 'alamat', 'telp')
      ->whereYear('tanggal_pakai', $tahun)
      ->when($bulan, fn($q) => $q->whereMonth('tanggal_pakai', $bulan))
      ->orderBy('tanggal_pakai')
      ->get();

    $tahunList = DB::table('pemesan')->selectRaw('YEAR(tanggal_pakai) thn')->distinct()->orderBy('thn')->pluck('thn');

    return view('laporan.pemakai-gedung', compact('data', 'tahun', 'bulan', 'tahunList'));
  }

}