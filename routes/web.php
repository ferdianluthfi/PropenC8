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
    $kelengkapanLelangs = $proyek->kelengkapanLelangs->where('proyek_id', 1)->get();
    //$proyek = $kelengkapanLelang->proyek()->where('id', 1)->get();

    return view('luthfi',compact('proyek', 'kelengkapanLelangs'));
});

Route::get('/momo', function () {
    
    return view('momo');
});
