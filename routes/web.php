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

// Route::get('/proyeks', function () {
//     $proyek = App\Proyek::all();
//     return view('proyeks.index', compact('proyek'));
// });

// Route::get('/proyeks/{proyek}', function ($id) {
//     $proyek = App\Proyek::find($id);
//     return view('proyeks.show', compact('proyek'));
// });

Route::get('/proyek', 'ProyekController@index');
Route::get('/proyek/tambah', 'ProyekController@create');
Route::post('/proyek/store', 'ProyekController@store');
Route::post('/proyek/update', 'ProyekController@update');
Route::get('/proyek/ubah/{id}', 'ProyekController@edit');
Route::get('/proyek/hapus/{id}', 'ProyekController@destroy');
Route::get('/proyek/lihat/{id}', 'ProyekController@show');
Route::get('/proyek/{id}', 'ProyekController@show');

// Route::get('/proyek', 'ProyekController@viewAll')->name('view-all-proyek');
// Route::get('/proyek/{id}', 'ProyekController@viewDetailProyek')->name('detail-proyek');
// Route::get('/proyek/{id}/kontrak', 'KontrakController@viewKontrak')->name('detail-kontrak');


Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');
