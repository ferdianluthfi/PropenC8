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
Route::get('wow', function () {
    return view('belajar/about', [
        'name' => "World",
        'umur' => "12"
    ]);
});
Route::get('/belajarPassView', function () {
    $nama = "abdul";
    $tes = "BETOOOL";
    return view('belajar/pass', compact("nama", "tes"));
});

Route::get('/belajarPassViewz', function () {
    $liz = ["Aku adalah lelaki",
    "Yang tak pernah lelah mencari wanita",
    "Teeezzz"];
    return view('belajar/pass', compact("liz"));
});


