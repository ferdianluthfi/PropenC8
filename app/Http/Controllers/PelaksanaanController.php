<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelaksanaan;
use App\KemajuanProyek;
use DB;

class PelaksanaanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewProyek(){
        $idProyek = Assignment::select('assignments.proyek_id')->where('pengguna_id',\Auth::user()->id)->get();
        $listProyek = Proyek::select('proyeks.*')->whereIn('id',$idProyek)->get(); 
        return view('listProyek', compact('listProyek'));
    }

    public function viewPelaksanaan($id){
        $idProyek = $id;
        $idPelaksanaan = Pelaksanaan::select('pelaksanaans.id')->where('proyek_id',$id)->get();
        $listPelaksanaan = Pelaksanaan::select('pelaksanaans.*')->where('proyek_id',$id)->get();
        $listInformasi = KemajuanProyek::select('kemajuan_proyeks.*')->whereIn('pelaksanaan_id',$idPelaksanaan)->get();
        $listPekerjaan = DB::table('jenis_pekerjaan')->select('jenis_pekerjaan.name')->where('proyek_id',$id)->get();
        $lizWork=array($listPekerjaan->count());
        $counter = 0;
        foreach($listPekerjaan as $pekerjaan) {
            $lizWork[$counter] = $pekerjaan->name;
            $counter++;
        }
        return view('listPelaksanaan', compact('listPelaksanaan','listInformasi','lizWork','idProyek'));
    }

    public function detailPelaksanaan($id) {
        $buatPertama = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.reportDate')->min('reportDate');
        $bulanPertama = date('m', strtotime($buatPertama));
        $tahunPertama = date('Y', strtotime($buatPertama));
        //dd($tahunPertama);
        $requestedMonth = DB::table('pelaksanaans')->select('pelaksanaans.bulan')->where('id',$id)->first();
        //dd(json_decode($requestedMonth)[0]->bulan);
        //dd($requestedMonth->bulan);
        $requestedDate = DB::table('pelaksanaans')->select('pelaksanaans.createdDate')->where('id',$id)->get();
        $requestedYear = date('Y', strtotime($requestedDate));

        $targetBulan = $bulanPertama + ($requestedMonth->bulan) - 1 % 12;
        dd($targetBulan);
        for($x = $bulanPertama; $x <= $bulanPertama; $x++) {
            //if ($x-)
            $targetBulan++;
        }

        //$listBulan = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.reportDate')->where(date('m', strtotime('reportDate')),);
        //dd($requestedMonth);
        //dd($bulanPertama);
        /*$tgl = '2016-11-01 15:04:19';
        $tgll = date('m', strtotime($tgl));
        //dd($tgll);
        $hasil = $tgll - $bulanPertama;
        dd($hasil);*/

        $idProyek = Pelaksanaan::select('pelaksanaans.proyek_id')->whereIn('id',$idPelaksanaan)->get();
        $proyek = Proyek::find($idProyek[0]->proyek_id);
        $informasi = KemajuanProyek::find($id);
        $temp = number_format($informasi->value, 2, ',','.');
        $informasi->value = $temp;
        $tanggalInfo = $informasi->reportDate;
        $tanggal = $this->waktu($tanggalInfo);
        $foto = DB::table('listPhoto')->where('kemajuan_id',$id)->get();

        return view('detailInformasi', compact('informasi','proyek','tanggal','foto','lizWork'));
    }
}