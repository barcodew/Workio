<?php


namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // 4 lowongan terbaru yang belum lewat deadline + jumlah pelamar
        $latestJobs = Lowongan::with('perusahaan')
            ->withCount('lamarans')      // pakai relasi lamarans() di model kamu
            ->notExpired()               // scope dari model yang sudah kamu buat
            ->orderByDesc('created_at')
            ->take(4)
            ->get();


        return view('welcome', [
            'latestJobs'    => $latestJobs
        ]);
    }
}
