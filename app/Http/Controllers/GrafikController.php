<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class GrafikController extends Controller
{
    public function jumlahPemakai(Request $request)
    {
        if (! session()->has('login_user')) {
            return redirect()->route('admin.login');
        }
 
        $tahunAda = DB::table('pemakai')
            ->selectRaw('DISTINCT YEAR(tanggal_pakai) as tahun')
            ->pluck('tahun');
 
        // Padding rentang tahun sama kayak di Dashboard (data paling lama - tahun depan)
        $minYear = $tahunAda->min() ?? now()->year;
        $maxYear = now()->year + 1;
        $tahunOptions = range($minYear, $maxYear);
 
        $tahunDipilih = $request->query('tahun');
 
        $data = collect();
        if ($tahunDipilih) {
            $rows = DB::table('pemakai')
                ->selectRaw('MONTH(tanggal_pakai) as bulan, COUNT(*) as jumlah')
                ->whereYear('tanggal_pakai', $tahunDipilih)
                ->groupBy('bulan')
                ->get();
 
            foreach ($rows as $row) {
                $data[$row->bulan] = $row->jumlah;
            }
        }
 
        return view('auth.grafik-pemakai', [
            'tahunOptions' => $tahunOptions,
            'tahunDipilih' => $tahunDipilih,
            'data' => $data,
        ]);
    }
 
    public function rekapitulasi()
    {
        if (! session()->has('login_user')) {
            return redirect()->route('admin.login');
        }
 
        $rows = DB::table('pemakai')
            ->selectRaw('YEAR(tanggal_pakai) as tahun, MONTH(tanggal_pakai) as bulan, COUNT(*) as jumlah')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->get();
 
        $rekap = [];
        foreach ($rows as $row) {
            $rekap[$row->tahun][$row->bulan] = $row->jumlah;
        }
 
        $minYear = $rows->min('tahun') ?? now()->year;
        $maxYear = now()->year + 1;
        for ($y = $minYear; $y <= $maxYear; $y++) {
            if (! isset($rekap[$y])) {
                $rekap[$y] = [];
            }
        }
        ksort($rekap);
 
        // Siapin data buat Chart.js
        $chartLabels = ['Jan', 'Peb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nop', 'Des'];
        $colors = ['#fed136', '#212529', '#4caf50', '#ff9800', '#2196f3', '#e91e63', '#9c27b0', '#00bcd4', '#795548', '#607d8b'];
 
        $chartDatasets = [];
        $i = 0;
        foreach ($rekap as $tahun => $bulanData) {
            $data = [];
            for ($b = 1; $b <= 12; $b++) {
                $data[] = $bulanData[$b] ?? 0;
            }
            $chartDatasets[] = [
                'label' => (string) $tahun,
                'data' => $data,
                'backgroundColor' => $colors[$i % count($colors)],
            ];
            $i++;
        }
 
        $pieLabels = array_keys($rekap);
        $pieData = [];
        foreach ($rekap as $tahun => $bulanData) {
            $pieData[] = array_sum($bulanData);
        }
 
        return view('auth.grafik-rekapitulasi', compact(
            'rekap', 'chartLabels', 'chartDatasets', 'pieLabels', 'pieData'
        ));
    }
}