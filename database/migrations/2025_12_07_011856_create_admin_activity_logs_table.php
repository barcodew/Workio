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
        Schema::create('admin_activity_logs', function (Blueprint $table) {
            $table->id();

            // siapa yang melakukan aktivitas (user mana)
            $table->foreignId('user_id')
                ->constrained() // ke tabel users
                ->cascadeOnDelete();

            // role pelaku saat itu (opsional: pelamar / perusahaan / admin)
            $table->string('role', 20)->nullable();

            // jenis aksi & deskripsi
            // contoh action: lowongan_dibuat, lamaran_dibuat, lowongan_dipublish, dll.
            $table->string('action', 50);
            $table->text('description');

            // relasi tambahan untuk kebutuhan filter di log:
            // lowongan, perusahaan, pelamar (semua opsional)
            $table->foreignId('lowongan_id')
                ->nullable()
                ->constrained('lowongans')     // SESUAIKAN kalau nama tabelmu beda
                ->nullOnDelete();

            $table->foreignId('perusahaan_id')
                ->nullable()
                ->constrained('perusahaans')   // SESUAIKAN kalau nama tabelmu beda
                ->nullOnDelete();

            $table->foreignId('pelamar_id')
                ->nullable()
                ->constrained('pelamars')      // SESUAIKAN kalau nama tabelmu beda
                ->nullOnDelete();

            $table->timestamps();

            // INDEX – dibuat terpisah supaya nama index tidak kepanjangan
            $table->index('action', 'adm_act_action_idx');
            $table->index('lowongan_id', 'adm_act_low_idx');
            $table->index('perusahaan_id', 'adm_act_per_idx');
            $table->index('pelamar_id', 'adm_act_pel_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_activity_logs');
    }
};
