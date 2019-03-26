<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyek;
use App\Pengguna;

class ProyekController extends Controller
{
    public function viewAll(){
        $proyeks = Proyek::all();

        $proyek = Proyek::find(1);
        $pengguna = Proyek::select('proyeks.*')->join('penggunas','penggunas.id','=','proyeks.pengguna_id')->where('pengguna_id',1)->get();
        dd(Proyek::select('penggunas.name')->join('penggunas','penggunas.id','=','proyeks.pengguna_id')->where('pengguna_id',1)->get());
        dd($pengguna);
        $penggunas = Pengguna::select('penggunas.*')->where('id',1)->get();
        $proyeks = Proyek::select('proyeks.*')->where('isLPJExist',1)->get();
        return view('viewAll', compact('proyeks','penggunas'));
    }

    /*
     * harus dikasi param yang di-get dari viewAll proyek,
     * nanti paramnya masuk fungsi
     */
    public function view(){
        $proyek = Proyek::find(1);
        return view('viewProyek', compact('proyek'));
    }

}
