<?php

use App\Proyek;
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


/**
 * routing untuk home dan landing
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/error', function(){
    return view('error-message');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
});



Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');
Route::get('/proyek/setujuiProyek/{id}', 'ProyekController@approveProjectDetail');
Route::post('/proyek/setujuiProyek/setuju/{id}', 'ProyekController@approveProject');
Route::post('/proyek/setujuiProyek/tolak/{id}', 'ProyekController@rejectProject');
Route::get('/proyek/', 'ProyekController@viewAllProject');
Route::get('/proyek/detailProyek/{id}', 'ProyekController@projectDetailWithoutApprove');
Route::get('/proyek/{id}/lihatKontrak/', 'KontrakController@viewKontrakz');



Route::get('/proyek/{id}/kontrak', 'KontrakController@viewKontrak')->name('detail-kontrak');
Route::post('proyek/{id}/kontrak/approve', 'KontrakController@approveKontrak')->name('approve-kontrak');
Route::post('proyek/{id}/kontrak/disapprove', 'KontrakController@disapproveKontrak')->name('disapprove-kontrak');
Route::get('/proyek/{id}/lihatKontrak/', 'KontrakController@overviewKontrak')->name('view-kontrak');
Route::get('/proyek/{id}/kontrak/buat', 'KontrakController@infoUmumTambahInfo')->name('buat-kontrak');
Route::get('/proyek/{id}/kontrak/berkasSurat', 'KontrakController@berkasSurat')->name('berkas-surat');
Route::post('/proyek/{id}/kontrak/createKontrak', 'KontrakController@createKontrak');
Route::post('/proyek/{id}/kontrak/generateSurat', 'KontrakController@generateSurat');
Route::get('/proyek/{id}/lihatKontrak/', 'KontrakController@overviewKontrak')->name('view-kontrak');
Route::get('/kontrak/{kontrakId}/download', 'KontrakController@downloadSuratKontrak')->name('download-surat-kontrak');
Route::get('/kontrak/{kontrakId}/delete', 'KontrakController@deleteSuratKontrak')->name('delete-surat-kontrak');

// Route::get('/kemajuanProyek', 'Kema`juanProyekController@viewKemajuan');

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

/**
 * routing untuk proyek
 */
Route::get('/proyek', 'ProyekController@index');
Route::get('/proyek/tambah', 'ProyekController@create');
Route::post('/proyek/store', 'ProyekController@store');
Route::post('/proyek/update', 'ProyekController@update');
Route::get('/proyek/ubah/{id}', 'ProyekController@edit');
Route::get('/proyek/hapus/{id}', 'ProyekController@destroy');
Route::get('/proyek/lihat/{id}', 'ProyekController@show'); //Fungsi ini adalah untuk lihat detail proyek potensial(belum ikut lelang) momo
Route::get('/proyek/{id}', 'ProyekController@viewDetailProyek')->name('detail-proyek'); //Fungsi ini untuk lihat proyek yang sudah diapprove oleh direksi(tappi kontrak kerja belum tentnu dikasih liat) kirana
Route::get('/proyek/setujuiProyek/{id}', 'ProyekController@approveProjectDetail');
Route::post('/proyek/setujuiProyek/setuju/{id}', 'ProyekController@approveProject');
Route::post('/proyek/setujuiProyek/tolak/{id}', 'ProyekController@rejectProject');
Route::get('/proyek/detailProyek/{id}', 'ProyekController@projectDetailWithoutApprove');
Route::get('/proyek/{id}/lihatKontrak/', 'KontrakController@overviewKontrak')->name('view-kontrak');
Route::get('/proyek/kalah/{id}', 'ProyekController@kalah');
Route::get('/proyek/menang/{id}', 'ProyekController@menang');

/**-
 * routing untuk kemajuan proyek
 */
Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');
Route::get('/assignedproyek', 'KemajuanProyekController@viewProyek');
Route::get('/proyek/detail/{id}', 'KemajuanProyekController@detailProyek');
Route::get('/informasi/{id}', 'KemajuanProyekController@viewInfo');
Route::get('/informasi/detail/{id}', 'KemajuanProyekController@detailInfo');
Route::get('/informasi/detail/tambah/{id}', 'KemajuanProyekController@tambahFoto');
Route::post('/foto/submit/{id}', 'KemajuanProyekController@simpanFoto');
Route::get('/info/tambah/{id}', 'KemajuanProyekController@tambahInformasi');
Route::post('/info/submit/{id}', 'KemajuanProyekController@simpanInformasi');
Route::get('/info/edit/{id}', 'KemajuanProyekController@editInformasi');
Route::post('/info/update/{id}', 'KemajuanProyekController@updateInformasi');
Route::get('/info/delete/{id}', 'KemajuanProyekController@hapusInformasi');


/**
 * Users
 */
Route::get('/homeAccountManager', 'HomeController@home')->name('homeAccountManager');
Route::get('/user/lihat/{id}', 'HomeController@edit');
Route::post('/user/update', 'HomeController@update');
Route::get('/user/delete/{id}', 'HomeController@delete');
Route::get('/user/unlock/{id}', 'HomeController@unlock');
Route::post('/register', 'Auth\RegisterController@register')->name('register');

/**
 * routing untuk LAPJUSIK
 */
Route::get('/pelaksanaan/{id}', 'PelaksanaanController@viewPelaksanaan');
Route::get('/pelaksanaan/detail/{id}', 'PelaksanaanController@detailPelaksanaan');
Route::get('/pelaksanaan/tambah/{id}', 'PelaksanaanController@tambahPelaksanaan');
Route::get('/pelaksanaan/delete/{id}', 'PelaksanaanController@deletePelaksanaan');
Route::get('/pelaksanaan/download/{id}', 'PelaksanaanController@downloadPelaksanaan');
Route::post('/lapjusik/setujuiLapjusik/setuju/{id}', 'PelaksanaanController@approveLAPJUSIK');
Route::post('/lapjusik/setujuiLapjusik/tolak/{id}', 'PelaksanaanController@rejectLAPJUSIK');


 /*
 * routing untuk PM2an
 */
Route::get('/pm/kelola/{proyek_id}', 'PenggunaController@getAvailablePm');//masuk ke page edit pm
Route::post('/pm/update', 'PenggunaController@managePm');//update pm




/**
 * routing untuk REVIEW
 */
Route::post('/pelaksanaan/detail/{id}/review/add', 'ReviewController@add')->name("add-review");
Route::post('/pelaksanaan/detail/{id}/review/edit', 'ReviewController@edit')->name("edit-review");
/**
 * Errors
 */
Route::any('{catchall}', function() {
    return view('error-message');
  })->where('catchall', '.*');
  
