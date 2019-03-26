<?php

namespace App\Http\Controllers;

use App\Proyek;
use Illuminate\Http\Request;
use App\KelengkapanLelang;

class KelengkapanLelangController extends Controller
{
    public function kelolaBerkas($proyek_id){
        $proyek = Proyek::select('proyeks.*')->where('id', $proyek_id)->get();

//        return view('kelolaLelang');
        return view('kelolaLelang', compact('proyek'));
//    }
//
//
//<p>Nama Proyek : {{ $proyek->projectName }}</p>
//<p>Alamat Proyek : {{ $proyek->projectAddress }}</p>
//<p>Nama User apa ini : {{ $proyek->name }}</p>
//<p>Nama Perusahaan : {{ $proyek->companyName }}</p>
//<p>Tanggal Mulai Proyek : {{ $proyek->startDate }}</p>
//<p>Tanggal Selesai Proyek : {{ $proyek->endDate }}</p>
//<p>Deskripsi : {{ $proyek->description }}</p>
//<p>Nilai Proyek : {{ $proyek->projectValue }}</p>
//<p>Perkiraan waktu pengerjaan proyek : {{ $proyek->estimatedTime }} hari</p>
//<p>Deskripsi : {{ $proyek->description }}</p>
//

}}
