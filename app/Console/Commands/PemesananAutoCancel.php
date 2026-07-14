<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pemesan;

class PemesananAutoCancel extends Command
{
    protected $signature = 'pemesanan:auto-cancel';
    protected $description = 'Batalkan otomatis pemesanan yang tidak memenuhi syarat';

    public function handle()
    {
        $jumlah = 0;

        // 1. Cancel booking > 7 hari masih status 'proses' (belum verifikasi KTP)
        $jumlah += Pemesan::where('status', 'proses')
            ->where('tanggal_pesan', '<', now()->subDays(7))
            ->update(['status' => 'dibatalkan']);

        // 2. Cancel booking status proses/terverifikasi yang tanggal_pakai < 60 hari dari sekarang
        $jumlah += Pemesan::whereIn('status', ['proses', 'terverifikasi'])
            ->where('tanggal_pakai', '<', now()->addDays(60))
            ->update(['status' => 'dibatalkan']);

        $this->info("Auto-cancel selesai. $jumlah pemesanan dibatalkan.");
    }
}  