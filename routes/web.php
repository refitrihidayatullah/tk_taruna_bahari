<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileSekolahController;
use App\Http\Controllers\SambutanSekolah;
use App\Http\Controllers\ProfileVisiMisi;
use App\Http\Controllers\ProgramSekolah;
use App\Http\Controllers\InformasiPendaftaran;
use App\Http\Controllers\SosmedController;

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
    return view('backend.admin');
});
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/home', function () {
    return view('frontend.home');
});
Route::get('/profil', function () {
    return view('frontend.profile');
});

Route::get('/profile-sekolah', [ProfileSekolahController::class, 'index'])->name('profile-sekolah');
Route::post('/update-profile-sekolah/{id}', [ProfileSekolahController::class, 'update']);

Route::get('/profile-sambutan', [SambutanSekolah::class, 'index']);
Route::post('/update-sambutan/{id}', [SambutanSekolah::class, 'update']);

Route::get('/profile-visi-misi', [ProfileVisiMisi::class, 'index']);
Route::post('/profile-visi', [ProfileVisiMisi::class, 'storeVisi']);
Route::post('/profile-misi', [ProfileVisiMisi::class, 'storeMisi']);

Route::put('profile-visi/{id}', [ProfileVisiMisi::class, 'updateVisi']);
Route::put('profile-misi/{id}', [ProfileVisiMisi::class, 'updateMisi']);


Route::get('profile-visi/{id}', [ProfileVisiMisi::class, 'deleteVisi']);
Route::get('profile-misi/{id}', [ProfileVisiMisi::class, 'deleteMisi']);

Route::get('profile-program', [ProgramSekolah::class, 'index']);
Route::post('store-program', [ProgramSekolah::class, 'store']);
Route::put('update-program/{id}', [ProgramSekolah::class, 'update']);
Route::get('delete-program/{id}', [ProgramSekolah::class, 'destroy']);

Route::get('informasi-pendaftaran', [InformasiPendaftaran::class, 'index']);
Route::post('store-informasi', [InformasiPendaftaran::class, 'store']);
Route::put('update-informasi/{id}', [InformasiPendaftaran::class, 'update']);
Route::get('delete-informasi/{id}', [InformasiPendaftaran::class, 'destroy']);

Route::get('sosmed-galeri', [SosmedController::class, 'index']);
Route::post('store-sosmed', [SosmedController::class, 'store']);
Route::post('store-galeri', [SosmedController::class, 'storeGaleri']);
Route::put('update-sosmed/{id}', [SosmedController::class, 'update']);
Route::put('update-galeri/{id}', [SosmedController::class, 'updateGaleri']);
Route::get('delete-sosmed/{id}', [SosmedController::class, 'destroy']);
Route::get('delete-galeri/{id}', [SosmedController::class, 'destroyGaleri']);
