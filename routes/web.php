<?php

use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dokter\ProfileDoktorController;
use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\Dokter\MemeriksaController;
use App\Http\Controllers\Pasien\JanjiPeriksaController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\pasien\RiwayatPeriksaController;
use App\Models\JanjiPeriksa;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'pasien') {
        $janjiPeriksas = JanjiPeriksa::where('id_pasien', $user->id)
            ->whereDoesntHave('periksa')
            ->get();

        return view('pasien.dashboard', compact('janjiPeriksas'));
        
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:dokter'])->prefix('dokter')->group(function () {
        Route::get('/', function () {
            return view('dokter.dashboard');
        })->name('dokter.dashboard');

        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileDoktorController::class, 'edit'])->name('dokter.profile.edit');
            Route::patch('/', [ProfileDoktorController::class, 'update'])->name('dokter.profile.update');
            Route::delete('/', [ProfileDoktorController::class, 'destroy'])->name('dokter.profile.destroy');
        });

        Route::prefix('obat')->group(function () {
            Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
            Route::get('/create', [ObatController::class, 'create'])->name('dokter.obat.create');
            Route::post('/store', [ObatController::class, 'store'])->name('dokter.obat.store');
            Route::get('/edit/{id}', [ObatController::class, 'edit'])->name('dokter.obat.edit');
            Route::put('/update/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
            Route::delete('destroy/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
            Route::get('/terhapus', [ObatController::class, 'indexDeleted'])->name('dokter.obat.indexDeleted');
            Route::post('/restore/{id}', [ObatController::class, 'restore'])->name('dokter.obat.restore');
        });

        Route::prefix('jadwal-periksa')->group(function () {
            Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal-periksa.index');
            Route::get('/create', [JadwalPeriksaController::class, 'create'])->name('dokter.jadwal-periksa.create');
            Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal-periksa.store');
            Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal-periksa.update');
        });

        Route::prefix('memeriksa')->group(function () {
            Route::get('/', [MemeriksaController::class, 'index'])->name('dokter.memeriksa.index');
            Route::post('/{id}', [MemeriksaController::class, 'store'])->name('dokter.memeriksa.store');
            Route::get('/{id}/periksa', [MemeriksaController::class, 'periksa'])->name('dokter.memeriksa.periksa');
            Route::get('/{id}/edit', [MemeriksaController::class, 'edit'])->name('dokter.memeriksa.edit');
            Route::patch('/{id}', [MemeriksaController::class, 'update'])->name('dokter.memeriksa.update');
        });
    });

    Route::middleware(['role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/', function () {
        $janjiPeriksas = \App\Models\JanjiPeriksa::where('id_pasien', auth()->user()->id)
            ->whereDoesntHave('periksa')
            ->get();

            return view('pasien.dashboard', compact('janjiPeriksas'));
        })->name('pasien.dashboard');

        Route::prefix('janji-periksa')->group(function () {
            Route::get('/', [JanjiPeriksaController::class, 'index'])->name('pasien.janji-periksa.index');
            Route::post('/', [JanjiPeriksaController::class, 'store'])->name('pasien.janji-periksa.store');
        });

        Route::prefix('riwayat-periksa')->group(function () {
            Route::get('/', [RiwayatPeriksaController::class, 'index'])->name('pasien.riwayat-periksa.index');
            Route::get('/detail/{id}', [RiwayatPeriksaController::class, 'detail'])->name('pasien.riwayat-periksa.detail');
            Route::get('/riwayat/{id}', [RiwayatPeriksaController::class, 'riwayat'])->name('pasien.riwayat-periksa.riwayat');
        });
    });
});

require __DIR__ . '/auth.php';
