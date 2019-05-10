<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kontrak;
Use App\Proyek;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;

class KontrakController extends Controller
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
    
    public function viewKontrakz($id){ #ahmad
        $kontrak = DB::table('kontraks')->select('*')->where('proyek_id', $id)->first();
        $proyek = DB::table('proyeks')->select('*')->where('id', $id)->first();
        $formatValue = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $formatValue;
        
        $tanggalKontrak = $kontrak->contractDate; 
        
        $status = $kontrak->approvalStatus; // ini kontrak belum tentu adakan. kalo dia gapunya nanti returnnya null
        if($status == 0){
        $tanggals = $this->waktu($tanggalKontrak);
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
        

    public function infoUmumTambahInfo($id){
        $proyek = DB::table('proyeks')->select('*')->where('id', $id)->first();
        $formatValue = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $formatValue;

       
        
        return view('kontraks.tambah-kontrak', compact('proyek'));
    }
    
    public function berkasSurat(request $request, $id){
        
        $proyek = DB::table('proyeks')->select('*')->where('id', $id)->first();
        $namaP = $request->alamatKlien;
        $kontakP =$request->contactPerson;
    
        return  view('kontraks.daftar-surat', compact('proyek'));
    }

    public function createKontrak(request $request, $id){
        // dd($request->surat);
        if ($request->file != null) {
            foreach($request->file as $file) {
                $uploadedFile = $file;
                $path = $uploadedFile->storeAs('public/upload',$file->getClientOriginalName());
                $publicPath = \Storage::url($path);
                $filename = $proyek->projectName . ' - ' . $request->title;
    
                DB::table('kontrak')->insert([
                    'approvalStatus' => 0,
                    'title' => $request->title ?? $uploadedFile->getClientOriginalName(),
                    'filename' => $filename,
                    'path' => $publicPath,
                    'ext' => $uploadedFile->getClientOriginalExtension(),
                    'proyek_id' => $id,
                    'created_at' => now('GMT+7'),
                    'updated_at' => now('GMT+7')
                ]);
            }
        }
    }
    
    public function viewKontrak($id){ #kirana
        
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
        else{
            return redirect('/error');
        }
        
    }
    public function approveKontrak($id){
        $kontrak = Kontrak::where('proyek_id', $id)->first()->update(['approvalStatus' => 1]);
        return redirect('/proyek');
    
    }
    public function disapproveKontrak($id){
        $kontrak = Kontrak::where('proyek_id', $id)->first()->update(['approvalStatus' => 2]);
        return redirect('/proyek');
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
        
        $waktu = "$dayz $bulanTerbilang $tahunz";
        return($waktou);   
           
    }

    

   
}
