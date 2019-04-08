<?php

namespace App\Http\Controllers;

// use DB;
use App\Proyek;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pengguna;


class ProyekController extends Controller
{

    public function viewAllProject(){
        //buat liat list proyek
        $proyekPoten = DB::table('proyeks')->select('projectName', 'companyName', 'id')
        ->where('approvalStatus',0)->get();
        
        $proyekNonPoten = DB::table('proyeks')->select('projectName', 'companyName', 'id', 'created_at',
        'approvalStatus')
        ->where('approvalStatus', 1)->orWhere('approvalStatus',2)->orWhere('approvalStatus',3)->get();
        
        foreach($proyekNonPoten as $proyekNonP){
            $temp = explode(" ",$proyekNonP->created_at)[0];
            $date = $this->waktu($temp);
            $proyekNonP->created_at = $date;
        }

       
        

        return view('index', compact('proyekPoten','proyekNonPoten'));

        
    }

    public function approveProjectDetail($id){
        $proyek = DB::table('proyeks')->select('*')->where('id',$id)->get()->first();
        $formatValue = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $formatValue;
        $status;

        $statusNum = $proyek-> approvalStatus;
        
        if($statusNum == 0){
            $status = "MENUNGGU PERSETUJUAN";
        }
        elseif($statusNum == 1){
            $status = "DISETUJUI DIREKSI";
        }
        elseif($statusNum == 2){
            $status = "SEDANG BERJALAN";
        }
        elseif($statusNum == 3){
            $status = "DITOLAK";
        }
        return view('approveProyekPoten', compact('proyek', 'status')); 
    }

    public function projectDetailWithoutApprove($id){
        $proyek = DB::table('proyeks') ->select('*') -> where('id', $id) -> get()->first();
        $formatValue = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $formatValue;
        $status;
        $statusNum = $proyek-> approvalStatus;
        if($statusNum == 0){
            $status = "MENUNGGU PERSETUJUAN";
        }
        elseif($statusNum == 1){
            $status = "DISETUJUI DIREKSI";
        }
        elseif($statusNum == 2){
            $status = "SEDANG BERJALAN";
        }
        elseif($statusNum == 3){
            $status = "DITOLAK";
        }
        $kontrak = DB::table('kontraks')->select('id')->where('proyek_id', $id)->first();
        // dd($kontrak);
        if($kontrak != null){
            $statusKontrak = "true";
        }
        else{
            $statusKontrak = "false";
        }
            
        return view('projectDetail', compact('proyek', 'status', 'statusKontrak'));
    }
  

    public function approveProject($id){
        $proyekz = DB::table('proyeks')
            ->where('id', $id)
            ->update(['approvalStatus' => 1]);
        return redirect('/proyek');
    }

    public function rejectProject($id){
        $proyekw = DB::table('proyeks')
            ->where('id', $id)
            ->update(['approvalStatus' => 3]);
        return redirect('/proyek');
    }
    
    public function waktu($tanggal){
        
        
        $bulan = date("m", strtotime($tanggal));
        $tahun = date("Y", strtotime($tanggal));
        $day = substr($tanggal, 8, 9);
        $days = strval($day);
        $tahuns = strval($tahun);
        
        
        
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
        
        $waktu = "$days $bulanTerbilang $tahuns";
        return($waktu);   
           
    }


}
