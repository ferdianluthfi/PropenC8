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

Route::get('/home', function () { 
    return view('landing');
});

Route::get('/luthfi', function () {
    $proyek = App\Proyek::find(1);
//    $kelengkapanLelang = App\KelengkapanLelang::table('proyeks')
//        ->join('proyeks','proyeks.id','=','kelengkapan_lelangs','kelengkapan_lelangs.proyek_id')->where('kelengkapan_lelangs.proyek_id',1)
//        ->get();
//    //$proyek = $kelengkapanLelang->proyek()->where('id', 1)->get();
//    dd($kelengkapanLelang);
    //return view('luthfi',compact('proyek', 'kelengkapanLelangs'));
});

Route::get('/proyek', 'ProyekController@index');
Route::get('/proyek/lihat/{id}', 'ProyekController@show');

//Route::get('/proyek/{id}', 'ProyekController@viewDetailProyek')->name('detail-proyek');
//Route::get('/proyek/{id}/kontrak', 'KontrakController@viewKontrak')->name('detail-kontrak');
Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');
Route::get('/kelolaLelang/{proyek_id}', 'KelengkapanLelangController@kelolaBerkas');
Route::get('/getBerkas/{id}', 'KelengkapanLelangController@getBerkas');
Route::get('file/upload/{proyek_id}', 'KelengkapanLelangController@form');
Route::post('file/upload', 'KelengkapanLelangController@uploadKelengkapanLelang')->name('file.upload');
Route::get('file/{file}/download', 'KelengkapanLelangController@downloadKelengkapanLelang')->name('file.download');
Route::get('file/{file}/response', 'KelengkapanLelangController@responseKelengkapanLelang')->name('file.response');
Route::get('file/{file}/delete', 'KelengkapanLelangController@deleteKelengkapanLelang');
Route::get('generate-pdf/{proyek_id}','KelengkapanLelangController@generatePDF');
Route::get('generate-pdf2/{proyek_id}','KelengkapanLelangController@generatePDF2');
