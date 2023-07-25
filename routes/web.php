<?php

use App\Models\Outlet;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\WebcamController;
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
    return view('auth.login');
});

Route::get('webcam', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');

Route::get('/login',[AuthController::class,'viewLogin'])->name('login');
Route::get('/logout',[AuthController::class,'logout']);
Route::post('/prosesLogin',[AuthController::class,'prosesLogin']);

Route::group(['middleware' => ['auth:user']],function(){
    Route::group(['middleware' => ['cek_login:1,2']], function () {
        //Home Route
        Route::get('/admin/home',[AdminController::class, 'index'])->name('admin.home');

        //Outlet Route
        Route::get('/admin/master-data/outlet',[OutletController::class, 'viewOutlet'])->name('outlet.master');
        Route::get('/admin/master-data/outlet/tambah-data',[OutletController::class,'viewTambahData'])->name('outlet.tambah');
        Route::post('/admin/master-data/outlet/simpan-data',[OutletController::class,'simpanData'])->name('outlet.simpan');
        Route::get('/admin/master-data/outlet/edit-data-{slug}',[OutletController::class,'viewEdit'])->name('outlet.edit');
        Route::post('/admin/master-data/outlet/update-data-{slug}',[OutletController::class,'updateData'])->name('outlet.update');
        Route::post('/admin/master-data/outlet/hapus-data-{slug}',[OutletController::class,'hapusData'])->name('outlet.hapus');
        //Shift Route
        Route::get('/admin/master-data/shift',[ShiftController::class,'viewShift'])->name('shift.master');
        Route::get('/admin/master-data/shift/tambah-data',[ShiftController::class,'viewTambahData'])->name('shift.tambah');
        Route::get('/admin/master-data/shift/edit-data-{id}',[ShiftController::class,'viewEdit'])->name('shift.edit');
        Route::post('/admin/master-data/shift/hapus-data-{id}',[ShiftController::class,'hapusData'])->name('shift.hapus');
        Route::post('/admin/master-data/shift/simpan-data',[ShiftController::class,'simpanData'])->name('shift.simpan');
        Route::post('/admin/master-data/shift/update-data-{slug}',[ShiftController::class,'updateData'])->name('shift.update');
        //Karyawan
        Route::get('/admin/master-data/karyawan',[KaryawanController::class,'viewKaryawan'])->name('karyawan.master');
        Route::get('/admin/master-data/karyawan/tambah-data',[KaryawanController::class,'viewTambahData'])->name('karyawan.tambah');
        Route::get('/admin/master-data/karyawan/edit-data-{id}',[KaryawanController::class,'viewEdit'])->name('karyawan.edit');
        Route::post('/admin/master-data/karyawan/hapus-data-{id}',[KaryawanController::class,'hapusData'])->name('karyawan.hapus');
        Route::post('/admin/master-data/karyawan/simpan-data',[KaryawanController::class,'simpanData'])->name('karyawan.simpan');
        Route::post('/admin/master-data/karyawan/update-data-{slug}',[KaryawanController::class,'updateData'])->name('karyawan.update');
        Route::post('/admin/master-data/karyawan/reset-password-{slug}',[KaryawanController::class,'resetPassword'])->name('karyawan.reset');
        Route::get('/admin/master-data/karyawan/mapping-shift-{slug}',[KaryawanController::class,'viewMappingShift'])->name('karyawan.shift');
        Route::post('/admin/master-data/karyawan/simpan-mapping-absen-{slug}',[KaryawanController::class,'simpanMappingShift'])->name('karyawan.simpan.mapping');

        //Abnsensi
        Route::get('/admin/absensi/data-absensi',[AbsenController::class,'viewDataAbsen'])->name('absensi.home');

    });
});

Route::group(['middleware' => ['auth:user']],function(){
    Route::group(['middleware' => ['cek_login:3']], function () {
        Route::get('/karywan/homesss',[WebcamController::class, 'index']);
        Route::get('/pegawai/home',[PegawaiController::class,'index'])->name('pegawai.home');
        Route::get('/pegawai/absen',[AbsenController::class,'viewAbsen'])->name('absen.pegawai');
        Route::put('/absen/masuk/{id}', [AbsenController::class, 'jamMasuk'])->name('absen.masuk');
        Route::put('/absen/pulang/{id}', [AbsenController::class, 'jamPulang'])->name('absen.pulang');

    });
});
