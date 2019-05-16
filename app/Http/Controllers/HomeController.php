<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Validation\Rule;
use Redirect;
use App\Assignment;
use App\Proyek;


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
        elseif(\Auth::user()->role == 7){
            $idProyek = Assignment::select('assignments.proyek_id')->where('pengguna_id',\Auth::user()->id)->get();
            $listProyek = Proyek::select('proyeks.*')->whereIn('id',$idProyek)->get(); 
            return view('listProyek', compact('listProyek'));
        }
        return redirect('/proyek');
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
            return Redirect::to('/user/lihat/'. $request->id)
                ->withErrors($validator)
                ->withInput();
        
        } else {
            $data = \DB::table('users')->where('id',$request->id);
            $pass = \DB::table('users')->select('users.password')->where('id',$request->id)->get();
            
            if($request->password == $pass[0]->password){
                $data->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => $pass[0]->password,
                    'role' => $request->role,
                    'updated_at' => now('GMT+7'),
                ]);
            }
            else{
                $data->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role' => $request->role,
                    'updated_at' => now('GMT+7'),
                ]);
            }
            return redirect('/');
        }
    }
    public function delete($id){
        $data = \DB::table('users')->where('id',$id)->update([
            'status' => 1,
            ]);
        return redirect('/');
    }
    public function unlock($id){
        $data = \DB::table('users')->where('id',$id)->update([
            'status' => 0,
            ]);
        return redirect('/');
    }
}
