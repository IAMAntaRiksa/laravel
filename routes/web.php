<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RekapContoller;
use App\Http\Controllers\TamuController;
use Illuminate\Support\Facades\Route;

/*
|-----------------------------------------------        ---------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [LoginController::class, 'gate'])->name('login.gate');
Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::Post('login', [LoginController::class, 'login'])->name('login.login');

Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
        Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
        Route::post('/pengguna/create', [PenggunaController::class, 'store'])->name('pengguna.store');
        Route::delete('pengguna/{id}', [PenggunaController::class, 'delete'])->name('pengguna.delete');
        Route::get('pengguna/{id}', [PenggunaController::class, 'edit'])->name('pengguna.edit');
        Route::patch('pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
        /// Tamu
        Route::get('/tamu/create', [TamuController::class, 'create'])->name('tamu.create');
        Route::post('/tamu/create', [TamuController::class, 'store'])->name('tamu.store');
        Route::get('/tamu', [TamuController::class, 'index'])->name('tamu.index');
        Route::post('updateStatus/{id}', [TamuController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/tamu/{id}/edit', [TamuController::class, 'edit'])->name('tamu.edit');
        Route::put('/tamu/{id}', [TamuController::class, 'update'])->name('tamu.update');
        Route::delete('/tamu/{id}', [TamuController::class, 'destroy'])->name('tamu.destroy');
        Route::get('logout', [PenggunaController::class, 'logout'])->name('logout.index');

        // Rekap Tamu 
        Route::get('/rekap-tamu', [RekapContoller::class, 'index'])->name('rekap.index');
        Route::get('/getData', [RekapContoller::class, 'getData'])->name('getData');

        /// Rekap PDF
        Route::get('/export-pdf', [PDFController::class, 'exportPDF'])->name('exportPDF');
        Route::get('/export', [ExcelController::class, 'export'])->name('export');

        Route::get('/export', [ExportController::class, 'exportToExcel'])->name('export');


});
