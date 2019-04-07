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

Route::get('/error', function () {
    return view('error-message');
});

Route::get('/no-access', function () {
    return view('no-access');
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

Route::get('/proyek', 'ProyekController@viewAll')->name('view-all-proyek');
Route::get('/proyek/{id}', 'ProyekController@viewDetailProyek')->name('detail-proyek');
Route::get('/proyek/{id}/kontrak', 'KontrakController@viewKontrak')->name('detail-kontrak');

Route::post('proyek/{id}/kontrak/approve', 'KontrakController@approveKontrak')->name('approve-kontrak');
Route::post('proyek/{id}/kontrak/disapprove', 'KontrakController@disapproveKontrak')->name('disapprove-kontrak');


Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');