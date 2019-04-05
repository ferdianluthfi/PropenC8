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

Route::get('/', function () {

    $proyeg = Proyek::select('*')->where('id',1)->get();
    return $proyeg;
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

Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');
Route::get('/proyek/setujuiProyek/{id}', 'ProyekController@approveProjectDetail');
Route::post('/proyek/setujuiProyek/setuju/{id}', 'ProyekController@approveProject');
Route::post('/proyek/setujuiProyek/tolak/{id}', 'ProyekController@rejectProject');
Route::get('/proyek/daftarProyek', 'ProyekController@viewAllProject');
Route::get('/proyek/detailProyek/{id}', 'ProyekController@projectDetailWithoutApprove');
Route::get('/proyek/kontrak/lihatKontrak/{idProyek}, ');

// Route::get('/proyek', 'ProyekController@viewAll')->name('view-all-proyek');
// Route::get('/proyek/{id}', 'ProyekController@viewDetailProyek')->name('detail-proyek');
// Route::get('/proyek/{id}/kontrak', 'KontrakController@viewKontrak')->name('detail-kontrak');


// Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');
