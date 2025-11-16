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
        Schema::create('pelamars', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $t->date('tanggal_lahir')->nullable();
            $t->string('alamat', 255)->nullable();
            $t->string('telepon', 20)->nullable();
            $t->text('pendidikan')->nullable();
            $t->text('keterampilan')->nullable();
            $t->string('cv_path', 255)->nullable();
            $t->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamars');
    }
};
