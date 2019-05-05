<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Validation\Rule;


class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(\Auth::user()->role == 1){
            $users = User::select('users.*')->get();
            return view('users.homeAccountManager', compact('users'));
        }
        return view('home');
    }


    public function home(){
        $users = User::select('users.*')->get();
        
        return view('users.homeAccountManager', compact('users'));
    }

    public function edit($id)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $users = \DB::table('users')->where('id',$id)->get();
  
	    // passing data pegawai yang didapat ke view edit.blade.php
	    return view('users/show',["id" => $id, "users" => $users]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'max:20', Rule::unique('users')->ignore($request->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($validator->fails()) {
            session()->flash('error', 'Ada kesalahan input');
            return redirect("'/user/lihat/' $request->id")
                ->withErrors($validator)
                ->withInput();
        
        } else {
            \DB::table('users')->where('id',$request->id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                'updated_at' => now('GMT+7'),
            ]); 
            return redirect('/homeAccountManager');
        }
    }
}
