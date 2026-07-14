<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ===== KONTAK (Contact Person di halaman Informasi & Pengaturan) =====
        Schema::create('kontak', function (Blueprint $table) {
            $table->id('no');
            $table->string('nama', 32);
            $table->string('telepon', 14);
            $table->string('alamat', 60);
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });

        DB::table('kontak')->insert([
            [
                'nama' => 'RIDWAN NUGRAHAPASA, S.STP.',
                'telepon' => '081229796797',
                'alamat' => 'BPSDMD Prov. Jateng',
                'email' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'RISTI NELASAPUTRI, S.I.Kom.',
                'telepon' => '081390030404',
                'alamat' => 'BPSDMD Prov. Jateng',
                'email' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ===== PEJABAT (Sekretaris & Bendahara) =====
        Schema::create('pejabat', function (Blueprint $table) {
            $table->enum('posisi', ['sekretaris', 'bendahara'])->primary();
            $table->string('nama', 60);
            $table->bigInteger('nip');
            $table->timestamps();
        });

        DB::table('pejabat')->insert([
            [
                'posisi' => 'sekretaris',
                'nama' => 'Hermoyo Widodo, SH. M.Hum',
                'nip' => 196510211994031006,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'posisi' => 'bendahara',
                'nama' => 'RR.ASTUTI EKAWATI, SE',
                'nip' => 198112112010012029,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ===== USER (Manage User di halaman Pengaturan, beda dari tabel admin) =====
        Schema::create('user', function (Blueprint $table) {
            $table->id('no');
            $table->string('user', 24);
            $table->string('password');
            $table->timestamps();
        });

        // ===== FASILITAS (deskripsi fasilitas gedung, global) =====
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id('id_fasilitas');
            $table->text('deskripsi_fasilitas');
            $table->timestamps();
        });

        DB::table('fasilitas')->insert([
            'deskripsi_fasilitas' => '<ul>'
                .'<li>Kapasitas 800 orang</li>'
                .'<li>Kursi lipat 100 buah</li>'
                .'<li>Listrik 30.000 watt</li>'
                .'<li>Full AC (portable 8 buah)</li>'
                .'<li>Ruang transit VIP</li>'
                .'<li>Dapur bersih</li>'
                .'<li>Toilet</li>'
                .'<li>Lahan parkir yang luas (tanpa petugas parkir)</li>'
                .'</ul>',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
        Schema::dropIfExists('user');
        Schema::dropIfExists('pejabat');
        Schema::dropIfExists('kontak');
    }
};