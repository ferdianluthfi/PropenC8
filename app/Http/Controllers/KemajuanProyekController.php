<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\KemajuanProyek;
use App\Proyek;
use App\Pelaksanaan;
use App\Assignment;
use App\ListPhoto;
use App\TipePekerjaan;
use DB;
use Validator;
use Illuminate\Support\Facades\Storage;
class KemajuanProyekController extends Controller
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
     /**
     * method untuk melihat daftar informasi kemajuan proyek
     * method untuk melihat daftar kemajuan seluruh proyek yang sedang berjalan
     */
    public function viewProyek(){
        $idProyek = Assignment::select('assignments.proyek_id')->where('pengguna_id',\Auth::user()->id)->get();
        $listProyek = Proyek::select('proyeks.*')->whereIn('id',$idProyek)->get(); 
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
            $idProyeks = Proyek::select('proyeks.id')->where('isLPJExist', 0)->where('approvalStatus',7)->get();
            if($idProyeks->isEmpty() == false){
                
                
                $pelaksanaans = Pelaksanaan::select('pelaksanaans.*','proyeks.*','kemajuan_proyeks.*')
                ->join('proyeks','proyeks.id','=','pelaksanaans.proyek_id')
                ->join('kemajuan_proyeks','kemajuan_proyeks.pelaksanaan_id','=','pelaksanaans.id')
                ->whereIn('proyek_id',$idProyeks)->get();

                $proyeks = Proyek::select('proyeks.*')->where('isLPJExist', 0)->where('approvalStatus',7)->whereNotIn('id', 
                
                Pelaksanaan::select('proyeks.id')
                ->join('proyeks','proyeks.id','=','pelaksanaans.proyek_id')
                ->whereIn('proyek_id',$idProyeks)->get()
                
                )->get();

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
                        "projectId" => $kemajuan['proyek_id'],
                        
                    );
                }
                return view('viewAll', compact('proyekDetail','proyeks'));
            }
            else{
                return view('viewAll-Empty');
            }
        }
        else{
            return view('no-access'); 
        }
        
    }
    public function viewInfo($id){
        $ldate = date('Y-m-d');
        $idPelaksanaan = Pelaksanaan::select('pelaksanaans.id')->where('proyek_id',$id)->get();
        $listInformasi = KemajuanProyek::select('kemajuan_proyeks.*')->whereIn('pelaksanaan_id',$idPelaksanaan)->get();
        $listPekerjaan = DB::table('jenis_pekerjaan')->where('proyek_id',$id)->get();

        $approvedPelaksanaan = DB::table('pelaksanaans')->select('id')->where('approvalStatus',1)->where('proyek_id',$id)->get();
        $approvedIsExist = false;

        return view('listInformasi', compact('listInformasi','listPekerjaan','id','approvedPelaksanaan','approvedIsExist'));
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
        $foto = DB::table('listphoto')->where('kemajuan_id',$id)->get();

        $listPekerjaan = DB::table('jenis_pekerjaan')->where('proyek_id',$idProyek[0]->proyek_id)->get();
        return view('detailInformasi', compact('informasi','proyek','tanggal','foto','listPekerjaan'));
    }
    public function tambahInformasi($id){
        $proyekId = $id;
        $allPelaksanaan = Pelaksanaan::where([['proyek_id','=',$proyekId]])->get();
        $maxDate = date('Y-m-d');
        $allApproved = true;

        // dd($allPelaksanaan);
        if($allPelaksanaan->isempty()) {
            $minDate = Proyek::select('proyeks.created_at')->where('id',$proyekId)->first()->created_at->format('Y-m-d');
        }
        else {
            foreach($allPelaksanaan as $pelaksanaan) {
                if ($pelaksanaan->approvalStatus == 0 || $pelaksanaan->approvalStatus==2) {
                    $allApproved = false;
                    if($pelaksanaan->bulan == 1) {
                        $minDate = "$pelaksanaan->createdDate";
                        $pekerjaan = DB::table('jenis_pekerjaan')->where('proyek_id',$proyekId)->get();
                        return view('tambahInformasi',compact('pekerjaan','proyekId','minDate','maxDate'));
                    }
                    else {
                        $requestedMonth = date('m', strtotime($pelaksanaan->createdDate));
                        $requestedYear = date('Y', strtotime($pelaksanaan->createdDate));
                        $minDate = "$requestedYear-$requestedMonth-01";
                        $pekerjaan = DB::table('jenis_pekerjaan')->where('proyek_id',$proyekId)->get();
                        return view('tambahInformasi',compact('pekerjaan','proyekId','minDate','maxDate')); 
                    }
                }            
            }
            //Jika semua pelaksanaan bulan sebelumnya sudah disetujui
            if ($allApproved == true) {
                if(sizeof($allPelaksanaan) == 1) {
                    $minDate = json_decode($allPelaksanaan[0])->createdDate;
                }
                else {
                    $requestedMonth = date('m', strtotime($maxDate));
                    $requestedYear = date('Y', strtotime($maxDate));
                    $minDate = "$requestedYear-$requestedMonth-01";
                }
            }
        }
         //dd($minDate);
        //dd($maxDate);
        $pekerjaan = DB::table('jenis_pekerjaan')->where('proyek_id',$proyekId)->get();
        return view('tambahInformasi',compact('pekerjaan','proyekId','minDate','maxDate'));
    }
    public function tambahFoto($id){
        $kemajuan = KemajuanProyek::find($id);
        $idPelaksanaan = $kemajuan->pelaksanaan_id;
        $pelaksanaan = Pelaksanaan::find($idPelaksanaan);
        //dd($pelaksanaan);
        $foto = DB::table('listphoto')->where('kemajuan_id',$id)->get();

        return view('tambahFoto',compact('kemajuan','pelaksanaan','foto'));
    }
    public function simpanFoto($id,Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|image'
        ]);
        if ($request->file != null) {
            foreach($request->file as $file) {
                $uploadedFile = $file;
                //dd($uploadedFile);   
                $path = $uploadedFile->storeAs('upload',$file->getClientOriginalName());
                //dd($path);
                $publicPath = \Storage::url($path);
                //dd($publicPath);
    
                DB::table('listphoto')->insert([
                    'ext' => $uploadedFile->getClientOriginalExtension(),
                    'path' => $publicPath,
                    'kemajuan_id' => $id,
                    'created_at' => now('GMT+7'),
                    'updated_at' => now('GMT+7')
                ]);
            }
        }
        return redirect()->action('KemajuanProyekController@detailInfo',['id'=>$id]);
    }
    /*
    @param \Illuminate\Http\Request
    @return \Illuminate\Http\Response
    */
    public function simpanInformasi($id, Request $request){
        $proyekId = $id;
        //Bulan awal
        $pelaksanaan = Pelaksanaan::where([['proyek_id','=',$proyekId]])->first();
        if ($pelaksanaan == null) {
            $firstDate = $request->reportdate;
            //dd($firstDate);
            $firstMonth = date('m', strtotime($firstDate));
            $firstYear = date('Y', strtotime($firstDate));
        }
        else {
            $sameIdPelaksanaan = Pelaksanaan::where([['proyek_id','=',$proyekId]])->get();
            if(sizeof($sameIdPelaksanaan)==1) {
                $firstJob = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.reportDate')->where('pelaksanaan_id',json_decode($sameIdPelaksanaan)[0]->id)->get();
                if($firstJob->isempty()) {
                    $firstMonth = date('m', strtotime($request->reportdate));
                    $firstYear = date('Y', strtotime($request->reportdate));
                }
                else {
                    $firstDate = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.reportDate')->whereIn('pelaksanaan_id',$sameIdPelaksanaan)->min('reportDate');
                    $firstMonth = date('m', strtotime($firstDate));
                    $firstYear = date('Y', strtotime($firstDate));
                }
            }
            else {
                $firstDate = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.reportDate')->whereIn('pelaksanaan_id',$sameIdPelaksanaan)->min('reportDate');
                $firstMonth = date('m', strtotime($firstDate));
                $firstYear = date('Y', strtotime($firstDate));
            }
        }
        
        //Bulan dari Form
        $inputMonth = date('m', strtotime($request->reportdate));
        $inputYear = date('Y', strtotime($request->reportdate));
        //Konversi Bulan
        $yearGap = $inputYear - $firstYear;
        if ($yearGap == 0) {
            $adjustedMonth = ($inputMonth - $firstMonth) + 1; 
        }
        else if ($yearGap > 0) {
            if ($inputMonth == $firstMonth) {
                $adjustedMonth = ($yearGap * 12) + 1;
            }
            else if ($inputMonth > $firstMonth) {
                $adjustedMonth = ($yearGap * 12) + ($inputMonth-$firstMonth) + 1;
            }
            else if ($inputMonth < $firstMonth) {
                $adjustedMonth = ($yearGap * 12) - ($firstMonth-$inputMonth) + 1;
            }
        }
        //dd($adjustedMonth);

        $pelaksanaan = Pelaksanaan::where([['proyek_id','=',$proyekId],['approvalStatus','!=',1],['bulan','=',$adjustedMonth]])->first();

        //Bikin LAPJUSIK baru
        if($pelaksanaan == null) {
            DB::table('pelaksanaans')->insert([
                'approvalStatus' => 0,
                'flag' => 1,
                'createdDate' => now('GMT+7'),
                'bulan'=> $adjustedMonth,
                'proyek_id' => $proyekId,
                'created_at' => now('GMT+7'),
                'updated_at' => now('GMT+7')
            ]);
            $pelaksanaan = Pelaksanaan::where([['proyek_id','=',$proyekId],['approvalStatus','=',0],['bulan','=',$adjustedMonth]])->first();
        }
        $validator = Validator::make($request->all(),[
            'tipepekerjaan' => 'required',
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
            'pekerjaan_id' => $request->tipepekerjaan,
            'pelaksanaan_id' => $pelaksanaan->id,
            'created_at' => now('GMT+7'),
            'updated_at' => now('GMT+7')
        ]);

        $realValue = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.value')->where('pekerjaan_id',$request->tipepekerjaan)->get();
        //dd(json_decode($realValue));
        $combinedValue = 0;
        foreach($realValue as $value) {
            $combinedValue += $value->value;
        }

        DB::table('jenis_pekerjaan')->where('id',$request->tipepekerjaan)->update([
            'workCurrentValue' => $combinedValue
        ]);

        $kemajuans = KemajuanProyek::select('kemajuan_proyeks.*')->where('pelaksanaan_id', $pelaksanaan->id)->get()->last();
        $kemajuan_id = $kemajuans->id;
        if ($request->file != null) {
            foreach($request->file as $file) {
                $uploadedFile = $file;
                $path = $uploadedFile->storeAs('upload',$file->getClientOriginalName());
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
        return redirect()->action('KemajuanProyekController@viewInfo',['id'=>$proyekId]);
    }
    public function editInformasi($id){
        $idPelaksanaan = KemajuanProyek::select('kemajuan_proyeks.pelaksanaan_id')->where('id',$id)->get();
        $idProyek = Pelaksanaan::select('pelaksanaans.proyek_id')->whereIn('id',$idPelaksanaan)->get();
        $proyek = Proyek::find($idProyek[0]->proyek_id);
        $kemajuans = KemajuanProyek::find($id);
        $editedPekerjaan = array(1);
        $editedPekerjaan[0] = $kemajuans->pekerjaan_id;
        $pekerjaan = DB::table('jenis_pekerjaan')->where('proyek_id',$idProyek[0]->proyek_id)->get();
        foreach($pekerjaan as $satuanPekerjaan) {
            if ($satuanPekerjaan->id == $editedPekerjaan[0]) {
                $finalPekerjaan = $satuanPekerjaan;
            }
        }
        $allPelaksanaan = Pelaksanaan::where([['proyek_id','=',$idProyek[0]->proyek_id]])->get();
        $maxDate = date('Y-m-d');
        $allApproved = true;
        $bladePekerjaan = DB::table('jenis_pekerjaan')->where('proyek_id',$idProyek[0]->proyek_id)->whereNotIn('id',$editedPekerjaan)->get();
        $foto = DB::table('listphoto')->select('listphoto.*')->where('kemajuan_id',$id)->get();

        if($allPelaksanaan->isempty()) {
            $minDate = Proyek::select('proyeks.created_at')->where('id',$proyekId)->first()->created_at->format('Y-m-d');
        }

        else {
            foreach($allPelaksanaan as $pelaksanaan) {
                if ($pelaksanaan->approvalStatus == 0 || $pelaksanaan->approvalStatus==2) {
                    $allApproved = false;
                    if($pelaksanaan->bulan == 1) {
                        $minDate = "$pelaksanaan->createdDate";
                    }
                    else {
                        $requestedMonth = date('m', strtotime($pelaksanaan->createdDate));
                        $requestedYear = date('Y', strtotime($pelaksanaan->createdDate));
                        $minDate = "$requestedYear-$requestedMonth-01";
                            
                    }
                }   
            }
            if($allApproved=true) {
                if(sizeof($allPelaksanaan) == 1) {
                    $minDate = json_decode($allPelaksanaan[0])->createdDate;
                }
                else {
                    $requestedMonth = date('m', strtotime($maxDate));
                    $requestedYear = date('Y', strtotime($maxDate));
                    $minDate = "$requestedYear-$requestedMonth-01"; 
                }
            }
        }
        return view('editInformasi', compact('kemajuans','proyek','foto','finalPekerjaan','bladePekerjaan','minDate','maxDate'));
    }
    public function updateInformasi($id, Request $request){
        //dd($request->listId);
        if ($request->listId!=null) {

            $allId = DB::table('listphoto')->select('listphoto.id')->where('kemajuan_id',$id)->whereNotIn('id',$request->listId)->get();
            //dd($allId);
            $deletedId = json_decode($allId);
            //dd($deletedId);
            for($i=0;$i<sizeof($allId);$i++) {

                DB::table('listphoto')->where('id',$deletedId[$i]->id)->delete();
            }
        }
        else {
            $allId = DB::table('listphoto')->select('listphoto.id')->where('kemajuan_id',$id)->get();
            $deletedId = json_decode($allId);
            //dd($deletedId);
            for($i=0;$i<sizeof($allId);$i++) {

                DB::table('listphoto')->where('id',$deletedId[$i]->id)->delete();
            }
        }
        //dd($deletedId[0]->id);
        $idPelaksanaan = KemajuanProyek::select('kemajuan_proyeks.pelaksanaan_id')->where('id',$id)->get();
        $idProyek = Pelaksanaan::select('pelaksanaans.proyek_id')->whereIn('id',$idPelaksanaan)->get();
        $data = json_decode($idProyek);
        $validator = Validator::make($request->all(),[
            'reportDate' => 'required',
            'tipeKemajuan' => 'required',
            'value' => 'required',
            'pelaksanaan_id' => 'required',
            'file' => 'required|image'
    	]);
        $kemajuans = KemajuanProyek::find($id);
        //dd($kemajuans);
        $kemajuans->pekerjaan_id = $request->tipepekerjaan;
        $kemajuans->description = $request->description;
        $kemajuans->reportDate = $request->reportdate;
        $kemajuans->value = $request->nilai;
        $kemajuans->tipeKemajuan = $request->tipekemajuan;
        $kemajuans->save();
        //dd($kemajuans->pekerjaan_id);

        $realValue = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.value')->where('pekerjaan_id',$kemajuans->pekerjaan_id)->get();
        //dd(json_decode($realValue));
        $combinedValue = 0;
        foreach($realValue as $value) {
            $combinedValue += $value->value;
        }

        DB::table('jenis_pekerjaan')->where('id',$kemajuans->pekerjaan_id)->update([
            'workCurrentValue' => $combinedValue
        ]);

        return redirect()->action('KemajuanProyekController@viewInfo',['id'=>$data[0]->proyek_id]);
    }
    public function hapusInformasi($id){
        $idPelaksanaan = KemajuanProyek::select('kemajuan_proyeks.pelaksanaan_id')->where('id',$id)->get();
        $idProyek = Pelaksanaan::select('pelaksanaans.proyek_id')->whereIn('id',$idPelaksanaan)->get();
        $data = json_decode($idProyek);
        $kemajuans = KemajuanProyek::find($id);
        //dd($kemajuans->pekerjaan_id);
        $kemajuans->delete();

        $realValue = DB::table('kemajuan_proyeks')->select('kemajuan_proyeks.value')->where('pekerjaan_id',$kemajuans->pekerjaan_id)->get();
        //dd(json_decode($realValue));
        $combinedValue = 0;
        foreach($realValue as $value) {
            //dd($value->value);
            $combinedValue += $value->value;
        }
        //dd($combinedValue);
        DB::table('jenis_pekerjaan')->where('id',$kemajuans->pekerjaan_id)->update([
            'workCurrentValue' => $combinedValue
        ]);

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