<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyek;
use App\Pengguna;
use Illuminate\Support\Facades\DB;

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

    public function viewAllProject(){
        //buat liat list proyek
        $proyekPoten = DB::table('proyeks')->select('projectName', 'companyName', 'id')
        ->where('approvalStatus',0)->get();
        
        $proyekNonPoten = DB::table('proyeks')->select('projectName', 'companyName', 'id', 'created_at',
        'approvalStatus')
        ->where('approvalStatus', 1)->orWhere('approvalStatus',2)->orWhere('approvalStatus',3)->get();
        
        return view('index', compact('proyekPoten','proyekNonPoten'));
    }

    public function approveProjectDetail($id){
        //masih pake dummy blm ambil dari web idnya
        //buat nampilin detailproyek
        $proyek = DB::table('proyeks')->select('*')->where('id',$id)->get();
        $status;
        foreach($proyek as $proyeks){
            $statusNum = $proyeks-> approvalStatus;
        }
        if($statusNum == 0){
            $status = "Menunggu Persetujuan";
        }
        elseif($statusNum == 1){
            $status = "Disetujui Direksi";
        }
        elseif($statusNum == 2){
            $status = "Sedang Berjalan";
        }
        elseif($statusNum == 3){
            $status = "Ditolak";
        }
        return view('approveProyekPoten', compact('proyek', 'status')); 
    }

    public function projectDetailWithoutApprove($id){
        $proyek = DB::table('proyeks') ->select('*') -> where('id', $id) -> get()->first();
        $status;
        $statusNum = $proyek-> approvalStatus;
        if($statusNum == 0){
            $status = "Menunggu Persetujuan";
        }
        elseif($statusNum == 1){
            $status = "Disetujui Direksi";
        }
        elseif($statusNum == 2){
            $status = "Sedang Berjalan";
        }
        elseif($statusNum == 3){
            $status = "Ditolak";
        }
            
        return view('projectDetail', compact('proyek', 'status'));
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
    // public function viewDetailProyek($id){
    //     $proyek = Proyek::where('id', $id)->first();
    //     return view('detail-proyek', ["id" => $id, "proyek" => $proyek]);
    // }



}
