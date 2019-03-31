<?php

namespace App\Http\Controllers;

// use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyek = DB::table('proyeks')->orderBy('created_at','desc')->get();
        // return $proyek;
        return view('proyeks.index', ['proyek' => $proyek]);
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
            session()->flash('flash_message', 'Ada kesalahan input');
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
                'pengguna_id'=>3,
                'created_at' => now(),
                'updated_at' => now()
            ]); 
            session()->flash('flash_message', 'Proyek berhasil ditambah');
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
        return view('proyeks/show',['proyeks' => $proyeks]);
    
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
        // return $proyeks;
	    // passing data pegawai yang didapat ke view edit.blade.php
	    return view('proyeks/edit',['proyeks' => $proyeks]);
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
            session()->flash('flash_message', 'Ada kesalahan input');
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
                'pengguna_id'=>3,
                'created_at' => now(),
                'updated_at' => now()
            ]); 
            session()->flash('flash_message', 'Proyek telah ditambahkan.');
            return redirect('/proyek');
        }
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
	    return redirect('/proyek');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function datatable()
    // {
    //     $proyek = DB::table('proyeks')->orderBy('created_at','desc')->get();
    //     // return $proyek;
    //     return view('proyeks.index', ['proyek' => $proyek]);
    // }
}
