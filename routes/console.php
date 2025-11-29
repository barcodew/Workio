<?php

use App\Models\Lowongan;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;



Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Jadwal: tutup lowongan yang lewat deadline
Schedule::call(function () {
    Lowongan::where('status', 'published')
        ->whereDate('deadline', '<', now()->toDateString())
        ->update(['status' => 'closed']);
})->dailyAt('00:05');
// Untuk testing di local, sementara bisa pakai:
// })->everyMinute();
