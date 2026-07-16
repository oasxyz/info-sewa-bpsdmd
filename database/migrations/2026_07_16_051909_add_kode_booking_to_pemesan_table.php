<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('pemesan', function (Blueprint $table) {
        $table->string('kode_booking', 30)->after('id')->nullable();
    });

    // Isi kode_booking buat data lama yang kosong
    DB::table('pemesan')->whereNull('kode_booking')->get()->each(function ($row) {
        DB::table('pemesan')->where('id', $row->id)->update([
            'kode_booking' => 'PES-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4)),
        ]);
    });

    Schema::table('pemesan', function (Blueprint $table) {
        $table->string('kode_booking', 30)->unique()->change();
    });
}

public function down(): void
{
    Schema::table('pemesan', function (Blueprint $table) {
        $table->dropColumn('kode_booking');
    });
}
};