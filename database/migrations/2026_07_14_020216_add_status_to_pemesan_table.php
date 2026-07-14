<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('pemesan', function (Blueprint $table) {
        $table->enum('status', ['proses', 'terverifikasi', 'dipesan', 'dibatalkan'])
            ->default('proses')
            ->after('temp');
    });
}
};
