<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->text('riwayat_pekerjaan')->nullable()->after('keterampilan');
        });
    }

    public function down()
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->dropColumn('riwayat_pekerjaan');
        });
    }

};
