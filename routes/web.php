<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Petani\DashboardController;
use App\Http\Controllers\Petani\DeteksiController;
use App\Http\Controllers\Petani\RiwayatController;
use App\Http\Controllers\Admin\PenyakitController;

// Rute Utama: Mengarahkan pengguna langsung ke Login atau Dashboard sesuai status login
Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return Auth::user()->isAdmin() 
        ? redirect()->route('admin.penyakit')
        : redirect()->route('dashboard');
})->name('home');

// Rute Tamu (Guest Autentikasi)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Rute Keluar (Logout)
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Rute Modul Petani (Wajib Login & Role Petani)
Route::middleware(['auth', 'role:petani'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/deteksi', [DeteksiController::class, 'create'])->name('deteksi');
    Route::post('/deteksi', [DeteksiController::class, 'store'])->name('deteksi.store');
    Route::get('/hasil/{id?}', [DeteksiController::class, 'show'])->name('hasil');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    Route::get('/riwayat/{id}', [RiwayatController::class, 'show'])->name('detail');
});

// Rute Modul Admin (Wajib Login & Role Admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/penyakit', [PenyakitController::class, 'index'])->name('penyakit');
    Route::post('/penyakit', [PenyakitController::class, 'store'])->name('penyakit.store');
    Route::put('/penyakit/{id}', [PenyakitController::class, 'update'])->name('penyakit.update');
    Route::delete('/penyakit/{id}', [PenyakitController::class, 'destroy'])->name('penyakit.destroy');
});
