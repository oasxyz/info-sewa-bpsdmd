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
        // 1. Tabel Admin (Baru)
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
        Schema::create('gedung', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gedung');
            $table->timestamps();
        });

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
        Schema::dropIfExists('admin'); // Jangan lupa drop admin juga
        Schema::dropIfExists('pemakai');
        Schema::dropIfExists('pemesan');
        Schema::dropIfExists('gedung');
    }
};