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

        $status;
        $lapjusikPoten = DB::table('pelaksanaans')->orderBy('created_at','desc')->where('approvalStatus',0)->where('pengguna_id', \Auth::user()->id)->get();
        $lapjusikNonPoten = DB::table('pelaksanaans')->orderBy('created_at','desc')->where('approvalStatus', 1)->orWhere('approvalStatus',2)->get();
        
        foreach($lapjusikPoten as $proyeg){
            $statusNum = $proyeg-> approvalStatus;

            if($statusNum == 0){
                $status = "MENUNGGU PERSETUJUAN";
            }
        }
        foreach($lapjusikNonPoten as $proyeg){

            $statusNum = $proyeg-> approvalStatus;
            $temp = explode(" ",$proyeg->created_at)[0];
            $date = $this->waktu($temp);
            $proyeg->created_at = $date;

            if($statusNum == 1){
                $status = "DISETUJUI";
            }elseif($statusNum == 2){
                $status = "DITOLAK";
            }
        }
        
        $listIdPekerjaan = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.pekerjaan_id')->groupBy('kemajuan_proyeks.pekerjaan_id')->where('pelaksanaan_id',$id)->get();
        $listFoto = DB::table('listPhoto')->select('listPhoto.*')->whereIn('kemajuan_id',$arrayidKemajuan)->get();
        //dd($listIdPekerjaan);
        //Realisasi Bulan dari tombol Lihat
        $realisasiLalu = 0;
        if($pelaksanaan->bulan == 1) {
            $realisasiLebih=null;
            return view('detailPelaksanaanAwal', compact('pelaksanaan','listPekerjaan','biayaKeluar','valueProyek','realisasiLalu','listFoto','listIdPekerjaan', 'lapjusikPoten', 'lapjusikNonPoten', 'status'));
        }
        else {
            $requestedMonth = date('m', strtotime($pelaksanaan->createdDate));
            $requestedYear = date('Y', strtotime($pelaksanaan->createdDate));
            $beforeDate = "$requestedYear-$requestedMonth-01";
            //dd($beforeDate);
            //Sebelum Requested Date
            $realisasiLebih = DB::table('kemajuan_proyeks')->where([['reportDate','<',$beforeDate]])->whereIn('pelaksanaan_id',$sameIdPelaksanaan)->groupBy('kemajuan_proyeks.pekerjaan_id')->selectRaw('sum(value) as sum, kemajuan_proyeks.pekerjaan_id')->get();
            //dd($realisasiLebih);
            return view('detailPelaksanaan', compact('pelaksanaan','listPekerjaan','biayaKeluar','valueProyek','realisasiLebih','listFoto','arrayidKemajuan', 'lapjusikPoten', 'lapjusikNonPoten', 'status'));
        }
    }

    public function approveLapjusikDetail($id){
        $pelaksanaan = DB::table('pelaksanaans')->select('*')->where('id',$id)->get()->first();

        $status;
        $statusNum = $pelaksanaan-> approvalStatus;
        
        if($statusNum == 0){
            $status = "SEDANG BERJALAN";
        }
        elseif($statusNum == 1){
            $status = "DISETUJUI";
        }
        elseif($statusNum == 2){
            $status = "DITOLAK";
        }
        return view('approveLapjusik', compact('pelaksanaan', 'status')); 
    }

  
    public function approveLAPJUSIK($id){
        $proyekz = DB::table('pelaksanaans')
            ->where('id', $id)
            ->update(['approvalStatus' => 1]);
        return redirect('/lapjusik');
    }
    public function rejectLAPJUSIK($id){
        $proyekw = DB::table('pelaksanaans')
            ->where('id', $id)
            ->update(['approvalStatus' => 2]);
        return redirect('/lapjusik');
    }
}
