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


Route::prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('pemilih', PemilihController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('kandidat', KandidatController::class);
    Route::resource('quick-count', QuickCountController::class);
    Route::resource('waktu-voting', WaktuVotingController::class);
    Route::get('periode', [PeriodeController::class, 'index'])->name('periode.index');
    Route::get('periode/{periode}/apply', [PeriodeController::class, 'apply'])->name('periode.apply');
    Route::get('get-kandidat', [KandidatController::class, 'get_kandidat'])->name('getkandidat');
});

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
