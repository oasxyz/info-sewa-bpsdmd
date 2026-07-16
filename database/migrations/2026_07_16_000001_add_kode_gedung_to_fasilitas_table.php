<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            $table->string('kode_gedung', 4)->nullable()->after('id_fasilitas');
        });

        DB::table('fasilitas')
            ->orderBy('id_fasilitas')
            ->limit(1)
            ->update([
                'kode_gedung' => '1',
                'deskripsi_fasilitas' => 'Kapasitas 800 orang<br>'
                    .'Kursi lipat 100 buah<br>'
                    .'Listrik 30.000 watt<br>'
                    .'Full AC (portable 8 buah)<br>'
                    .'Ruang transit VIP<br>'
                    .'Dapur bersih<br>'
                    .'Toilet<br>'
                    .'Lahan parkir yang luas (tanpa petugas parkir)',
            ]);

        // Baris baru khusus Aula Muria (kode_gedung = '2')
        DB::table('fasilitas')->insert([
            'kode_gedung' => '2',
            'deskripsi_fasilitas' => 'Kapasitas 350 orang<br>'
                .'Kursi lipat 100 buah<br>'
                .'Listrik 15.000 watt<br>'
                .'Full AC (portable 6 buah)<br>'
                .'Ruang transit<br>'
                .'Toilet<br>'
                .'Lahan parkir yang luas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            $table->dropColumn('kode_gedung');
        });
    }
};
