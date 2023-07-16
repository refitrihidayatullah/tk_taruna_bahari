<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileSekolahController;
use App\Http\Controllers\SambutanSekolah;
use App\Http\Controllers\ProfileVisiMisi;
use App\Http\Controllers\ProgramSekolah;
use App\Http\Controllers\InformasiPendaftaran;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardAdmin;

use App\Http\Controllers\FrontendHomeController;
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
// frontend first
Route::get('/', [FrontendHomeController::class, 'index']);
Route::get('/profile', [FrontendHomeController::class, 'indexProfile']);
Route::get('/galeri', [FrontendHomeController::class, 'indexGaleri']);
Route::get('/dataguru', [FrontendHomeController::class, 'indexDataGuru']);
// frontend end

// backend first
Route::get('/dashboard', [DashboardAdmin::class, 'dashboardAdmin'])->middleware('auth');
Route::get('/profile-sekolah', [ProfileSekolahController::class, 'index'])->name('profile-sekolah')->middleware('auth');
Route::post('/update-profile-sekolah/{id}', [ProfileSekolahController::class, 'update'])->middleware('auth');

Route::get('/profile-sambutan', [SambutanSekolah::class, 'index'])->middleware('auth');
Route::post('/update-sambutan/{id}', [SambutanSekolah::class, 'update'])->middleware('auth');

Route::get('/profile-visi-misi', [ProfileVisiMisi::class, 'index'])->middleware('auth');
Route::post('/profile-visi', [ProfileVisiMisi::class, 'storeVisi'])->middleware('auth');
Route::post('/profile-misi', [ProfileVisiMisi::class, 'storeMisi'])->middleware('auth');

Route::put('profile-visi/{id}', [ProfileVisiMisi::class, 'updateVisi'])->middleware('auth');
Route::put('profile-misi/{id}', [ProfileVisiMisi::class, 'updateMisi'])->middleware('auth');


Route::get('profile-visi/{id}', [ProfileVisiMisi::class, 'deleteVisi'])->middleware('auth', 'superadmin-or-kepsek');
Route::get('profile-misi/{id}', [ProfileVisiMisi::class, 'deleteMisi'])->middleware('auth', 'superadmin-or-kepsek');

Route::get('profile-program', [ProgramSekolah::class, 'index'])->middleware('auth');
Route::post('store-program', [ProgramSekolah::class, 'store'])->middleware('auth');
Route::put('update-program/{id}', [ProgramSekolah::class, 'update'])->middleware('auth');
Route::get('delete-program/{id}', [ProgramSekolah::class, 'destroy'])->middleware('auth', 'superadmin-or-kepsek');

Route::get('informasi-pendaftaran', [InformasiPendaftaran::class, 'index'])->middleware('auth');
Route::post('store-informasi', [InformasiPendaftaran::class, 'store'])->middleware('auth');
Route::put('update-informasi/{id}', [InformasiPendaftaran::class, 'update'])->middleware('auth');
Route::get('delete-informasi/{id}', [InformasiPendaftaran::class, 'destroy'])->middleware('auth', 'superadmin-or-kepsek');

Route::get('sosmed-galeri', [SosmedController::class, 'index'])->middleware('auth');
Route::post('store-sosmed', [SosmedController::class, 'store'])->middleware('auth');
Route::post('store-galeri', [SosmedController::class, 'storeGaleri'])->middleware('auth');
Route::put('update-sosmed/{id}', [SosmedController::class, 'update'])->middleware('auth');
Route::put('update-galeri/{id}', [SosmedController::class, 'updateGaleri'])->middleware('auth');
Route::get('delete-sosmed/{id}', [SosmedController::class, 'destroy'])->middleware('auth', 'superadmin-or-kepsek');
Route::get('delete-galeri/{id}', [SosmedController::class, 'destroyGaleri'])->middleware('auth', 'superadmin-or-kepsek');

Route::get('user-sekolah', [UserController::class, 'index'])->middleware('auth');
Route::post('store-user', [UserController::class, 'store'])->middleware('auth', 'superadmin-or-kepsek');
Route::put('update-user/{id}', [UserController::class, 'update'])->middleware('auth');
Route::get('delete-user/{id}', [UserController::class, 'destroy'])->middleware('auth', 'superadmin-or-kepsek');
Route::get('login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('login-user', [UserController::class, 'loginAction'])->middleware('guest');
Route::get('logout-user', [UserController::class, 'logoutAction'])->middleware('auth');
Route::put('changePassword', [UserController::class, 'changePassword'])->middleware('auth');

// backend end