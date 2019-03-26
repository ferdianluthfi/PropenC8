<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KemajuanProyek;

class KemajuanProyekController extends Controller
{
     /**
     * method untuk melihat daftar informasi kemajuan proyek
     */
    public function viewInformasi(){

        $idProyeks = Proyek::select('proyeks.id')->where('isLPJExist', 0)->get();
        $idPelaksanaan = Pelaksanaan::select('pelaksanaans.id')->whereIn('proyek_id',$idProyeks)->get();
        $kemajuans = KemajuanProyek::select('kemajuan_proyeks.*')->whereIn('pelaksanaan_id',$idPelaksanaan)->get();
        
        return view('viewAll', compact('kemajuans'));
    }
}
