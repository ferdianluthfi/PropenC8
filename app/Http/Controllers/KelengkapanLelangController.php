<?php

namespace App\Http\Controllers;

use App\Proyek;
use Illuminate\Http\Request;
use App\KelengkapanLelang;

class KelengkapanLelangController extends Controller
{
    public function view(){
        $proyek = Proyek::find(1);
        return view('kelolaLelang', compact('proyek'));
    }
    public function getDataProyek(Proyek $proyek){

        return $proyek->all();
    }

}
