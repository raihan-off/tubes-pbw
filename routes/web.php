<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\PekerjaanController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// route::get('/user', function () {
//     return view('user.index');
// })->middleware(['auth', 'verified'])->name('user');

Route::get('/user', [UserController::class, 'tampilUser'])->name('user');

Route::get('/informasi', [InformasiController::class, 'tampilInformasi'])->name('informasi');
Route::post('/tambahInformasi', [InformasiController::class, 'tambahInformasi'])->name('informasi.add');
Route::get('/editInformasi/{id?}', [InformasiController::class, 'editInformasi'])->name('informasi.edit');
Route::post('/ubahInformasi/{id?}', [InformasiController::class, 'ubahInformasi'])->name('informasi.ubah');
Route::get('/hapusInformasi/{id}', [InformasiController::class, 'hapusInformasi'])->name('informasi.delete');

Route::get('/pekerjaan', [PekerjaanController::class, 'tampilPekerjaan'])->name('pekerjaan');
Route::post('/tambahPekerjaan', [PekerjaanController::class, 'tambahPekerjaan'])->name('pekerjaan.add');
Route::get('/editPekerjaan/{id?}', [PekerjaanController::class, 'editPekerjaan'])->name('pekerjaan.edit');
Route::post('/ubahPekerjaan/{id?}', [PekerjaanController::class, 'ubahPekerjaan'])->name('pekerjaan.ubah');
Route::get('/hapusPekerjaan/{id}', [PekerjaanController::class, 'hapusPekerjaan'])->name('pekerjaan.delete');

Route::get('/buku', [BukuController::class, 'tampilBuku'])->name('buku');
Route::post('/tambahBuku', [BukuController::class, 'tambahBuku'])->name('buku.add');
Route::get('/editBuku/{id?}', [BukuController::class, 'editBuku'])->name('buku.edit');
Route::post('/ubahBuku/{id?}', [BukuController::class, 'ubahBuku'])->name('buku.ubah');
Route::get('/hapusBuku/{id}', [BukuController::class, 'hapusBuku'])->name('buku.delete');

require __DIR__ . '/auth.php';
