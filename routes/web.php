<?php

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
Route::get('/pekerjaan', [PekerjaanController::class, 'tampilPekerjaan'])->name('pekerjaan');

require __DIR__ . '/auth.php';
