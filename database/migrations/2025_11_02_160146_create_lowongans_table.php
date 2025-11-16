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
        Schema::create('lowongans', function (Blueprint $t) {
            $t->id();
            $t->foreignId('perusahaan_id')->constrained('perusahaans')->cascadeOnDelete();
            $t->string('judul', 200);
            $t->text('deskripsi');
            $t->text('kualifikasi')->nullable();
            $t->string('lokasi', 150)->nullable();
            $t->enum('tipe_pekerjaan', ['Full-time','Part-time','Internship','Contract'])->nullable();
            $t->date('deadline')->nullable();
            $t->enum('status', ['draft','pending','published','closed'])->default('pending');
            $t->timestamps();
            $t->index(['status','deadline']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};
