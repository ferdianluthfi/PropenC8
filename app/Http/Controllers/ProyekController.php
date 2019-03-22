<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'Nama Staf Marketing' => 'required',
            'Nama Proyek' => 'required',
            'Nama Perusahaan' => 'required',
            'Alamat Proyek' => 'required',
            'Deskripsi Proyek' => 'required',
            'Nilai Proyek' => 'required',
        ]);

        $proyek = new Proyek;

       // $proyek->title = $request->title; contohnyaa

       $proyek->save();

       return redirect()->route('proyeks.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyek = DB::table('proyeks')
                -> where('proyeks.blablabla', '=', $id)
                //sama
                ->first();
        return view('proyeks.show')
            ->with('proyek' => $proyek);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama Staf Marketing' => 'required',
            'Nama Proyek' => 'required',
            'Nama Perusahaan' => 'required',
            'Alamat Proyek' => 'required',
            'Deskripsi Proyek' => 'required',
            'Nilai Proyek' => 'required',
        ]);

        $proyek = Proyek::find(id);


       // $proyek->title = $request->title; contohnyaa

       $proyek->save();

       return redirect()->route('proyeks.index', $proyek->proyek_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = DB:table('proyeks')->where('proyek_id'),$id);

        $post->delete();

        return redirect()->route('proyeks.index');
    }
}
