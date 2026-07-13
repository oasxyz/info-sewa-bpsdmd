<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Bikin tabel gedung (karena dipanggil di Gedung::all())
        Schema::create('gedung', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gedung');
            $table->timestamps();
        });

        // 2. Bikin tabel pemesan
        Schema::create('pemesan', function (Blueprint $table) {
            $table->id();
            $table->string('no', 16); // no_ktp
            $table->string('pemesan'); // nama_pemesan
            $table->string('pemakai'); // nama_pemakai
            $table->string('email', 100); 
            $table->text('alamat');
            $table->string('telp', 20);
            $table->string('hp', 20);
            $table->string('keperluan');
            $table->date('tanggal_pakai');
            $table->string('waktu', 20); // siang, malam, sehari
            $table->string('gedung'); 
            $table->string('fasilitas')->nullable();       
            $table->string('instansi')->nullable();        
            $table->integer('temp')->default(0);            
            $table->timestamp('tanggal_pesan')->nullable();
            $table->timestamps();
        });

        // 3. Bikin tabel pemakai
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakai');
        Schema::dropIfExists('pemesan');
        Schema::dropIfExists('gedung');
    }
};