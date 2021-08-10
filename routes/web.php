<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PemilihController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\KandidatController;
use App\Http\Controllers\Admin\WaktuVotingController;
use App\Http\Controllers\Admin\QuickCountController;
use App\Http\Controllers\VotingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::resource('pemilih', PemilihController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('kandidat', KandidatController::class);
        Route::get('quick-count', [QuickCountController::class, 'index'])->name('quick-count.index');
        Route::get('quick-count/get-jumlah-suara-kandidat-ketua', [QuickCountController::class, 'getJumlahSuaraKandidatKetua'])->name('quick-count.get-jumlah-suara-kandidat-ketua');
        Route::get('quick-count/get-jumlah-suara-kandidat-keputrian', [QuickCountController::class, 'getJumlahSuaraKandidatKeputrian'])->name('quick-count.get-jumlah-suara-kandidat-keputrian');
        Route::get('quick-count/get-presentase-kandidat-ketua', [QuickCountController::class, 'getPresentaseKandidatKetua'])->name('quick-count.get-presentase-kandidat-ketua');
        Route::get('quick-count/get-presentase-kandidat-keputrian', [QuickCountController::class, 'getPresentaseKandidatKeputrian'])->name('quick-count.get-presentase-kandidat-keputrian');
        Route::resource('waktu-voting', WaktuVotingController::class);
        Route::get('periode', [PeriodeController::class, 'index'])->name('periode.index');
        Route::get('periode/{periode}/apply', [PeriodeController::class, 'apply'])->name('periode.apply');
        Route::get('get-kandidat/', [KandidatController::class, 'getKandidat'])->name('getkandidat');
        Route::get('users/{userId}/edit', [AuthController::class, 'edit'])->name('users.edit');
        Route::patch('users/{userId}/update', [AuthController::class, 'update'])->name('users.update');
    });
});

Route::get('/', [VotingController::class, 'home'])->name('home.voting');

Route::prefix('siswa')->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('voting/login', [VotingController::class, 'index'])->name('mulaivoting');
    Route::get('voting', [VotingController::class, 'mulai_voting']);
    Route::post('voting/save/{param}', [VotingController::class, 'simpan_suara'])->name('simpan_suara');
    Route::post('voting/cek-token', [VotingController::class, 'cektoken'])->name('cektoken');
    Route::get('voting/logout', [VotingController::class, 'logout_siswa'])->name('logout_siswa');
    Route::get('/voting/selesai', [VotingController::class, 'selesai_voting'])->name('sudah_voting');
});

Route::get('admin/login', [AuthController::class, 'login'])->name('login');
Route::post('admin/login/process', [AuthController::class, 'process'])->name('login.process');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('logout');
