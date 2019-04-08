<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KemajuanProyek;
use App\Proyek;
use App\Pelaksanaan;
use App\Assignment;
use App\ListPhoto;
use DB;
use Validator;
use Illuminate\Support\Facades\Storage;

class KemajuanProyekController extends Controller
{
     /**
     * method untuk melihat daftar informasi kemajuan proyek
use App\User;



class KemajuanProyekController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * method untuk melihat daftar kemajuan seluruh proyek yang sedang berjalan
     */

    public function viewProyek(){
        $idPm = Assignment::select('assignments.pengguna_id')->where('proyek_id',1)->get();  
        $listProyek = Proyek::select('proyeks.*')->whereIn('pengguna_id',$idPm)->get(); 
        return view('listProyek', compact('listProyek'));
    }

    public function detailProyek($id) {
        $proyek = Proyek::find($id);
        $temp = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $temp;     

        return view('detailProyek', compact('proyek'));
    }

    public function viewKemajuan(){
        if(\Auth::user()->role == 2){
            $idProyeks = Proyek::select('proyeks.id')->where('isLPJExist', 3)->get();
            if($idProyeks->isEmpty() == false){
                $proyeks = Proyek::select('proyeks.*')->where('isLPJExist', 0)->get();
                $idPelaksanaan = Pelaksanaan::select('pelaksanaans.id')->whereIn('proyek_id',$idProyeks)->get();
                $pelaksanaans = Pelaksanaan::select('pelaksanaans.*','proyeks.*','kemajuan_proyeks.*')
                ->join('proyeks','proyeks.id','=','pelaksanaans.proyek_id')
                ->join('kemajuan_proyeks','kemajuan_proyeks.pelaksanaan_id','=','pelaksanaans.id')
                ->whereIn('proyek_id',$idProyeks)->get();
                $kemajuans = KemajuanProyek::select('kemajuan_proyeks.*')->whereIn('pelaksanaan_id',$idPelaksanaan)->get();
                $proyekPrint = [];
                $proyekDetail = [];
                $data = $pelaksanaans->groupBy('proyek_id');
                foreach ($data as $proyek) {
                    $sumGaji = 0;
                    $sumBelanja = 0;
                    $sumAdministrasi = 0;
                    foreach ($proyek as $kemajuan) {
                        if ($kemajuan['tipeKemajuan'] == 1) {
                            $sumGaji += $kemajuan['value'];
                        }
                        elseif ($kemajuan['tipeKemajuan'] == 2) {
                            $sumBelanja += $kemajuan['value'];
                        }
                        else {
                            $sumAdministrasi += $kemajuan['value'];
                        }
                    }
                    
                    $proyekDetail[] = array(
                        "projectName" => $kemajuan['projectName'],
                        "totalGaji" => $sumGaji,
                        "totalBelanja" => $sumBelanja,
                        "totalAdministrasi" => $sumAdministrasi,
                        "totalKeseluruhan" => $sumGaji + $sumAdministrasi + $sumBelanja,
                        "maxValue" => $kemajuan['projectValue'],
                        "projectKlien" => $kemajuan['companyName'],
                        
                    );
                    $proyekPrint[$kemajuan['projectName']] = (($sumGaji + $sumAdministrasi + $sumBelanja) / $kemajuan['projectValue'])*100;
                }    
                //dd($proyekDetail);
                $test = 50;
                //print json_encode($proyekDetail);
                return view('viewAll', compact('proyekPrint','proyekDetail','test'));
            }
            else{
                return view('viewAll-Empty');
            }
        }
        else{
            return view('no-access'); //TODO: BIKIN HALAMAN ANDA TIDAK MEMILIKI AKSES
        }
        
    }

    public function viewInfo($id){
        $idPelaksanaan = Pelaksanaan::select('pelaksanaans.id')->where('proyek_id',$id)->get();
        $listInformasi = KemajuanProyek::select('kemajuan_proyeks.*')->whereIn('pelaksanaan_id',$idPelaksanaan)->get();
        $pelaksanaan = Pelaksanaan::where([['proyek_id','=',$id],['approvalStatus','=',0]])->first();

        if($pelaksanaan == null) {
            DB::table('pelaksanaans')->insert([
                'approvalStatus' => 0,
                'createdDate' => now('GMT+7'),
                'proyek_id' => $id,
                'created_at' => now('GMT+7'),
                'updated_at' => now('GMT+7')
            ]);
            $pelaksanaan = Pelaksanaan::where([['proyek_id','=',$id],['approvalStatus','=',0]])->first();         
        }
            return view('listInformasi', compact('listInformasi','pelaksanaan'));
    }

    public function detailInfo($id) {
        $idPelaksanaan = KemajuanProyek::select('kemajuan_proyeks.pelaksanaan_id')->where('id',$id)->get();
        $idProyek = Pelaksanaan::select('pelaksanaans.proyek_id')->whereIn('id',$idPelaksanaan)->get();
        $proyek = Proyek::find($idProyek[0]->proyek_id);
        $informasi = KemajuanProyek::find($id);
        $temp = number_format($informasi->value, 2, ',','.');
        $informasi->value = $temp;
        $tanggalInfo = $informasi->reportDate;
        $tanggal = $this->waktu($tanggalInfo);
        $foto = DB::table('listPhoto')->where('kemajuan_id',$id)->get();
        // $banyakFoto = DB::table('listPhoto')->where('kemajuan_id',$id)->get()->count();
        // $listFoto = array();
        // for($i=0; i<$banyakFoto; i++){
        //     $listFoto[$i] = $foto[$i]
        // }
        // $daftarFoto = ListPhoto::select('listphoto.*')->where('kemajuan_id',$id);
        //dd($foto);

        return view('detailInformasi', compact('informasi','proyek','tanggal','foto'));
    }

