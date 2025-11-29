<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lowongans', function (Blueprint $table) {
            // text saja biar fleksibel (bisa JSON / comma separated), nullable biar tidak wajib
            $table->text('keahlian')->nullable()->after('kualifikasi');
        });
    }

    public function down(): void
    {
        Schema::table('lowongans', function (Blueprint $table) {
            $table->dropColumn('keahlian');
        });
    }
};
