<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kontrak;
Use App\Proyek;
use Illuminate\Support\Facades\DB;

class KontrakController extends Controller
{
<<<<<<< HEAD
    
    public function viewKontrakz($id){
        $kontrak = DB::table('kontraks')->select('*')->where('proyek_id', $id)->first();
        $proyek = DB::table('proyeks')->select('*')->where('id', $id)->first();
        return view('viewKontrak', compact('kontrak', 'proyek'));
        
        
    }
 
    // public function viewKontrak($id){

    //     $kontrak = Kontrak::where('proyek_id', $id)->first();
        
        
    //     $status = $kontrak->approvalStatus; // ini kontrak belum tentu adakan. kalo dia gapunya nanti returnnya null
    //     if($status == 0){
    //         $statusHuruf = "MENUNGGU PERSETUJUAN";
    //     } elseif($status == 1){
    //         $statusHuruf = "DISETUJUI";
    //     } elseif($status == 2){
    //         $statusHuruf = "DITOLAK";
    //     }

    //     return view('detail-kontrak', ["statusHuruf" => $statusHuruf, "status" => $status, "kontrak" => $kontrak]);
    // }

    // public function approveKontrak($id){
    //     $kontrak = Kontrak::where('proyek_id', $id)->first()->update(['approvalStatus' => 1]);
    //     return redirect('/proyek');
    
    // }

    // public function disapproveKontrak($id){
    //     $kontrak = Kontrak::where('proyek_id', $id)->first()->update(['approvalStatus' => 2]);
    //     return redirect('/proyek');
    // }
=======
 
    public function viewKontrak($id){

        $kontrak = Kontrak::where('proyek_id', $id)->first();
        
        
        $status = $kontrak->approvalStatus; // ini kontrak belum tentu adakan. kalo dia gapunya nanti returnnya null
        if($status == 0){
            $statusHuruf = "MENUNGGU PERSETUJUAN";
        } elseif($status == 1){
            $statusHuruf = "DISETUJUI";
        } elseif($status == 2){
            $statusHuruf = "DITOLAK";
        }

        return view('detail-kontrak', ["statusHuruf" => $statusHuruf, "status" => $status, "kontrak" => $kontrak]);
    }

    public function approveKontrak($id){
        $kontrak = Kontrak::where('proyek_id', $id)->first()->update(['approvalStatus' => 1]);
        return redirect('/proyek');
    
    }

    public function disapproveKontrak($id){
        $kontrak = Kontrak::where('proyek_id', $id)->first()->update(['approvalStatus' => 2]);
        return redirect('/proyek');
    }
>>>>>>> f7cb0484295cde5b6c8ee233a2652382fbb7eaab

   
}
