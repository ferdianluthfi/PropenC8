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

<<<<<<< HEAD
Route::get('/luthfi', function () {
    $proyek = App\Proyek::find(1);
    $kelengkapanLelang = App\KelengkapanLelang::table('proyeks')
    ->join('proyeks','proyeks.id','=','kelengkapan_lelangs','kelengkapan_lelangs.proyek_id')->where('kelengkapan_lelangs.proyek_id',1)
    ->get();
    //$proyek = $kelengkapanLelang->proyek()->where('id', 1)->get();
    dd($kelengkapanLelang);
    //return view('luthfi',compact('proyek', 'kelengkapanLelangs'));
});

=======
/**
 * routing untuk home dan landing
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
   });
});

/**
 * routing untuk proyek
 */
Route::get('/proyek', 'ProyekController@index');
Route::get('/proyek/tambah', 'ProyekController@create');
Route::post('/proyek/store', 'ProyekController@store');
Route::post('/proyek/update', 'ProyekController@update');
Route::get('/proyek/ubah/{id}', 'ProyekController@edit');
Route::get('/proyek/hapus/{id}', 'ProyekController@destroy');
Route::get('/proyek/lihat/{id}', 'ProyekController@show'); //Fungsi ini adalah untuk lihat detail proyek potensial(belum ikut lelang)
Route::get('/proyek/{id}', 'ProyekController@viewDetailProyek')->name('detail-proyek'); //Fungsi ini untuk lihat proyek yang sudah diapprove oleh direksi(tappi kontrak kerja belum tentnu dikasih liat)
Route::get('/proyek/{id}/kontrak', 'KontrakController@viewKontrak')->name('detail-kontrak');
Route::post('proyek/{id}/kontrak/approve', 'KontrakController@approveKontrak')->name('approve-kontrak');
Route::post('proyek/{id}/kontrak/disapprove', 'KontrakController@disapproveKontrak')->name('disapprove-kontrak');

/**
 * routing untuk kemajuan proyek
 */
>>>>>>> d2c231adb6fbf71ee8a9ae7c5c9eb8e55d8afb5a
Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');
Route::get('/proyek/setujuiProyek/{id}', 'ProyekController@approveProjectDetail');
Route::post('/proyek/setujuiProyek/setuju/{id}', 'ProyekController@approveProject');
Route::post('/proyek/setujuiProyek/tolak/{id}', 'ProyekController@rejectProject');
Route::get('/proyek/', 'ProyekController@viewAllProject');
Route::get('/proyek/detailProyek/{id}', 'ProyekController@projectDetailWithoutApprove');
Route::get('/proyek/{id}/lihatKontrak/', 'KontrakController@viewKontrakz');
// Route::get('/proyek', 'ProyekController@viewAll')->name('view-all-proyek');
// Route::get('/proyek/{id}', 'ProyekController@viewDetailProyek')->name('detail-proyek');
// Route::get('/proyek/{id}/kontrak', 'KontrakController@viewKontrak')->name('detail-kontrak');


<<<<<<< HEAD
// Route::get('/kemajuanProyek', 'KemajuanProyekController@viewKemajuan');
=======


>>>>>>> d2c231adb6fbf71ee8a9ae7c5c9eb8e55d8afb5a
