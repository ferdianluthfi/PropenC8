<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyek;
use App\Pengguna;

class ProyekController extends Controller
{
    public function viewAll(){
        $proyeks = Proyek::all();
        $proyekPotensial = $proyeks->filter(function ($proyek){
            return $proyek->approvalStatus == 0;
        });
        
        // dd($proyekPotensial);
        // dd($proyeks);

        //$proyek = Proyek::find(1);
        //$pengguna = Proyek::select('proyeks.*')->join('penggunas','penggunas.id','=','proyeks.pengguna_id')->where('pengguna_id',1)->get();
        //dd(Proyek::select('penggunas.name')->join('penggunas','penggunas.id','=','proyeks.pengguna_id')->where('pengguna_id',1)->get());
        //dd($pengguna);
        // $penggunas = Pengguna::select('penggunas.*')->where('id',1)->get();
        // $proyeks = Proyek::select('proyeks.*')->where('isLPJExist',1)->get();
        
        return view('view-all-proyek', ['proyeks' => $proyeks, 'proyekPotensial' => $proyekPotensial]);
    }
    public function viewDetailProyek($id){
        $proyek = Proyek::where('id', $id)->first();
        $statusHuruf;

        $status = $proyek->approvalStatus; // ini kontrak belum tentu adakan. kalo dia gapunya nanti returnnya null
        if($status == 0){
            $statusHuruf = "MENUNGGU PERSETUJUAN";
        } elseif($status == 1){
            $statusHuruf = "DISETUJUI";
        } elseif($status == 2){
            $statusHuruf = "SEDANG BERJALAN";
        }elseif($status == 3){
            $statusHuruf = "DITOLAK";
        }

        return view('detail-proyek', ["id" => $id, "proyek" => $proyek, "statusHuruf" => $statusHuruf]);
    }

    



}
