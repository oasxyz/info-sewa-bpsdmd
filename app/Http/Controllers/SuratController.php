<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use App\Support\TanggalIndonesia;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SuratController extends Controller
{
    // Ukuran kertas Folio (21cm x 33cm dalam poin) - sama kayak yang dipake sistem lama
    private const PAPER_FOLIO = [0, 0, 595.28, 935.43];

    public function permohonan($id)
    {
        $pemesan = Pemesan::findOrFail($id);
        $tanggalPakai = Carbon::parse($pemesan->tanggal_pakai);

        $data = [
            'pemesan' => $pemesan,
            'hari' => TanggalIndonesia::hari($tanggalPakai),
            'tanggalFormat' => TanggalIndonesia::format($tanggalPakai),
        ];

        $pdf = Pdf::loadView('pdf.surat-permohonan', $data)->setPaper(self::PAPER_FOLIO, 'portrait');

        return $pdf->stream('Surat Permohonan - ' . $pemesan->pemesan . '.pdf');
    }

    public function balasan($id)
    {
        $pemesan = Pemesan::findOrFail($id);
        $gedung = DB::table('gedung')->where('gedung', $pemesan->gedung)->first();
        $sekretaris = DB::table('pejabat')->where('posisi', 'sekretaris')->first();
        $tanggalPakai = Carbon::parse($pemesan->tanggal_pakai);

        [$jamSewa, $tarif] = $this->jamDanTarif($pemesan->waktu, $gedung);

        $data = [
            'pemesan' => $pemesan,
            'hari' => TanggalIndonesia::hari($tanggalPakai),
            'tanggalFormat' => TanggalIndonesia::format($tanggalPakai),
            'bulanSekarang' => TanggalIndonesia::bulan(now()),
            'tahunSekarang' => now()->year,
            'jamSewa' => $jamSewa,
            'tarif' => $tarif,
            'terbilang' => TanggalIndonesia::rupiahTerbilang($tarif),
            'sekretaris' => $sekretaris,
        ];

        $pdf = Pdf::loadView('pdf.surat-balasan', $data)->setPaper(self::PAPER_FOLIO, 'portrait');

        return $pdf->stream('Surat Balasan - ' . $pemesan->pemesan . '.pdf');
    }

    public function mou($id)
    {
        $pemesan = Pemesan::findOrFail($id);
        $gedung = DB::table('gedung')->where('gedung', $pemesan->gedung)->first();
        $kepala = DB::table('pejabat')->where('posisi', 'kepala')->first();

        $tanggalPakai = Carbon::parse($pemesan->tanggal_pakai);
        $sekarang = now();

        [$jamSewa, $tarif] = $this->jamDanTarif($pemesan->waktu, $gedung);

        $data = [
            'pemesan' => $pemesan,
            'hariPakai' => TanggalIndonesia::hari($tanggalPakai),
            'tanggalPakaiFormat' => TanggalIndonesia::format($tanggalPakai),
            'hariMou' => TanggalIndonesia::hari($sekarang),
            'tanggalMouTerbilang' => TanggalIndonesia::terbilang((int) $sekarang->format('d')),
            'bulanMou' => TanggalIndonesia::bulan($sekarang),
            'tahunMou' => $sekarang->format('Y'),
            'jamSewa' => $jamSewa,
            'tarif' => $tarif,
            'kepala' => $kepala,
        ];

        $pdf = Pdf::loadView('pdf.mou', $data)->setPaper(self::PAPER_FOLIO, 'portrait');

        return $pdf->stream('MOU - ' . $pemesan->pemesan . '.pdf');
    }

    private function jamDanTarif(?string $waktu, $gedung): array
    {
        return match ($waktu) {
            'SIANG' => ['08.00 - 13.00 WIB (Siang)', $gedung->hargasiang ?? 0],
            'MALAM' => ['15.00 - 22.00 WIB (Malam)', $gedung->hargamalam ?? 0],
            '1HARI' => ['08.00 - 22.00 WIB (Sehari)', $gedung->hargahari ?? 0],
            default => ['-', 0],
        };
    }
}