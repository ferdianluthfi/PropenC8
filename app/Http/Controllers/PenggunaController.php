<?php
namespace App\Http\Controllers;
use App\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Users;
use App\Assignment;
use App\TipePekerjaan;
class PenggunaController extends Controller
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
    /*
     * ini buat get all pm available, halaman kelola pm
     * id, nama, jumlah proyek, kelola
     * brrti hubungan q sm assignment aja
     * 1. get all pm
     * 2. get all assignment
     * 3. udh atur2 di frontend aja wkwk
     */
    public function getAvailablePm($proyek_id)//masukin id proyek lewat sini, $proyek_id dr page yg si detail proyek
    {
//        $proyek_id = 2; // nanti integrasi id proyek
        $assign = DB::table('assignments')->get();
        $pmgrs = DB::table('users')->where('role', 7)->get();
        $choosenPmId = 0;
        if //kalo ada assignment
        (Assignment::where('proyek_id', '=', $proyek_id)->exists()) {
            $choosenPmFromAssignment = DB::table('assignments')->where('proyek_id', $proyek_id)->first();//not the best way to get pm id
            $choosenPmId = $choosenPmFromAssignment->pengguna_id;
        }
        $pm_proyek = DB::table('assignments')
            ->groupBy('pengguna_id')
            ->selectRaw('count(proyek_id) as total, pengguna_id')->get();

        $pmlist = DB::select('SELECT u.id, u.name, COALESCE(count(a.proyek_id),0) as total FROM users u left join assignments a on u.id = a.pengguna_id where u.role = 7 group by u.id,u.name');
        return view('kelolaPm',compact('assign', 'pmgrs', 'choosenPmId', 'proyek_id', 'pm_proyek','pmlist' ));
    }
    /*
     * ini buat ganti2 pm, redirect detail proyek
     */
    public function managePm(Request $request)
    {

//        dd($request->desc);
//        $proyek_id = 1;
        $proyek_id = $request->proyek_id;
        $pengguna_id = $request->pengguna_id;
        $proyek = DB::table('proyeks')->where('id',$proyek_id)->first();

        $validator = Validator::make($request->all(), [
            'selected' => 'required',
//            'desc[]' => 'required',
//            'num[]' => 'required'
        ]);
        if($validator->fails()) {
            session()->flash('error', 'PM harus diisi');
            return redirect('/pm/kelola/'.$proyek_id) //GANTI REDIRECT KE HALAMAN DETAIL PROYEK
            ->withErrors($validator)
                ->withInput();
            //    return $request->all();
        } else {

//            $assignment = Assignment::where('proyek_id', '=', $proyek_id);
//            if ($assignment->pengguna_id)

            //new add pm
            if ((Assignment::where('proyek_id', '=', $proyek_id)) && ($pengguna_id == 0))
            {
                DB::table('assignments')->where('proyek_id',$proyek_id)->update([
                    'pengguna_id' => $request->selected
                ]);
                DB::table('proyeks')->where('id',$proyek_id)->update([
                    'approvalStatus' => 7,
                ]);
//                if (($request->desc != null) && ($request->num != null)){
//                    $des = $request->desc;
//                    $nominal = $request->num;
//                    for($i = 0; $i < sizeOf($des); $i++){
//                        $descObj = $des[$i];
//                        $nomObj = $nominal[$i];
//                        $val = $proyek->projectValue;
//                        DB::table('jenis_pekerjaan')->insert([
//                            'name' => $descObj,
//                            'workTotalValue' => $nomObj,
//                            'weightPercentage' => $nomObj/$val,
//                            'workCurrentValue' => 0,
//                            'proyek_id' => $proyek_id
//                        ]);
////                        dd($nomObj/$val);
//                    }
//                }
            }

//            new edit pm
            else {
                DB::table('assignments')->where('proyek_id', $proyek_id)->update([
                    'pengguna_id' => $request->selected
                ]);
            }

            session()->flash('flash_message', 'PM telah ditambahkan.');
            return redirect('/proyek/lihat/'. $proyek_id); //GANTI REDIRECT KE HALAMAN DETAIL PROYEK
        }
    }
}
