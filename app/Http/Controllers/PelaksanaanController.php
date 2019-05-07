<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyek;
use App\Pelaksanaan;
use App\KemajuanProyek;
use App\Assignment;
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
        $namaProyek = Proyek::select('proyeks.projectName')->where('id',$idProyek)->first()->projectName; 
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
        return view('listPelaksanaan', compact('listPelaksanaan','listInformasi','lizWork','idProyek','namaProyek'));
    }

    public function detailPelaksanaan($id) {
        $pelaksanaan = DB::table('pelaksanaans')->select('pelaksanaans.*')->where('id',$id)->first();
        $idProyek = $pelaksanaan->proyek_id;
        $valueProyek = DB::table('proyeks')->select('proyeks.projectValue')->where('id',$idProyek)->first()->projectValue;

        $sameIdPelaksanaan = Pelaksanaan::where([['proyek_id','=',$idProyek]])->get();
        //dd($sameIdPelaksanaan);
        $listPekerjaan = DB::table('jenis_pekerjaan')->select('jenis_pekerjaan.*')->where('proyek_id',$idProyek)->get();
        $biayaKeluar = DB::table('kemajuan_proyeks')->where('pelaksanaan_id',$id)->groupBy('kemajuan_proyeks.pekerjaan_id')->selectRaw('sum(value) as sum, kemajuan_proyeks.pekerjaan_id')->get(); 
        //dd($biayaKeluar);

        $fotoByIdKemajuan = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.id')->where('pelaksanaan_id',$id)->get();
        //dd(json_decode($fotoByIdKemajuan));

        $arrayidKemajuan = array($fotoByIdKemajuan->count());
        $counter=0;
        //dd($arrayidKemajuan);

        foreach($fotoByIdKemajuan as $idKemajuan) {
            $arrayidKemajuan[$counter] = $idKemajuan->id;
            $counter++;
        }
        //dd($arrayidKemajuan);
        
        $listIdPekerjaan = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.pekerjaan_id', 'kemajuan_proyeks.id')->where('pelaksanaan_id',$id)->get(); 
        $listFoto = DB::table('listPhoto')->select('listPhoto.*')->whereIn('kemajuan_id',$arrayidKemajuan)->get();
        //dd($listIdPekerjaan);

        //Realisasi Bulan dari tombol Lihat
        $realisasiLalu = 0;
        if($pelaksanaan->bulan == 1) {
            $realisasiLebih=null;
            return view('detailPelaksanaanAwal', compact('pelaksanaan','listPekerjaan','biayaKeluar','valueProyek','realisasiLalu','listFoto','listIdPekerjaan'));
        }
        else {
            $requestedMonth = date('m', strtotime($pelaksanaan->createdDate));
            $requestedYear = date('Y', strtotime($pelaksanaan->createdDate));
            $beforeDate = "$requestedYear-$requestedMonth-01";
            //dd($beforeDate);

            //Sebelum Requested Date
            $realisasiLebih = DB::table('kemajuan_proyeks')->where([['reportDate','<',$beforeDate]])->whereIn('pelaksanaan_id',$sameIdPelaksanaan)->groupBy('kemajuan_proyeks.pekerjaan_id')->selectRaw('sum(value) as sum, kemajuan_proyeks.pekerjaan_id')->get();
            //dd($realisasiLebih);
            return view('detailPelaksanaan', compact('pelaksanaan','listPekerjaan','biayaKeluar','valueProyek','realisasiLebih','listFoto','arrayidKemajuan','listIdPekerjaan'));
        }
    }
}


//dd($sameIdPelaksanaan);
            /*$firstDate = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.reportDate')->whereIn('pelaksanaan_id',$sameIdPelaksanaan)->min('reportDate');
            $firstMonth =date('m', strtotime($firstDate)); 
            $firstYear = date('Y', strtotime($firstDate));

            $yearGap = $requestedYear - $firstYear;
            if ($yearGap == 0) {
                $selisihMonth = $requestedMonth - $firstMonth;
                dd($selisihMonth);    

                
            }
            else if ($yearGap > 0) {
                if ($requestedMonth == $firstMonth) {
                    $adjustedMonth = ($yearGap * 12) + 1;
                }
                else if ($requestedMonth > $firstMonth) {
                    $adjustedMonth = ($yearGap * 12) + ($requestedMonth-$firstMonth) + 1;
                }
                else if ($requestedMonth < $firstMonth) {
                    $adjustedMonth = ($yearGap * 12) - ($firstMonth-$requestedMonth) + 1;
                }
            }*/