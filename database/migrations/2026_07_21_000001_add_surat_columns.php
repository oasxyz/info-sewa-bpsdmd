<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah posisi 'kepala' ke enum pejabat (penandatangan MOU - PIHAK PERTAMA)
        DB::statement("ALTER TABLE pejabat MODIFY posisi ENUM('sekretaris','bendahara','kepala') NOT NULL");

        DB::table('pejabat')->updateOrInsert(
            ['posisi' => 'kepala'],
            [
                'nama' => 'Drs. Mohamad Arief Irwanto, M.Si',
                'nip' => 196806141990011001,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        DB::table('pejabat')->where('posisi', 'kepala')->delete();
        DB::statement("ALTER TABLE pejabat MODIFY posisi ENUM('sekretaris','bendahara') NOT NULL");
    }
};