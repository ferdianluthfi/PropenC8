<?php

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

/**
 * routing untuk home dan landing
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
   });
});

/**
 * routing untuk proyek
 */
Route::get('/proyek', 'ProyekController@index');
Route::get('/proyek/tambah', 'ProyekController@create');
Route::post('/proyek/store', 'ProyekController@store');
Route::post('/proyek/update', 'ProyekController@update');
Route::get('/proyek/ubah/{id}', 'ProyekController@edit');
Route::get('/proyek/hapus/{id}', 'ProyekController@destroy');
Route::get('/proyek/lihat/{id}', 'ProyekController@show'); //Fungsi ini adalah untuk lihat detail proyek potensial(belum ikut lelang)
Route::get('/proyek/{id}', 'ProyekController@viewDetailProyek')->name('detail-proyek'); //Fungsi ini untuk lihat proyek yang sudah diapprove oleh direksi(tappi kontrak kerja belum tentnu dikasih liat)
Route::get('/proyek/{id}/kontrak', 'KontrakController@viewKontrak')->name('detail-kontrak');
Route::post('proyek/{id}/kontrak/approve', 'KontrakController@approveKontrak')->name('approve-kontrak');
Route::post('proyek/{id}/kontrak/disapprove', 'KontrakController@disapproveKontrak')->name('disapprove-kontrak');

/**
 * routing untuk kemajuan proyek
 */
Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');


/**
 * routing untuk kelola lelang
 */
Route::get('/kelolaLelang/{proyek_id}', 'KelengkapanLelangController@kelolaBerkas');
Route::get('/getBerkas/{id}', 'KelengkapanLelangController@getBerkas');
Route::get('file/upload/{proyek_id}', 'KelengkapanLelangController@form');
Route::post('file/upload', 'KelengkapanLelangController@uploadKelengkapanLelang')->name('file.upload');
Route::get('file/{file}/download', 'KelengkapanLelangController@downloadKelengkapanLelang')->name('file.download');
Route::get('file/{file}/response', 'KelengkapanLelangController@responseKelengkapanLelang')->name('file.response');
Route::get('file/{file}/delete', 'KelengkapanLelangController@deleteKelengkapanLelang');
Route::get('generate-pdf/{proyek_id}','KelengkapanLelangController@generatePDF');
Route::get('generate-pdf2/{proyek_id}','KelengkapanLelangController@generatePDF2');
