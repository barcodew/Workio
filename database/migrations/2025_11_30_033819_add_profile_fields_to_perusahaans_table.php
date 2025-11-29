<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perusahaans', function (Blueprint $table) {
            $table->string('jumlah_karyawan', 50)->nullable()->after('bidang_usaha');
            $table->integer('tahun_berdiri')->nullable()->after('jumlah_karyawan');
        });
    }

    public function down(): void
    {
        Schema::table('perusahaans', function (Blueprint $table) {
            $table->dropColumn(['jumlah_karyawan', 'tahun_berdiri']);
        });
    }
};
