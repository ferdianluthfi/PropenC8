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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
   });
});



Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');
Route::get('/proyek/setujuiProyek/{id}', 'ProyekController@approveProjectDetail');
Route::post('/proyek/setujuiProyek/setuju/{id}', 'ProyekController@approveProject');
Route::post('/proyek/setujuiProyek/tolak/{id}', 'ProyekController@rejectProject');
Route::get('/proyek/', 'ProyekController@viewAllProject');
Route::get('/proyek/detailProyek/{id}', 'ProyekController@projectDetailWithoutApprove');
Route::get('/proyek/{id}/lihatKontrak/', 'KontrakController@viewKontrakz');
// Route::get('/proyek', 'ProyekController@viewAll')->name('view-all-proyek');
// Route::get('/proyek/{id}', 'ProyekController@viewDetailProyek')->name('detail-proyek');
// Route::get('/proyek/{id}/kontrak', 'KontrakController@viewKontrak')->name('detail-kontrak');


// Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');
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
