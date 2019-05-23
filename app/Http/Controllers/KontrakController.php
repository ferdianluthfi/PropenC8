<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kontrak;
Use App\Proyek;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use PDF;

use App\Assignment;
use App\KelengkapanLelang;
use App\Files;
use App\ListTemplateSurat;

use PhpParser\Node\Expr\New_;


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

    public function infoUmumTambahInfo($id){
        $proyek = DB::table('proyeks')->select('*')->where('id', $id)->first(); 
        
        $formatValue = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $formatValue;

        $klien = DB::table('users')->where('role', 8)->get();
        return view('kontraks.tambah-kontrak', compact('proyek', 'klien'));
    }
    
    public function berkasSurat($id){
        
        $proyek = DB::table('proyeks')->select('*')->where('id', $id)->first();
        
        return  view('kontraks.daftar-surat', compact('proyek'));
    }

    public function generateSurat(request $request, $id){
        $proyek = DB::table('proyeks')->where('id', $id)->first();
        $waktuNow = now('GMT+7');
        $tanggal = $this->waktu($waktuNow); 
        $alamatP = $request->alamatKlien;
        $kontakP =$request->namaKlien;
        

        DB::table('assignments')->insert([
            'klien_id' => $kontakP,
            'proyek_id' => $proyek->id,
            'assignmentDate' => now('GMT+7')
        ]);
        
        $data = [
            'tanggal' => $tanggal,
            'alamatPerusahaan' => $alamatP,
            'contactPerson' => $kontakP,
            'projectName' => $proyek->projectName,
            'companyName' => $proyek->companyName
        ];
         
        $pdf = PDF::loadView('template-surat/suratJualBeli', $data);
        // dd($pdf);

        $title = 'Surat Kontrak Jual Beli';
        $docName = $proyek->projectName . ' - Surat Kontrak Jual Beli';

        $ext = 'pdf';

        // $pdf->download($proyek->projectName . ' - ' . $docName . '.pdf');

        $tes = Storage::put($docName, $pdf->output());


        return Storage::download($docName, $docName . '.' . $ext);
    }

    public function createKontrak(request $request, $id){
        $proyek = DB::table('proyeks')->where('id', $id)->first();
        $arrSurat = $request->surat;
        $loop = 0;
        
        if ($request->surat != null) {
            $key = array_keys($request->surat);
            // dd($key);
            for($i = 0 ; $i < 17; $i++) { 
                try{
                    $namaSurat;
                    $nilai = $key[$i];
                    switch($nilai){
                        case 0;
                            $namaSurat = "Surat Keputusan Otorisasi Pelaksanaan";
                            break;
                        case 1;
                            $namaSurat = "Surat Perintah Pelaksanaan Program";
                            break;
                        case 2;
                            $namaSurat = "Surat Perintah Panitia Pelelangan";
                            break;
                        case 3;
                            $namaSurat = "Surat Undangan";
                            break;
                        case 4;
                            $namaSurat = "Berita Acara Penjelasan Pekerjaan";
                            break;
                        case 5;
                            $namaSurat = "Daftar Hadir Panitia dan Peserta Lelang";
                            break;
                        case 6;
                            $namaSurat = "Daftar Permintaan Barang";
                            break;
                        case 7;
                            $namaSurat = "Daftar Harga Perkiraan Sendiri";
                            break;
                        case 8;
                            $namaSurat = "Berita Acara Pembukaan Dokumen Penawaran";
                            break;
                        case 9;
                            $namaSurat = "Surat Penawaran Rekanan";
                            break;
                        case 10;
                            $namaSurat = "Surat Jaminan Penawaran";
                            break;
                        case 11;
                            $namaSurat = "Data Perusahaan Pemenang";
                            break;
                        case 12;
                            $namaSurat = "Berita Acara Negosiasi";
                            break;
                        case 13;
                            $namaSurat = "Surat Keputusan Pelulusan Pemenang";
                            break;
                        case 14;
                            $namaSurat = "Surat Perintah Kerja";
                            break;
                        case 15;
                            $namaSurat = "Surat Jaminan Bank";
                            break;
                        case 16;
                            $namaSurat = "Surat Kontrak Jual Beli";
                            break;
                        
                    }    
                    $uploadedFile = $arrSurat[$nilai];
                    $path = $uploadedFile->storeAs('upload', $uploadedFile->getClientOriginalName());
                    $filename = $proyek->projectName . ' - '. $namaSurat;
                    // dd($filename);

                    $file = DB::table('kontraks')->updateOrInsert(
                        ['proyek_id' => $id, 'title' => $namaSurat],
                        ['approvalStatus' => 0,
                        'title' =>  $namaSurat ?? $uploadedFile->getClientOriginalName(),
                        'filename' => $filename,
                        'path' => $path,
                        'ext' => $uploadedFile->getClientOriginalExtension(),
                        'proyek_id' => $id,
                        'flag_active' => 1,
                        'pengguna_id' => $proyek->pengguna_id,
                        'created_at' => now('GMT+7'),
                        'updated_at' => now('GMT+7')
                    ]); 
                    
                   
                    
                }
                catch(\Exception $e){
                    continue;
                }
                // $loop = $loop + 1;
            }
        }
        else{
            return redirect()->route('view-kontrak', ['id' => $id]);    
        }
        // dd($loop);
        DB::table('proyeks')->where('id', $id)->update(['approvalStatus' => 5]);
        return redirect()->route('view-kontrak', ['id' => $id]);
            
    }

    public function overviewKontrak($id){ #ahmad
        
        $listKontrak = DB::table('kontraks')->select('*')->where('proyek_id', $id)->where('flag_active', '1')->get();
        $kontrakPasti = DB::table('kontraks')->select('*')->where('proyek_id', $id)->where('flag_active', '1')->first();
    
        $proyek = DB::table('proyeks')->select('*')->where('id', $id)->first();
        
        $varNum = ($proyek->projectValue);
        $nilaiTerbilang = $this->valueTerbilang($varNum);
       
        $uang = ucwords($nilaiTerbilang);
        $hurufNilai = $uang . ' Rupiah';

        $formatValue = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $formatValue;
        foreach($listKontrak as $kontrak){
            $tanggal = $kontrak->created_at;
            $tgl = $this->waktu($tanggal);
            $kontrak->created_at = $tgl;
            
        }
        
        // dd($kontrakPasti);
        $tanggalKontrak = $kontrakPasti->created_at; 
        $tanggals = $this->waktu($tanggalKontrak);

        $status = $kontrakPasti->approvalStatus; // ini kontrak belum tentu adakan. kalo dia gapunya nanti returnnya null
        if($status == 0){
            $statusHuruf = "MENUNGGU PERSETUJUAN";
        } 
        elseif($status == 1){
            $statusHuruf = "DISETUJUI";
        } 
        elseif($status == 2){
            $statusHuruf = "DITOLAK";
        }
        return view('viewKontrak', compact('proyek', 'tanggals', 'statusHuruf', 'listKontrak', 'hurufNilai'));
    
        
    }

    public function downloadSuratKontrak($idKontrak){
    //    dd($idKontrak);
        $kontrak = DB::table('kontraks')->where('id', $idKontrak)->first();
        // dd($kontrak->path);
        return Storage::download($kontrak->path, $kontrak->filename . '.' . $kontrak->ext);
    }   
    
    public function deleteSuratKontrak($idKontrak){
        $surat = DB::table('kontraks')->where('id', $idKontrak)->first();
        $proyek = DB::table('proyeks')->where('id', $surat->proyek_id)->first();
        Kontrak::where('id', $idKontrak)->update(['flag_active' => 0]);
        $cekStatus = DB::table('kontraks')->where('proyek_id', $proyek->id)->where('flag_active', 1)->first();
        // dd($cekStatus);
        if($cekStatus !=null){
            return $this->overviewKontrak($proyek->id);
        }
        else{
            DB::table('proyeks')->where('id', $proyek->id)->update(['approvalStatus' => 4]);
            return redirect('/proyek/lihat/'. $proyek->id);

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
        $kontrak = Kontrak::where('proyek_id', $id)->get();
        
        foreach($kontrak as $kontraks){
           $judul = $kontraks['title'];
           DB::table('kontraks')->where('title', $judul)->where('proyek_id', $id)
           ->update(['approvalStatus' => 1]);
        }
       

        $proyek = Proyek::where('id', $id)->first()->update(['approvalStatus' => 6]);
        return redirect('/proyek');
    
    }

    public function disapproveKontrak($id){
        $kontrak = Kontrak::where('proyek_id', $id)->get();
        
        foreach($kontrak as $kontraks){
            $judul = $kontraks['title'];
            DB::table('kontraks')->where('title', $judul)->where('proyek_id', $id)
            ->update(['approvalStatus' => 2]);
         }

        $proyek = Proyek::where('id', $id)->first()->update(['approvalStatus' => 9]);
        return redirect('/proyek');
    }
       
    
    public function waktu($tanggal){
        
        $bulan = date("m", strtotime($tanggal));
        $tahun = date("Y", strtotime($tanggal));
        $day = date("d", strtotime($tanggal));
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
        return($waktu);   
           
    }

   public function valueTerbilang($angka){
       $arrAngka = array("", "satu", "dua", "tiga", "empat", "lima", "enam",
       "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
       $num = abs($angka);
       $var = "";

       if($num < 12){
           $var = " ".$arrAngka[$num];
        }
        else if($num < 20){
            $var = $this->valueTerbilang($num - 10). " belas";
        } 
        else if ($num <100) {
            $var = $this->valueTerbilang($num/10)." puluh". $this->valueTerbilang($num % 10);
        } 
        else if ($num <200) {
            $var = " seratus" . $this->valueTerbilang($num - 100);
        } 
        else if ($num <1000) {
            $var = $this->valueTerbilang($num/100) . " ratus" . $this->valueTerbilang($num % 100);
        } 
        else if ($num <2000) {
            $var = " seribu" . $this->valueTerbilang($num - 1000);
        } 
        else if ($num <1000000) {
            $var = $this->valueTerbilang($num/1000) . " ribu" . $this->valueTerbilang($num % 1000);
        } 
        else if ($num <1000000000) {
            $var = $this->valueTerbilang($num/1000000) . " juta" . $this->valueTerbilang($num % 1000000);
        } 
        else if ($num <1000000000000) {
            $var = $this->valueTerbilang($num/1000000000) . " miliar" . $this->valueTerbilang(fmod($num,1000000000));
        } 
        else if ($num <1000000000000000) {
            $var = $this->valueTerbilang($num/1000000000000) . " triliun" . $this->valueTerbilang(fmod($num,1000000000000));
        }
            return $var;
   }

    

   
}
