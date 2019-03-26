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
Route::get('/luthfi', function () {
    $proyek = App\Proyek::find(1);
//    $kelengkapanLelang = App\KelengkapanLelang::table('proyeks')
//        ->join('proyeks','proyeks.id','=','kelengkapan_lelangs','kelengkapan_lelangs.proyek_id')->where('kelengkapan_lelangs.proyek_id',1)
//        ->get();
//    //$proyek = $kelengkapanLelang->proyek()->where('id', 1)->get();
//    dd($kelengkapanLelang);
    //return view('luthfi',compact('proyek', 'kelengkapanLelangs'));
});

Route::get('/kemajuanProyek', 'ProyekController@viewAll');

Route::get('/proyek/view', 'ProyekController@view');

Route::get('/proyek/lelang/view', 'KelengkapanLelangController@view');
Route::post('/proyek/lelang/view', 'ProyekController@getDataProyek')->name('detailProyek.store');
Route::post('/proyek/lelang/view', 'ProyekController@getDataProyek')->name('detailProyek.store');


Route::get('/kelolaLelang', 'KelengkapanLelangController@testkontroller');

//};
//
//Route::get('/uc03-viewProyek', function () {
//    return view('viewProyek');
