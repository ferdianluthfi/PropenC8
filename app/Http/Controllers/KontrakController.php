<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kontrak;
Use App\Proyek;
use Illuminate\Support\Facades\DB;

class KontrakController extends Controller
{
    
    public function viewKontrakz($id){
        $kontrak = DB::table('kontraks')->select('*')->where('proyek_id', $id)->first();
        $proyek = DB::table('proyeks')->select('*')->where('id', $id)->first();
        $formatValue = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $formatValue;
        
        $tanggalKontrak = $kontrak->contractDate; 
        $tanggals = $this->waktu($tanggalKontrak);
        
        $status = $kontrak->approvalStatus; // ini kontrak belum tentu adakan. kalo dia gapunya nanti returnnya null
        if($status == 0){
            $statusHuruf = "MENUNGGU PERSETUJUAN";
        } 
        elseif($status == 1){
            $statusHuruf = "DISETUJUI";
        } 
        elseif($status == 2){
            $statusHuruf = "DITOLAK";
        }
        return view('viewKontrak', compact('kontrak', 'proyek', 'tanggals', 'statusHuruf'));
    }
        

    public function waktu($tanggal){
        
        
        $bulan = date("m", strtotime($tanggal));
        $tahun = date("Y", strtotime($tanggal));
        $day = substr($tanggal, 8, 9);
        $dayz = strval($day);
        $tahunz = strval($tahun);
     
        
        
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
        public function viewKontrak($id){
        
        $proyek = Proyek::where('id', $id)->first();
        $kontrak = Kontrak::where('proyek_id', $id)->first();
        
        if($kontrak != null){
             $status = $kontrak->approvalStatus; // ini kontrak belum tentu adakan. kalo dia gapunya nanti returnnya null
            if($status == 0){
                $statusHuruf = "MENUNGGU PERSETUJUAN";
            } elseif($status == 1){
                $statusHuruf = "DISETUJUI";
            } elseif($status == 2){
                $statusHuruf = "DITOLAK";
            }
            
            $formatValue = number_format($proyek->projectValue, 2, ',','.');
            return view('detail-kontrak', ["statusHuruf" => $statusHuruf, "status" => $status, "kontrak" => $kontrak, "proyek" => $proyek, "id" => $id, 'formatValue' => $formatValue]);
        } 
        // else{
        //     return redirect('/error');
        // }
        
    }
    public function approveKontrak($id){
        $kontrak = Kontrak::where('proyek_id', $id)->first()->update(['approvalStatus' => 1]);
        return redirect('/proyek');
    
    }
    public function disapproveKontrak($id){
        $kontrak = Kontrak::where('proyek_id', $id)->first()->update(['approvalStatus' => 2]);
        return redirect('/proyek');
    }
        

    

   
}
