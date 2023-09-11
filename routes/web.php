<?php

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



Auth::routes();


Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
    // return config('app.ref_db');
});

Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');


Route::middleware(['auth'])->group(function () {
    //
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('role', 'RoleController');
    Route::get('role/{role}/hapus', 'RoleController@destroy')->name('role.hapus');
    Route::resource('permission', 'PermissionController');
    Route::get('permission/{role}/hapus', 'PermissionController@destroy')->name('permission.hapus');
    Route::resource('account', 'PenggunaController')->only(['index', 'edit', 'update']);

    Route::resource('pegawai', 'PegawaiController')->except(['destroy']);
    Route::get('pegawai/{role}/hapus', 'PegawaiController@destroy')->name('pegawai.hapus');
    Route::get('apbdes', 'AnggaranController@index')->name('apbdes');
    Route::get('bop', 'AnggaranController@ProyeksiBop')->name('bop');
    Route::get('bop/pdf', 'AnggaranController@ProyeksiBopPdf')->name('bop.pdf');
    Route::get('belanjafisik', 'AnggaranController@belanjaFisik')->name('belanjafisik');
    Route::get('belanjafisik/pdf', 'AnggaranController@belanjaFisikpdf')->name('belanjafisik.pdf');
    Route::get('panjardd', 'AnggaranController@panjarFisikDanaDesa')->name('panjardd');
    Route::get('panjardd/pdf', 'AnggaranController@panjarFisikDanaDesaPdf')->name('panjardd.pdf');
    Route::get('pajak', 'AnggaranController@SektorPajak')->name('pajak');
    Route::get('pajak/pdf', 'AnggaranController@SektorPajakPdf')->name('pajak.pdf');

    Route::resource('pembinaan', 'PembinaanController')->except(['destroy']);
    Route::get('pembinaan/{pembinaan}/hapus', 'PembinaanController@destroy')->name('pembinaan.hapus');
    Route::post('pembinaan/upload', 'PembinaanController@uploadData')->name('pembinaan.upload');


    Route::resource('pembinaanevaluasi', 'pembinaanevaluasiController')->except(['destroy']);
    Route::get('pembinaanevaluasi/{pembinaanevaluasi}/hapus', 'pembinaanevaluasiController@destroy')->name('pembinaanevaluasi.hapus');
    Route::post('pembinaanevaluasi/upload', 'pembinaanevaluasiController@uploadData')->name('pembinaanevaluasi.upload');

    Route::resource('pengawasan', 'PengawasanController')->except(['destroy']);
    Route::get('pengawasan/{pengawasan}/hapus', 'PengawasanController@destroy')->name('pengawasan.hapus');
    Route::post('pengawasan/upload', 'PengawasanController@uploadData')->name('pengawasan.upload');


    Route::resource('pengaduan', 'PengaduanController')->except(['destroy']);
    Route::get('pengaduan/{pengaduan}/hapus', 'PengaduanController@destroy')->name('pengaduan.hapus');
    Route::post('pengaduan/upload', 'PengaduanController@uploadData')->name('pengaduan.upload');

    Route::resource('perintah', 'PerintahPengawasanController')->except(['destroy']);
    Route::get('perintah/{perintah}/hapus', 'PerintahPengawasanController@destroy')->name('perintah.hapus');
    Route::get('perintah/selesai/{perintah}', 'PerintahPengawasanController@selesaiCtrl')->name('perintah.selesai');
    Route::get('resiko', 'FaktorResikoController@index')->name('resiko');
    Route::get('resiko/refresh', 'FaktorResikoController@refreshData')->name('resiko.refresh');
    Route::get('resiko/pdf', 'FaktorResikoController@indexPdf')->name('resiko.pdf');

    Route::get('kecamatan', 'WilayahController@kecamatan')->name('kecamatan');
    Route::get('desa', 'WilayahController@desa')->name('desa');

    Route::get('keuangan', 'KeuanganController@index')->name('keuangan');
});
