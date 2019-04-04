<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kontrak;
use Illuminate\Support\Facades\DB;

class KontrakController extends Controller
{
    //
    public function viewKontrak($id){
        $kontrak = DB::table('kontraks')->select('*')->get();
        return view('viewKontrak', compact('kontrak'));
    }
}
