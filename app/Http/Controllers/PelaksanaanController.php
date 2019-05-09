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
        $namaProyek = Proyek::select('proyeks.projectName')->where('id',$idProyek)->first()->projectName;

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
        // dd($statusNum);
        
        $listIdPekerjaan = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.pekerjaan_id', 'kemajuan_proyeks.id')->where('pelaksanaan_id',$id)->get();
        $listFoto = DB::table('listPhoto')->select('listPhoto.*')->whereIn('kemajuan_id',$arrayidKemajuan)->get();
       
        //Realisasi Bulan dari tombol Lihat
        $realisasiLalu = 0;
        if($pelaksanaan->bulan == 1) {
            $realisasiLebih=null;
            return view('detailPelaksanaanAwal', compact('pelaksanaan','listPekerjaan','biayaKeluar','valueProyek','realisasiLalu','listFoto','listIdPekerjaan', 'status', 'namaProyek'));
        }
        else {
            $requestedMonth = date('m', strtotime($pelaksanaan->createdDate));
            $requestedYear = date('Y', strtotime($pelaksanaan->createdDate));
            $beforeDate = "$requestedYear-$requestedMonth-01";
            //dd($beforeDate);
            //Sebelum Requested Date
            $realisasiLebih = DB::table('kemajuan_proyeks')->where([['reportDate','<',$beforeDate]])->whereIn('pelaksanaan_id',$sameIdPelaksanaan)->groupBy('kemajuan_proyeks.pekerjaan_id')->selectRaw('sum(value) as sum, kemajuan_proyeks.pekerjaan_id')->get();
            //dd($realisasiLebih);
            return view('detailPelaksanaan', compact('pelaksanaan','listPekerjaan','biayaKeluar','valueProyek','realisasiLebih','listFoto','listIdPekerjaan','arrayidKemajuan', 'status', 'namaProyek'));
        }
    }

    // public function approveLapjusikDetail($id){
    //     $pelaksanaan = DB::table('pelaksanaans')->select('*')->where('id',$id)->get()->first();

    //     $status;
    //     $statusNum = $pelaksanaan-> approvalStatus;
        
    //     if($statusNum == 0){
    //         $status = "SEDANG BERJALAN";
    //     }
    //     elseif($statusNum == 1){
    //         $status = "DISETUJUI";
    //     }
    //     elseif($statusNum == 2){
    //         $status = "DITOLAK";
    //     }
    //     return view('approveLapjusik', compact('pelaksanaan', 'status')); 
    // }

  
    public function approveLAPJUSIK($id){
        $pelaksanaan = DB::table('pelaksanaans')->select('pelaksanaans.proyek_id')->where('id',$id)->first();
        // dd($pelaksanaan);
        $proyekz = DB::table('pelaksanaans')
            ->where('id', $id)
            ->update(['approvalStatus' => 1]);
        return redirect()->action('PelaksanaanController@viewPelaksanaan', ['id' => $pelaksanaan->proyek_id]);
    }
    public function rejectLAPJUSIK($id){
        $pelaksanaan = DB::table('pelaksanaans')->select('pelaksanaans.proyek_id')->where('id',$id)->first();
        $proyekw = DB::table('pelaksanaans')
            ->where('id', $id)
            ->update(['approvalStatus' => 2]);
        return redirect()->action('PelaksanaanController@viewPelaksanaan', ['id' => $pelaksanaan->proyek_id]);
    }
}
