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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->role == 3){
            // $proyek = DB::table('proyeks')->orderBy('created_at','desc')->get();
            $status;
            $proyekPoten = DB::table('proyeks')->orderBy('created_at','desc')->where('approvalStatus',0)->get();
            $proyekNonPoten = DB::table('proyeks')->orderBy('created_at','desc')->where('approvalStatus', 1)->orWhere('approvalStatus',2)->orWhere('approvalStatus',3)->get();
            
            foreach($proyekPoten as $proyeg){
                $statusNum = $proyeg-> approvalStatus;

                if($statusNum == 0){
                    $status = "MENUNGGU PERSETUJUAN";
                }
            }
            foreach($proyekNonPoten as $proyeg){

                $statusNum = $proyeg-> approvalStatus;
                $temp = explode(" ",$proyeg->created_at)[0];
                $date = $this->waktu($temp);
                $proyeg->created_at = $date;

                if($statusNum == 1){
                    $status = "DISETUJUI";
                }elseif($statusNum == 2){
                    $status = "SEDANG BERJALAN";
                }else{
                    $status = "DITOLAK";
                }
            }
        
            return view('proyeks.index',compact('proyekPoten', 'proyekNonPoten', 'status'));
        }
        elseif(\Auth::user()->role == 5){
            $proyekPoten = DB::table('proyeks')->orderBy('created_at','desc')->where('approvalStatus', 1)->get();
            return view('proyeks.index',compact('proyekPoten'));
        }
        
        elseif(\Auth::user()->role == 2){
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
            return view('proyeks.index', compact('proyekPoten','proyekNonPoten'));
        }
        else{
            return view('no-access');
        }
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proyeks.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
		    'projectName' => 'required',
		    'companyName' => 'required',
            'description' => 'required',
            'projectValue' => 'required|integer',
            'estimatedTime' => 'required|integer|min:1',
            'projectAddress' => 'required'
        ]);   
        // return $request->all();
        
        if($validator->fails()) {
            session()->flash('error', 'Ada kesalahan input');
            return redirect('/proyek/tambah')
                ->withErrors($validator)
                ->withInput();
        //    return $request->all();
        } else {
            DB::table('proyeks')->insert([
                'name' => $request->name,
                'projectName' => $request->projectName,
                'companyName' => $request->companyName,
                'startDate' => '2019-01-01',
                'endDate' => '2019-01-01',
                'description' => $request->description,
                'projectValue' => $request->projectValue,
                'estimatedTime' => $request->estimatedTime,
                'projectAddress' => $request->projectAddress,
                'approvalStatus' => 0,
                'isLPJExist'=>0,
                'pengguna_id'=> \Auth::user()->id,
                'created_at' => now('GMT+7'),
                'updated_at' => now('GMT+7'),
            ]); 
            session()->flash('flash_message', 'Proyek telah ditambahkan.');
            return redirect('/proyek');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyeks = DB::table('proyeks') -> where('id', $id) -> get();
        $status;
        
        foreach($proyeks as $proyeg){
            $statusNum = $proyeg-> approvalStatus;
            $temp = number_format($proyeg->projectValue, 2, ',','.');
            $proyeg->projectValue = $temp;
            if($statusNum == 0){
                $status = "MENUNGGU PERSETUJUAN";
            }
            elseif($statusNum == 1){
                $status = "DISETUJUI";
            }
            elseif($statusNum == 2){
                $status = "SEDANG BERJALAN";
            }
            elseif($statusNum == 3){
                $status = "DITOLAK";
            }
        }        
        return view('proyeks/show',compact('id', 'proyeks', 'status'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $proyeks = DB::table('proyeks')->where('id',$id)->get();
  
	    // passing data pegawai yang didapat ke view edit.blade.php
	    return view('proyeks/edit',["id" => $id, "proyeks" => $proyeks]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
		    'projectName' => 'required',
		    'companyName' => 'required',
            'description' => 'required',
            'projectValue' => 'required|integer',
            'estimatedTime' => 'required|integer|min:1',
            'projectAddress' => 'required'
        ]);   
        // return $request->all();
        
        if($validator->fails()) {
            session()->flash('error', 'Ada kesalahan input');
            return redirect('/proyek/ubah/$request->id')
                ->withErrors($validator)
                ->withInput();
        //    return $request->all();
        } else {
            DB::table('proyeks')->where('id',$request->id)->update([
                'name' => $request->name,
                'projectName' => $request->projectName,
                'companyName' => $request->companyName,
                'startDate' => '2019-01-01',
                'endDate' => '2019-01-01',
                'description' => $request->description,
                'projectValue' => $request->projectValue,
                'estimatedTime' => $request->estimatedTime,
                'projectAddress' => $request->projectAddress,
                'approvalStatus' => 0,
                'isLPJExist'=>0,
                'pengguna_id'=>\Auth::user()->id,
                'updated_at' => now('GMT+7'),
            ]); 
            session()->flash('flash_message', 'Data proyek telah diubah.');
            return redirect('/proyek');
        }
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // menghapus data [proyek] berdasarkan id yang dipilih
	    DB::table('proyeks')->where('id',$id)->delete();
		
	    // alihkan halaman ke halaman proyek
	    return redirect()->back()->with('flash_message', 'Proyek telah dihapus.');
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


    /**
     * punya jekiiiii
     */
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
    
    
}
