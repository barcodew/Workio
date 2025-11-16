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
        Schema::create('lamarans', function (Blueprint $t) {
            $t->id();
            $t->foreignId('lowongan_id')->constrained('lowongans')->cascadeOnDelete();
            $t->foreignId('user_id')->constrained('users')->cascadeOnDelete(); 
            $t->dateTime('tanggal_lamar')->nullable();
            $t->enum('status', ['dikirim','diproses','diterima','ditolak'])->default('dikirim');
            $t->string('file_cv', 255)->nullable();
            $t->string('surat_lamaran', 255)->nullable();
            $t->timestamps();
            $t->unique(['lowongan_id','user_id']); 
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamarans');
    }
};
