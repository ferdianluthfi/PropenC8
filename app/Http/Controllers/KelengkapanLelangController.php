<?php

namespace App\Http\Controllers;

use App\Proyek;
use Illuminate\Http\Request;
use App\KelengkapanLelang;
use App\ListTemplateSurat;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;

class KelengkapanLelangController extends Controller
{
    public function kelolaBerkas($proyek_id)
    {
        $proyek = Proyek::select('proyeks.*')->where('id', $proyek_id)->first();
        $berkass = KelengkapanLelang::select('kelengkapan_lelangs.*')->where('proyek_id', $proyek_id)->get();
        $templates = ListTemplateSurat::select('list_template_surats.*')->get();
//        return view('kelolaLelang');
        return view('kelolaLelang', compact('proyek', 'berkass', 'templates'));
    }

    public function deleteBerkas($berkas_id)
    {
        $berkas = KelengkapanLelang::select('kelengkapan_lelangs.*')->where('id', $berkas_id)->first();
        $proyek = Proyek::select('proyeks.*')->where('id', $berkas->proyek_id)->first();
//        proyek_id = $proyek-id;
        //        $proyek_id = $berkas->proyek_id;
        $id = $berkas->id;
        DB::delete('delete from kelengkapan_lelangs where id= :id', ['id' => $id]);
        return $this->kelolaBerkas($proyek->id);
    }
//    public function addBerkas()
//    {
//        $berkas = New_::KelengkapanLelang();
//
//    }

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

}
