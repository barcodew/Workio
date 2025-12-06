<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,JobController,ApplicationController,AdminController};
use App\Http\Controllers\PerusahaanDashboardController;
use App\Http\Controllers\PelamarDashboardController;
use App\Http\Controllers\AdminLowonganController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PelamarProfileController;
use App\Http\Controllers\CompanyLowonganController;
use App\Http\Controllers\CompanyLamaranController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfilePerusahaanController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\PelamarPerusahaanController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// routes/web.php
Route::get('/', [\App\Http\Controllers\LandingController::class, 'index'])->name('home');


Route::get('/dashboard', DashboardRedirectController::class)
    ->middleware(['auth'])     // wajib login
    ->name('dashboard');



Route::get('/profile/perusahaan/{perusahaan}', [PelamarPerusahaanController::class, 'show'])
        ->name('pelamar.perusahaan.show');
// Auth
Route::middleware('guest')->group(function(){
    Route::get('/login',    [AuthController::class,'showLogin'])->name('login');
    // Route::get('/register', [AuthController::class,'showRegister'])->name('register');
    // Route::post('/register',[AuthController::class,'register'])->name('register.post');
    Route::post('/login',   [AuthController::class,'login'])->name('login.post');

        // Forgot password (request link)
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
        ->name('password.request');

    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    // Reset password (form + submit)
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('password.update');

    // melihat profile perusahaan

});
Route::post('/logout', [AuthController::class,'logout'])->middleware('auth')->name('logout');

Route::get('/lowongan', [JobController::class,'index'])->name('jobs.index');

Route::middleware(['auth','role:pelamar','verified'])->group(function(){
    Route::view('/pelamar', 'pelamar.dashboard')->name('pelamar.dashboard');
    Route::post('/lowongan/{lowongan}/lamar', [ApplicationController::class,'store'])->name('lamaran.store');
});

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/dashboard', DashboardRedirectController::class)
    ->name('dashboard');
    Route::prefix('perusahaan')->group(function(){
        Route::resource('lowongan', \App\Http\Controllers\Perusahaan\LowonganController::class);
    });
});


// Halaman notice "cek email"
Route::middleware('auth')->get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

// Link verifikasi (dari email)
Route::middleware(['auth','signed'])->get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // tandai verified

    $u = $request->user();
    return redirect()->route(
        $u->isAdmin() ? 'admin.dashboard' : ($u->isPerusahaan() ? 'perusahaan.dashboard' : 'pelamar.dashboard')
    )->with('ok', 'Email terverifikasi.');
})->name('verification.verify');

// Resend verifikasi
Route::middleware(['auth','throttle:6,1'])->post('/email/verification-notification', function (Request $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return back()->with('ok','Email sudah terverifikasi.');
    }
    $request->user()->sendEmailVerificationNotification();
    return back()->with('ok','Email verifikasi telah dikirim.');
})->name('verification.send');


// Admin
Route::middleware(['auth','role:admin','verified'])->group(function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class,'dashboard'])->name('admin.dashboard');

    // Lowongan
    Route::get('/admin/lowongan', [AdminLowonganController::class,'index'])->name('admin.lowongan.index');
    Route::patch('/admin/lowongan/{lowongan}/status', [AdminLowonganController::class,'updateStatus'])->name('admin.lowongan.status');
    Route::delete('/admin/lowongan/{lowongan}', [AdminLowonganController::class,'destroy'])->name('admin.lowongan.destroy');

    // Pengguna
    Route::get('/admin/pengguna', [AdminUserController::class,'index'])->name('admin.pengguna.index');
    Route::patch('/admin/pengguna/{user}/role', [AdminUserController::class,'updateRole'])->name('admin.pengguna.role');
    Route::patch('/admin/pengguna/{user}/reset-password', [AdminUserController::class,'resetPassword'])->name('admin.pengguna.reset');
    Route::delete('/admin/pengguna/{user}', [AdminUserController::class,'destroy'])->name('admin.pengguna.destroy');

 
        Route::get('/aktivitas', [AdminController::class, 'logsView'])
             ->name('admin.aktivitas.index');
});




Route::middleware(['auth','role:pelamar','verified'])->group(function () {
    // Dasbor pelamar (sudah ada)
    Route::get('/pelamar', [\App\Http\Controllers\PelamarDashboardController::class,'index'])->name('pelamar.dashboard');

    // PROFIL PELAMAR
    Route::get('/pelamar/profil', [PelamarProfileController::class,'edit'])->name('pelamar.profil.edit');
    Route::put('/pelamar/profil', [PelamarProfileController::class,'update'])->name('pelamar.profil.update');

    // LAMAR PEKERJAAN (dari detail lowongan)
    Route::post('/lowongan/{lowongan}/lamar', [ApplicationController::class,'store'])->name('lamaran.store');

      Route::get('/pelamar/lamaran', [ApplicationController::class, 'indexMyApplications'])
            ->name('pelamar.lamaran.index');


});

// Halaman detail lowongan (publik)
Route::get('/lowongan/{lowongan}', [JobController::class,'show'])->name('jobs.show');


Route::middleware(['auth','role:perusahaan','verified'])->group(function () {
    // Dashboard perusahaan
    Route::get('/perusahaan', [\App\Http\Controllers\PerusahaanDashboardController::class,'index'])
        ->name('perusahaan.dashboard');

    // Lowongan saya
    Route::get('/perusahaan/lowongan',                     [CompanyLowonganController::class,'index'])->name('perusahaan.lowongan.index');
    Route::get('/perusahaan/lowongan/create',              [CompanyLowonganController::class,'create'])->name('perusahaan.lowongan.create');
    Route::post('/perusahaan/lowongan',                    [CompanyLowonganController::class,'store'])->name('perusahaan.lowongan.store');
    Route::get('/perusahaan/lowongan/{lowongan}/edit',     [CompanyLowonganController::class,'edit'])->name('perusahaan.lowongan.edit');
    Route::put('/perusahaan/lowongan/{lowongan}',          [CompanyLowonganController::class,'update'])->name('perusahaan.lowongan.update');
    Route::patch('/perusahaan/lowongan/{lowongan}/toggle', [CompanyLowonganController::class,'toggleStatus'])->name('perusahaan.lowongan.toggle');
    Route::delete('/perusahaan/lowongan/{lowongan}',       [CompanyLowonganController::class,'destroy'])->name('perusahaan.lowongan.destroy');

    // Kelola pelamar per lowongan
    Route::get('/perusahaan/lowongan/{lowongan}/pelamar',  [CompanyLamaranController::class,'index'])->name('perusahaan.lamaran.index');
    Route::patch('/perusahaan/lamaran/{lamaran}/status',   [CompanyLamaranController::class,'updateStatus'])->name('perusahaan.lamaran.status');

    Route::get('/perusahaan/profil',  [\App\Http\Controllers\ProfilePerusahaanController::class,'edit'])->name('perusahaan.profil.edit');
    Route::put('/perusahaan/profil',  [\App\Http\Controllers\ProfilePerusahaanController::class,'update'])->name('perusahaan.profil.update');

    // lihat detail profile pelamar
    Route::get('/candidates/{pelamar}', [PelamarProfileController::class, 'show'])
        ->name('candidates.show');

});




Route::get('/register',                 [AuthController::class,'choice'])->name('register');                // halaman pilih role
Route::get('/register/pelamar',         [AuthController::class,'showPelamar'])->name('register.pelamar');
Route::get('/register/perusahaan',      [AuthController::class,'showPerusahaan'])->name('register.perusahaan');
Route::post('/register',                [AuthController::class,'register'])->name('register.post');

