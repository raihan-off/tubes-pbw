<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\PekerjaanController;
use App\Models\Pekerjaan;
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
Route::post('/editInformasi', [InformasiController::class, 'editInformasi'])->name('informasi.edit');
Route::delete('/deleteInformasi', [InformasiController::class, 'deleteInformasi'])->name('informasi.delete');

Route::get('/pekerjaan', [PekerjaanController::class, 'tampilPekerjaan'])->name('pekerjaan');
Route::post('/tambahPekerjaan', [PekerjaanController::class, 'tambahPekerjaan'])->name('pekerjaan.add');
Route::post('/editPekerjaan', [PekerjaanController::class, 'editPekerjaan'])->name('pekerjaan.edit');
//Route::delete('/pekerjaan', [PekerjaanController::class, 'deleteInformasi'])->name('pekerjaan.delete');

require __DIR__ . '/auth.php';
