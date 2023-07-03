<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileSekolahController;
use App\Http\Controllers\SambutanSekolah;

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
