<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('perusahaans', function (Blueprint $t) {
            $t->string('email_kantor')->nullable();
            $t->string('telepon', 50)->nullable();
            $t->string('website')->nullable();
            $t->string('kota', 100)->nullable();
            $t->string('provinsi', 100)->nullable();
            $t->string('kode_pos', 20)->nullable();


            // sosmed
            $t->string('linkedin')->nullable();
            $t->string('instagram')->nullable();
            $t->string('facebook')->nullable();

            // media
           
            $t->string('banner_path')->nullable();
        });
    }

    public function down(): void {
        Schema::table('perusahaans', function (Blueprint $t) {
            $t->dropColumn([
                'email_kantor','telepon','website','kota','provinsi','kode_pos'
                ,'linkedin','instagram','facebook','banner_path'
            ]);
        });
    }
};