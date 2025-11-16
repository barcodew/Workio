<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder {
    public function run(): void {
        $admin = User::firstOrCreate(
            [ 'email'=>'admin@mail.com' ],
            [ 'name'=>'Administrator', 'password'=>bcrypt( '12345' ), 'role'=>'admin' ]
        );

        $peruUser = User::factory()->create( [ 'role'=>'perusahaan', 'email'=>'hr@acme.local', 'name'=>'ACME' ] );
        $peru = Perusahaan::create( [ 'user_id'=>$peruUser->id, 'nama_perusahaan'=>'ACME', 'bidang_usaha'=>'Teknologi' ] );

        Lowongan::create( [
            'perusahaan_id'=>$peru->id,
            'judul'=>'Backend Laravel Developer',
            'deskripsi'=>'Membangun API, Eloquent, Queue.',
            'lokasi'=>'Majene',
            'tipe_pekerjaan'=>'Full-time',
            'status'=>'published',
            'deadline'=>now()->addMonth(),
        ] );
    }
}
