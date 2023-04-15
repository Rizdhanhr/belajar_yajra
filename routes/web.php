<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KaryawanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Pegawai
Route::get('getpegawai',[PegawaiController::class,'getpegawai'])->name('getpegawai');
Route::resource('pegawai', PegawaiController::class);

//Karyawan
Route::get('getkaryawan',[KaryawanController::class,'getkaryawan'])->name('getkaryawan');
Route::resource('karyawan', KaryawanController::class);

