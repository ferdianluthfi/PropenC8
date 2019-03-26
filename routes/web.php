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
    $kelengkapanLelang = App\KelengkapanLelang::table('proyeks')
    ->join('proyeks','proyeks.id','=','kelengkapan_lelangs','kelengkapan_lelangs.proyek_id')->where('kelengkapan_lelangs.proyek_id',1)
    ->get();
    //$proyek = $kelengkapanLelang->proyek()->where('id', 1)->get();
    dd($kelengkapanLelang);
    //return view('luthfi',compact('proyek', 'kelengkapanLelangs'));
});

<<<<<<< HEAD
Route::get('/kemajuanProyek', 'ProyekController@viewAll');

Route::get('/ahmad', function () {
    $proyeg = Proyek::table('proyeks')->get();

    return $proyeg;

    return view('welcome');
});
=======
Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');
>>>>>>> da65c5c2a4865678ef26436b5022da5b2e21abd8
