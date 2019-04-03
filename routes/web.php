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
Route::get('/viewproyek', 'ProyekController@view');
Route::get('/kelolaLelang/{proyek_id}', 'KelengkapanLelangController@kelolaBerkas');
Route::get('/getBerkas/{id}', 'KelengkapanLelangController@getBerkas');
Route::get('file/upload/{proyek_id}', 'KelengkapanLelangController@form');
Route::post('file/upload', 'KelengkapanLelangController@uploadKelengkapanLelang')->name('file.upload');
Route::get('file/{file}/download', 'KelengkapanLelangController@downloadKelengkapanLelang')->name('file.download');
Route::get('file/{file}/response', 'KelengkapanLelangController@responseKelengkapanLelang')->name('file.response');
Route::get('file/{file}/delete', 'KelengkapanLelangController@deleteKelengkapanLelang');
Route::get('generate-pdf','KelengkapanLelangController@generatePDF');


















//
//Route::get('/kemajuanProyek', 'ProyekController@viewAll');
//
//Route::get('/proyek/view', 'ProyekController@view');
//
//Route::get('/proyek/view/kelolaLelang/{proyek_id}', 'KelengkapanLelang@kelolaBerkas');
//
////Route::post(
////Route::get('kelengkapanLelang', 'KelengkapanLelangController@view');
////Route::post('/proyek/lelang/view', 'ProyekController@getDataProyek')->name('detailProyek.store');
//
//
//Route::get('/kelolaLelang', 'KelengkapanLelangController@testkontroller');

//};
//
//Route::get('/uc03-viewProyek', function () {
//    return view('viewProyek');
