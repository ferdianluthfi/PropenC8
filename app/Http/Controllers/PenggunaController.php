<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Users;
use App\Assignment;


class PenggunaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /*
     * ini buat get all pm available, halaman kelola pm
     * id, nama, jumlah proyek, kelola
     * brrti hubungan q sm assignment aja
     * 1. get all pm
     * 2. get all assignment
     * 3. udh atur2 di frontend aja wkwk
     */
    public function getAvailablePm()//masukin id proyek lewat sini, $proyek_id dr page yg si detail proyek
    {
        $proyek_id = 2; // nanti integrasi id proyek
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
        

        return view('kelolaPm',compact('assign', 'pmgrs', 'choosenPmId', 'proyek_id', 'pm_proyek' ));

    }

    /*
     * ini buat ganti2 pm, redirect detail proyek
     */
    public function managePm(Request $request)
    {
//        $proyek_id = 1;

        $proyek_id = $request->proyek_id;
        $validator = Validator::make($request->all(), [
            'selected' => 'required',
            ]);

        if($validator->fails()) {
            session()->flash('error', 'PM harus diisi');
            return redirect('/pm/kelola') //GANTI REDIRECT KE HALAMAN DETAIL PROYEK
                ->withErrors($validator)
                ->withInput();
            //    return $request->all();
        } else {
            //edit PM
            if (Assignment::where('proyek_id', '=', $proyek_id)->exists()) {
                DB::table('assignments')->where('proyek_id', $proyek_id)->update([
                    'pengguna_id' => $request->selected
                ]);
            }
            //add PM baru
            else {
                DB::table('assignments')->where('proyek_id', $proyek_id)->insert([
                    'pengguna_id' => $request->selected,
                    'proyek_id' => $proyek_id,
                    'assignmentDate' => DB::raw('now()')
                ]);
            }

            session()->flash('flash_message', 'PM telah ditambahkan.');
            return redirect('/pm/kelola'); //GANTI REDIRECT KE HALAMAN DETAIL PROYEK
        }
    }
}
