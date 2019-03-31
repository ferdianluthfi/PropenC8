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
Route::get('file/upload', 'KelengkapanLelangController@form')->name('file.form');
Route::post('file/upload', 'KelengkapanLelangController@upload')->name('file.upload');
Route::get('file/{file}/download', 'KelengkapanLelangController@download')->name('file.download');
Route::get('file/{file}/response', 'KelengkapanLelangController@response')->name('file.response');

Route::get('/kelolaLelang/delete/{berkas_id}', 'KelengkapanLelangController@deleteBerkas');


















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
