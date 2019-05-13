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
        
        return view('kontraks.tambah-kontrak', compact('proyek'));
    }
    
    public function berkasSurat(request $request, $id){
        
        $proyek = DB::table('proyeks')->select('*')->where('id', $id)->first();
        
        $namaP = $request->alamatKlien;
        $kontakP =$request->contactPerson;

        
        // return  view('kontraks.daftar-surat', compact('proyek'));
        return $this->generateSurat($id, $namaP, $kontakP);
    }

    public function generateSurat($id, $namaP, $kontakP){
        $proyek = DB::table('proyeks')->where('id', $id)->first();
        $tanggal = now('GMT+7');
        $namaP = $namaP;
        $kontakP = $kontakP;   
        
        $data = [
            'tanggal' => $tanggal,
            'namaPerusahaan' => $namaP,
            'contactPerson' => $kontakP,
            'projectName' => $proyek->projectName,

        ];
         
        $pdf = PDF::loadView('template-surat/suratJualBeli', $data);
        
        $docName = 'Surat Kontrak Jual Beli';

        $tes = Storage::put($docName, $pdf->output());
        

        $ext = 'pdf';
        $file = DB::table('kontraks')->insert([
            'approvalStatus' => 0,
            'title' =>  $docName,
            'filename' => $proyek->projectName . ' - Surat Kontrak Jual Beli',
            'path' => $docName,
            'ext' => 'pdf',
            'proyek_id' => $id,
            'pengguna_id' => $proyek->pengguna_id,
            'created_at' => now('GMT+7'),
            'updated_at' => now('GMT+7')
        ]);
        
        
        return  view('kontraks.daftar-surat', compact('proyek'));
    }

    public function createKontrak(request $request, $id){
        $proyek = DB::table('proyeks')->where('id',$id)->first();
        $arrSurat = $request->surat;

        $key = array_keys($request->surat);
        
        if ($request->surat != null) {
            for($i = 0 ; $i < sizeOf($arrSurat); $i++) { 
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
                        
                    }    
                    $uploadedFile = $arrSurat[$nilai];
                    // dd($uploadedFile);
                    $path = $uploadedFile->storeAs('upload', $uploadedFile->getClientOriginalName());
                    // $publicPath = Storage::url($path);
                    // dd($publicPath);
                    
                    $filename = $proyek->projectName . ' - '. $namaSurat;
                    
                    
                    \DB::table('kontraks')->insert([
                        'approvalStatus' => 0,
                        'title' =>  $namaSurat ?? $uploadedFile->getClientOriginalName(),
                        'filename' => $filename,
                        'path' => $path,
                        'ext' => $uploadedFile->getClientOriginalExtension(),
                        'proyek_id' => $id,
                        'pengguna_id' => $proyek->pengguna_id,
                        'created_at' => now('GMT+7'),
                        'updated_at' => now('GMT+7')
                    ]);
                    DB::table('proyeks')->where('id', $id)->update(['approvalStatus' => 5]);

                }
                catch(\Exception $e){
                    continue;
                }
            }
        }

        // return $this->viewKontrakz($id);
        return redirect()->route('view-kontrak', ['id' => $id]);    
    }

    public function overviewKontrak($id){ #ahmad
        
        $listKontrak = DB::table('kontraks')->select('*')->where('proyek_id', $id)->where('flag_active', '1')->get();
        $kontrakPasti = DB::table('kontraks')->select('*')->where('proyek_id', $id)->where('flag_active', '1')->first();
    
        $proyek = DB::table('proyeks')->select('*')->where('id', $id)->first();
        // dd($proyek);
        $formatValue = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $formatValue;
        foreach($listKontrak as $kontrak){
            $tanggal = $kontrak->created_at;
            $tgl = $this->waktu($tanggal);
            $kontrak->created_at = $tgl;
            
        }

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
        return view('viewKontrak', compact('proyek', 'tanggals', 'statusHuruf', 'listKontrak'));
    
        
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
            return redirect()->route('detailProyek', ['id' => $proyek->id]);

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

    

   
}
