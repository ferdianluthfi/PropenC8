<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KemajuanProyek;
use App\Proyek;
use App\Pelaksanaan;


class KemajuanProyekController extends Controller
{
    /**
     * method untuk melihat daftar kemajuan seluruh proyek yang sedang berjalan
     */
    public function viewKemajuan(){

        $idProyeks = Proyek::select('proyeks.id')->where('isLPJExist', 0)->get();
        $idPelaksanaan = Pelaksanaan::select('pelaksanaans.id')->whereIn('proyek_id',$idProyeks)->get();
        $kemajuans = KemajuanProyek::select('kemajuan_proyeks.*')->whereIn('pelaksanaan_id',$idPelaksanaan)->get();
        
        return view('viewAll', compact('kemajuans'));
    }
}
