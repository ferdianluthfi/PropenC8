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
    public function getAvailablePm()
    {
        $assign = DB::table('assignments')->get();
//        $pmgrs = User::select('users.*')->where ('role', 7) ->get();
        $pmgrs = DB::table('users')->where('role', 7)->get();

        return view('kelolaPm',compact('assign', 'pmgrs'));

    }

    /*
     * ini buat ganti2 pm, redirect detail proyek
     */
    public function managePm()
    {

    }
}
