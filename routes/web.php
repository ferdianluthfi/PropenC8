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
    return view('luthfi',[ 'name' => "Ganteng"]);
});
Route::get('/tomps', function () {

    $goals = [
        "i always thought",
        "if i jumped of a bridge",
        "it would be over a girl",
        "and i'd be nude",
        "and listening to the smiths."
    ];
    
     $name = "Darkness My Old Friend~";
    return view('tomps', compact('name','goals'));
});