<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyek;
use App\Pengguna;

class ProyekController extends Controller
{
    public function viewAll(){
        //$proyeks = Proyek::all();

        //$proyek = Proyek::find(1);
        $pengguna = Proyek::select('penggunas.*')->join('penggunas','penggunas.id','=','proyeks.pengguna_id')->where('pengguna_id',1)->get();
        //dd(Proyek::select('penggunas.*')->join('penggunas','penggunas.id','=','proyeks.pengguna_id')->where('pengguna_id',1)->get());
        return view('viewAll', compact('pengguna'));
    }
}