    public function tambahInformasi($id){
        $pelaksanaan = Pelaksanaan::find($id);
        return view('tambahInformasi',compact('pelaksanaan'));
    }

    /*
    @param \Illuminate\Http\Request
    @return \Illuminate\Http\Response
    */
    public function simpanInformasi($id, Request $request){

        $idProyek = Pelaksanaan::select('pelaksanaans.proyek_id')->where('id',$id)->get();
        $data = json_decode($idProyek);

        $validator = Validator::make($request->all(),[
            'description' => 'required',
            'reportDate' => 'required',
            'tipeKemajuan' => 'required',
            'value' => 'required',
            'pelaksanaan_id' => 'required',
            'file' => 'required|image'
        ]);
 
        DB::table('kemajuan_proyeks')->insert([
    		'description' => $request->description,
            'reportDate' => $request->reportdate,
            'tipeKemajuan' => $request->tipekemajuan,
            'value' => $request->nilai,
            'pelaksanaan_id' => $id,
            'created_at' => now('GMT+7'),
            'updated_at' => now('GMT+7')
        ]);

        $kemajuans = KemajuanProyek::select('kemajuan_proyeks.*')->where('pelaksanaan_id', $id)->get()->last();
        $kemajuan_id = $kemajuans->id;

        if ($request->file != null) {
            foreach($request->file as $file) {
                $uploadedFile = $file;
                //dd($uploadedFile);   
                $path = $uploadedFile->storeAs('public/upload',$file->getClientOriginalName());
                $publicPath = \Storage::url($path);
    
                DB::table('listphoto')->insert([
                    'ext' => $uploadedFile->getClientOriginalExtension(),
                    'path' => $publicPath,
                    'kemajuan_id' => $kemajuan_id,
                    'created_at' => now('GMT+7'),
                    'updated_at' => now('GMT+7')
                ]);
            }
        }

        /*if($request->file!= null) {
            $path = $uploadedFile->store('/files');
        }*/
        return redirect()->action('KemajuanProyekController@viewInfo',['id'=>$data[0]->proyek_id]);
    }

    public function editInformasi($id){
        $idPelaksanaan = KemajuanProyek::select('kemajuan_proyeks.pelaksanaan_id')->where('id',$id)->get();
        $idProyek = Pelaksanaan::select('pelaksanaans.proyek_id')->whereIn('id',$idPelaksanaan)->get();
        $proyek = Proyek::find($idProyek[0]->proyek_id);
        $kemajuans = KemajuanProyek::find($id);

        $foto = DB::table('listPhoto')->select('listPhoto.*')->where('kemajuan_id',$id)->get();
        //dd($foto);
        return view('editInformasi', compact('kemajuans','proyek','foto'));
    }

    public function updateInformasi($id, Request $request){
        
        
        $allId = DB::table('listPhoto')->select('listPhoto.id')->where('kemajuan_id',$id)->whereNotIn('id',$request->listId)->get();
        $deletedId = json_decode($allId);
        for($i=0;$i<sizeof($allId);$i++) {

            DB::table('listPhoto')->where('id',$deletedId[$i]->id)->delete();
        }
        //dd($deletedId[0]->id);
        $idPelaksanaan = KemajuanProyek::select('kemajuan_proyeks.pelaksanaan_id')->where('id',$id)->get();
        $idProyek = Pelaksanaan::select('pelaksanaans.proyek_id')->whereIn('id',$idPelaksanaan)->get();
        $data = json_decode($idProyek);
        $validator = Validator::make($request->all(),[
            'description' => 'required',
            'reportDate' => 'required',
            'tipeKemajuan' => 'required',
            'value' => 'required',
            'pelaksanaan_id' => 'required',
            'file' => 'required|image'
    	]);

        $kemajuans = KemajuanProyek::find($id);
        $kemajuans->description = $request->description;
        $kemajuans->reportDate = $request->reportdate;
        $kemajuans->value = $request->nilai;
        $kemajuans->tipeKemajuan = $request->tipekemajuan;
        $kemajuans->save();

        return redirect()->action('KemajuanProyekController@viewInfo',['id'=>$data[0]->proyek_id]);
    }

    public function hapusInformasi($id){
        $idPelaksanaan = KemajuanProyek::select('kemajuan_proyeks.pelaksanaan_id')->where('id',$id)->get();
        $idProyek = Pelaksanaan::select('pelaksanaans.proyek_id')->whereIn('id',$idPelaksanaan)->get();
        $data = json_decode($idProyek);
        $kemajuans = KemajuanProyek::find($id);
        $kemajuans->delete();
        return redirect()->action('KemajuanProyekController@viewInfo',['id'=>$data[0]->proyek_id]);
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
}