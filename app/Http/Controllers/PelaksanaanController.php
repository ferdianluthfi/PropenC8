<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Proyek;
use App\Pelaksanaan;
use App\Review;
use App\KemajuanProyek;
use App\Assignment;
use DB;
use DateInterval;
use PDF; 
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
        $listPekerjaan = DB::table('jenis_pekerjaan')->where('proyek_id',$id)->get();
        
        $flaggedPelaksanaan=null;
        $draftFlag = Pelaksanaan::select('pelaksanaans.*')->where('flag',0)->get();
        if($draftFlag->isempty()) {
            $draftFlag = null;
            return view('listPelaksanaan', compact('listPelaksanaan','listInformasi','listPekerjaan','idProyek','namaProyek','draftFlag','flaggedPelaksanaan'));
        }
        if(count($draftFlag) == 1) {
            $flaggedPelaksanaan = Pelaksanaan::select('pelaksanaans.*')->where('flag',0)->first();
            return view('listPelaksanaan', compact('listPelaksanaan','listInformasi','listPekerjaan','idProyek','namaProyek','flaggedPelaksanaan','draftFlag'));
        }
        return view('listPelaksanaan', compact('listPelaksanaan','listInformasi','listPekerjaan','idProyek','namaProyek','draftFlag','flaggedPelaksanaan'));
    }
    public function tambahPelaksanaan($id) {
        $pelaksanaan = DB::table('pelaksanaans')->select('pelaksanaans.*')->where('id',$id)->first();
        $flaggedPelaksanaan = DB::table('pelaksanaans')->select('pelaksanaans.*')->where('id',$id)->update(['flag' => 1]);
        return redirect()->action('PelaksanaanController@viewPelaksanaan', ['id' => $pelaksanaan->proyek_id]);
    }
    public function detailPelaksanaan($id) {
        $pelaksanaan = DB::table('pelaksanaans')->select('pelaksanaans.*')->where('id',$id)->first();
        $idProyek = $pelaksanaan->proyek_id;
        $valueProyek = DB::table('proyeks')->select('proyeks.projectValue')->where('id',$idProyek)->first()->projectValue;
        $namaProyek = Proyek::select('proyeks.projectName')->where('id',$idProyek)->first()->projectName;
        $sameIdPelaksanaan = Pelaksanaan::where([['proyek_id','=',$idProyek]])->get();
        $listPekerjaan = DB::table('jenis_pekerjaan')->select('jenis_pekerjaan.*')->where('proyek_id',$idProyek)->get();
        $biayaKeluar = DB::table('kemajuan_proyeks')->where('pelaksanaan_id',$id)->groupBy('kemajuan_proyeks.pekerjaan_id')->selectRaw('sum(value) as sum, kemajuan_proyeks.pekerjaan_id')->get(); 
        $fotoByIdKemajuan = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.id')->where('pelaksanaan_id',$id)->get();
        $interval="";
        $arrayidKemajuan = array($fotoByIdKemajuan->count());
        $counter=0;
        foreach($fotoByIdKemajuan as $idKemajuan) {
            $arrayidKemajuan[$counter] = $idKemajuan->id;
            $counter++;
        }
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
        $listIdPekerjaan = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.pekerjaan_id', 'kemajuan_proyeks.id')->where('pelaksanaan_id',$id)->get(); 
        $listFoto = DB::table('listphoto')->select('listphoto.*')->whereIn('kemajuan_id',$arrayidKemajuan)->get();
        $review = Review::where('pelaksanaan_id', $id)->first();
        $lapjusikStatus = Pelaksanaan::where('id', $id)->first()->approvalStatus;
        $proyek = Proyek::where('id', $idProyek)->first();
        $displayText;
        $createdDate="";
        $rating="";
        $updateDate="";
        //Realisasi Bulan dari tombol Lihat
        $realisasiLalu = 0;
        if($proyek == null  || $pelaksanaan == null){
            return redirect('/error');
        }
        elseif($lapjusikStatus != 1){
            $displayText = "Tidak dapat menambahkan review karena persetujuan tidak sesuai.";
        }
        elseif($review == null){
            $displayText = "Belum ada review.";
        }
        else{
            $rating = $review->rating;
            $displayText = $review->description;
            $createdDate = $review->created_at;
            $updateDate = $review->updated_at;
            $updateDate30m = $createdDate->add(new DateInterval("PT30M"));
            $now = now();
            $noww=$now->add(new DateInterval("PT7H"));
            $interval = $noww < $updateDate30m;
        }
        if($pelaksanaan->bulan == 1) {
            $realisasiLebih=null;
            return view('detailPelaksanaanAwal', compact('pelaksanaan','listPekerjaan','biayaKeluar','valueProyek','realisasiLalu','listFoto','listIdPekerjaan','displayText', 'lapjusikStatus', 'review', 'createdDate', 'rating', 'interval', 'status', 'namaProyek'));
        }
        else {
            $requestedMonth = date('m', strtotime($pelaksanaan->createdDate));
            $requestedYear = date('Y', strtotime($pelaksanaan->createdDate));
            $beforeDate = "$requestedYear-$requestedMonth-01";
            //dd($beforeDate);
            // dd($sameIdPelaksanaan);
            //Sebelum Requested Date
            $realisasiLebih = DB::table('kemajuan_proyeks')->where([['reportDate','<',$beforeDate]])->whereIn('pelaksanaan_id',$sameIdPelaksanaan)->groupBy('kemajuan_proyeks.pekerjaan_id')->selectRaw('sum(value) as sum, kemajuan_proyeks.pekerjaan_id')->get();
            // dd($realisasiLebih);
            return view('detailPelaksanaan', compact('pelaksanaan','listPekerjaan','biayaKeluar','valueProyek','realisasiLebih','listFoto','arrayidKemajuan','listIdPekerjaan', 'displayText', 'lapjusikStatus', 'review', 'createdDate', 'updateDate', 'rating','interval', 'status', 'namaProyek'));
        }
    }
    public function deletePelaksanaan($id) {
        $pelaksanaan = DB::table('pelaksanaans')->select('pelaksanaans.*')->where('id',$id)->first();
        $flaggedPelaksanaan = DB::table('pelaksanaans')->select('pelaksanaans.*')->where('id',$id)->update(['flag' => 0]);
        return redirect()->action('PelaksanaanController@viewPelaksanaan', ['id' => $pelaksanaan->proyek_id]);
    }
    public function downloadPelaksanaan($id){
        $pelaksanaan = DB::table('pelaksanaans')->select('pelaksanaans.*')->where('id',$id)->first();
        $kemajuanPertama = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.reportDate')->where('pelaksanaan_id',$id)->first();
        $tahunPeriode = date('Y', strtotime($pelaksanaan->createdDate));
        $idProyek = $pelaksanaan->proyek_id;
        $proyek = DB::table('proyeks')->select('proyeks.*')->where('id',$idProyek)->first();
        if(\Auth::user()->role == 6) {
            $manajerPelaksana = \Auth::user()->name;
        }
        $periodeMulai = $this->waktu(date('Y-m-1', strtotime($kemajuanPertama->reportDate)));
        $periodeSelesai = $this->waktu(date('Y-m-t', strtotime($kemajuanPertama->reportDate)));
        $tanggalPelaksanaan = $this->waktu(date('Y-m-d'));
        $sameIdPelaksanaan = Pelaksanaan::where([['proyek_id','=',$idProyek]])->get();
        $listPekerjaan = DB::table('jenis_pekerjaan')->select('jenis_pekerjaan.*')->where('proyek_id',$idProyek)->get();
        $biayaKeluar = DB::table('kemajuan_proyeks')->where('pelaksanaan_id',$id)->groupBy('kemajuan_proyeks.pekerjaan_id')->selectRaw('sum(value) as sum, kemajuan_proyeks.pekerjaan_id')->get();
        $totalBiaya = DB::table('kemajuan_proyeks')->where('pelaksanaan_id',$id)->sum('value');
        $totalAnggaranPekerjaan = DB::table('jenis_pekerjaan')->where('proyek_id',$idProyek)->sum('workTotalValue');
        $idKlien = Assignment::select('assignments.klien_id')->where('proyek_id',$pelaksanaan->proyek_id)->first();
        $namaKlien = DB::table('users')->select('users.name')->where('id',$idKlien->klien_id)->first()->name;
        $realisasiLalu = 0;
        if($pelaksanaan->bulan == 1) {
            $realisasiLebih=null;
            $pdf = PDF::loadView('downloadPelaksanaanAwal', compact('pelaksanaan', 'totalAnggaranPekerjaan','manajerPelaksana','listPekerjaan', 'totalBiaya','namaKlien','tanggalPelaksanaan','biayaKeluar','realisasiLalu','proyek','tahunPeriode','periodeMulai','periodeSelesai'));
            return $pdf->setPaper('a4','landscape')->download('LAPJUSIK Bulan '. $pelaksanaan->bulan . ' Proyek ' . $proyek->projectName .'.pdf');
        }
        else {
            $requestedMonth = date('m', strtotime($pelaksanaan->createdDate));
            $requestedYear = date('Y', strtotime($pelaksanaan->createdDate));
            $beforeDate = "$requestedYear-$requestedMonth-01";
            //Sebelum Requested Date
            $realisasiLebih = DB::table('kemajuan_proyeks')->where([['reportDate','<',$beforeDate]])->whereIn('pelaksanaan_id',$sameIdPelaksanaan)->groupBy('kemajuan_proyeks.pekerjaan_id')->selectRaw('sum(value) as sum, kemajuan_proyeks.pekerjaan_id')->get();
            //dd($realisasiLebih);
            $pdf = PDF::loadView('downloadPelaksanaan', compact('pelaksanaan','totalAnggaranPekerjaan','manajerPelaksana','listPekerjaan', 'totalBiaya', 'namaKlien','tanggalPelaksanaan','biayaKeluar','proyek','realisasiLebih','tahunPeriode','periodeMulai','periodeSelesai'));
            return $pdf->setPaper('a4','landscape')->download('LAPJUSIK Bulan '. $pelaksanaan->bulan . ' Proyek ' . $proyek->projectName .'.pdf');
        }
    }
    public function waktu($tanggal){
        
        
        $bulan = date("m", strtotime($tanggal));
        $tahun = date("Y", strtotime($tanggal));
        $day = substr($tanggal, 8, 9);
        $dayz = strval($day);
        $tahunz = strval($tahun);
        //dd(var_dump($tahunz));
        //$wew = date("d F Y", strtotime($tanggal));
        
        
        $bulanTerbilang;
        if($bulan == "1"){
            $bulanTerbilang = "Januari";
        }
        
        elseif($bulan == "2"){
            $bulanTerbilang = "Februari";
        }
        
        elseif($bulan == "3"){
            $bulanTerbilang = "Maret";
        }
        
        elseif($bulan == "4"){
            $bulanTerbilang = "April";
        }
        
        elseif($bulan == "5"){
            $bulanTerbilang = "Mei";
        }
        elseif($bulan == "6"){
            $bulanTerbilang = "Juni";
        }
        elseif($bulan == "7"){
            $bulanTerbilang = "Juli";
        }
        elseif($bulan == "8"){
            $bulanTerbilang = "Agustus";
        }
        if($bulan == "9"){
            $bulanTerbilang = "September";
        }
        
        elseif($bulan == "10"){
            $bulanTerbilang = "Oktober";
        }
        elseif($bulan == "11"){
            $bulanTerbilang = "November";
        }
        
        elseif($bulan == "12"){ 
            $bulanTerbilang = "Desember";
        }
        
        $waktoe = "$dayz $bulanTerbilang $tahunz";
        return($waktoe);   
           
    }
    public function approveLAPJUSIK($id){
       
        $pelaksanaan = DB::table('pelaksanaans')->select('pelaksanaans.proyek_id')->where('id',$id)->first();
        $proyekz = DB::table('pelaksanaans') ->where('id', $id)->update([
                'approvalStatus' => 1]
        );
        return redirect()->action('PelaksanaanController@viewPelaksanaan', ['id' => $pelaksanaan->proyek_id]);
    }
    public function rejectLAPJUSIK($id){
       
        $pelaksanaan = DB::table('pelaksanaans')->select('pelaksanaans.proyek_id')->where('id',$id)->first();
        $proyekw = DB::table('pelaksanaans')->where('id', $id) ->update([
            'approvalStatus' => 2
        ]);
        return redirect()->action('PelaksanaanController@viewPelaksanaan', ['id' => $pelaksanaan->proyek_id]);
    }
}
