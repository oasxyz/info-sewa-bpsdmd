<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Admin
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('password');
            $table->timestamps();
        });

        // Insert akun admin awal (Password: Pa$$w0rdAdmin yang sudah di-hash)
        DB::table('admin')->insert([
            'user' => 'diklat',
            'password' => Hash::make('Pa$$w0rdAdmin'),
        ]);

        // 2. Tabel gedung
        // PENTING: kolomnya disamain sama yang dipakai di halaman Informasi,
        // form Pesan, dan Pengaturan (kode, gedung, harga siang/malam/hari)
        Schema::create('gedung', function (Blueprint $table) {
            $table->string('kode', 4)->primary();
            $table->string('gedung', 60);
            $table->integer('luas')->default(0);
            $table->integer('kapasitas')->default(0);
            $table->integer('hargasiang');
            $table->integer('hargamalam');
            $table->integer('hargahari');
            $table->timestamps();
        });

        DB::table('gedung')->insert([
            [
                'kode' => '1',
                'gedung' => 'Balai Sasana Widya Praja',
                'luas' => 0,
                'kapasitas' => 800,
                'hargasiang' => 12500000,
                'hargamalam' => 15000000,
                'hargahari' => 20000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => '2',
                'gedung' => 'Aula Muria',
                'luas' => 0,
                'kapasitas' => 350,
                'hargasiang' => 7500000,
                'hargamalam' => 10000000,
                'hargahari' => 12500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 3. Tabel pemesan
        Schema::create('pemesan', function (Blueprint $table) {
            $table->id();
            $table->string('no', 16);
            $table->string('pemesan');
            $table->string('pemakai');
            $table->string('email', 100);
            $table->text('alamat');
            $table->string('telp', 20);
            $table->string('hp', 20);
            $table->string('keperluan');
            $table->date('tanggal_pakai');
            $table->string('waktu', 20);
            $table->string('gedung');
            $table->string('fasilitas')->nullable();
            $table->string('instansi')->nullable();
            $table->integer('temp')->default(0);
            $table->timestamp('tanggal_pesan')->nullable();
            $table->timestamps();
        });

        // 4. Tabel pemakai
        Schema::create('pemakai', function (Blueprint $table) {
            $table->id();
            $table->string('no', 16);
            $table->string('pemesan');
            $table->string('pemakai');
            $table->text('alamat');
            $table->string('telp', 20);
            $table->string('hp', 20);
            $table->string('keperluan');
            $table->string('fasilitas')->nullable();
            $table->string('instansi')->nullable();
            $table->date('tanggal_pakai');
            $table->string('waktu', 20);
            $table->string('gedung');
            $table->integer('retribusi')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
        Schema::dropIfExists('pemakai');
        Schema::dropIfExists('pemesan');
        Schema::dropIfExists('gedung');
    }
};