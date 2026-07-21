<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
  public function index(Request $request)
  {
    if (!session()->has('login_user')) return redirect()->route('admin.login');
    $tahun = $request->tahun ?? date('Y');
    $bulan = $request->bulan ?? '';

    $data = DB::table('pemesan')
      ->join('pemakai', 'pemesan.no', '=', 'pemakai.no')
      ->select(
        'pemesan.no',
        'pemesan.tanggal_pakai',
        'pemesan.pemesan',
        'pemesan.pemakai',
        'pemesan.gedung',
        'pemesan.waktu',
        'pemesan.alamat',
        'pemesan.telp',
        'pemakai.retribusi'
      )
      ->whereYear('pemesan.tanggal_pakai', $tahun)
      ->when($bulan, fn($q) => $q->whereMonth('pemesan.tanggal_pakai', $bulan))
      ->orderBy('pemesan.tanggal_pakai')
      ->get();

    $total = $data->sum('retribusi');

    $tahunList = DB::table('pemesan')->selectRaw('YEAR(tanggal_pakai) thn')->distinct()->orderBy('thn')->pluck('thn');
    if ($tahunList->isEmpty()) {
      $tahunList = collect([date('Y'), date('Y') + 1]);
    }

    return view('laporan.index', compact('data', 'total', 'tahun', 'bulan', 'tahunList'));
  }
}