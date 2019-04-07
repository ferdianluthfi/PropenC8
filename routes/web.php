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
    $kelengkapanLelang = App\KelengkapanLelang::table('proyeks')
    ->join('proyeks','proyeks.id','=','kelengkapan_lelangs','kelengkapan_lelangs.proyek_id')->where('kelengkapan_lelangs.proyek_id',1)
    ->get();
    //$proyek = $kelengkapanLelang->proyek()->where('id', 1)->get();
    dd($kelengkapanLelang);
    //return view('luthfi',compact('proyek', 'kelengkapanLelangs'));
});

Route::get('/proyek', 'KemajuanProyekController@viewProyek');
Route::get('/proyek/detail/{id}', 'KemajuanProyekController@detailProyek');
Route::get('/informasi/{id}', 'KemajuanProyekController@viewInfo');
Route::get('/informasi/detail/{id}', 'KemajuanProyekController@detailInfo');
Route::get('/info/tambah/{idpelaksanaan}', 'KemajuanProyekController@tambahInformasi');
Route::post('/info/submit/{idPelaksanaan}', 'KemajuanProyekController@simpanInformasi');
Route::get('/info/edit/{id}', 'KemajuanProyekController@editInformasi');
Route::post('/info/update/{id}', 'KemajuanProyekController@updateInformasi');
Route::get('/info/delete/{id}', 'KemajuanProyekController@hapusInformasi');