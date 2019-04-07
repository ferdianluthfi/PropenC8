    @extends('layouts.layout')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TRAYEK</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>


    @section ('content')
    @include('layouts.nav')
	
        <div class="container container-basic" nonvalidate="nonvalidate" id="jqueryvalidation">

            @if(session()->has('flash_message'))
                <p>{{session('flash_message')}}</p>
            @endif

            <h2 style="text-align:center;">Ubah Informasi Proyek</h2> <br>

            <nav aria-label="breadcrumb" style="margin-left:10px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('assignedproyek') }}">Proyek</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/proyek/detail/{{$proyek->id}}'>Detail Proyek</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/informasi/{{$proyek->id}}'>Informasi Kemajuan</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/informasi/detail/{{$kemajuans->id}}'>Detail Kemajuan</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href='/info/edit/{{$kemajuans->id}}'>Ubah Kemajuan</a></li>
                </ol>
            </nav>

            <form method="post" action="/info/update/{{$kemajuans->id}}" id="editForm">

                {{ csrf_field() }}
                {{ method_field('POST') }}

                <div class="content bg1">
                    <span class="labels">Deskripsi</span>
                    <textarea class="inputs" type="text" name="description" style="height:150px" data-error=".errorDescription"> {{ $kemajuans->description }} </textarea>
                    <div class="errorMessage errorDescription"></div>
                </div>

                <div class="content bg1">
                    <span class="labels">Tanggal Informasi</span>
                    <input type="date" name="reportdate" class="inputs" value="{{ $kemajuans->reportDate }}" data-error=".errorDate">
                    <div class="errorMessage errorDate"></div>
                </div>

                <div class="content bg1">
                    <span class="labels">Jenis Informasi</span>
                    @if($kemajuans->tipeKemajuan==1)
                        <select name="tipekemajuan" class="content bg1">
                            <option value="1" >Gaji</option>
                            <option value="2" >Belanja</option>
                            <option value="3" >Administrasi</option>
                        </select>
                    @elseif($kemajuans->tipeKemajuan==2)
                        <select name="tipekemajuan" class="content bg1">
                            <option value="2" >Belanja</option>
                            <option value="1" >Gaji</option>
                            <option value="3" >Administrasi</option>
                        </select>
                    @elseif($kemajuans->tipeKemajuan==3)
                        <select name="tipekemajuan" class="content bg1">
                            <option value="3" >Administrasi</option>
                            <option value="1" >Gaji</option>
                            <option value="2" >Belanja</option>
                        </select>
                    @endif
                </div>

                <div class="content bg1">
                    <span class="labels">Nilai</span>
                        <input type="number" name="nilai" class="inputs" value="{{$kemajuans->value}}" data-error=".errorVal">
                        <div class="errorMessage errorVal"></div>
                </div>
                <br>

                <div class="form-group {{ !$errors->has('file') ?: 'has-error' }}">
                    <label>Foto</label>

                    <table class="table table-bordered" id="dynamic_field">  
                        <tr> 
                            @foreach($daftarFoto as $foto)
                                <img src=<?php echo $foto->path ?> >
                                <td><input type="file" name="file[]" class="help-block text-danger" value="{{$foto->path}}"> {{ $errors->first('file') }}</td>
                                <td><button type="button" name="add" id="add" class="btn btn-success">Tambah Foto Lain</button></td>
                            @endforeach  
                        </tr>  
                    </table>  

                </div>

                <div class="container1-btn">
                    <a class="container1-form-btn" data-toggle="modal" data-target="#myModal">
                        <span>
                            Batal
                            <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                        </span>
                    </a>
                </div>

                <div class="container-btn">
                    <button class="container-form-btn" id="simpan">
                            <span>
                                Simpan
                                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                            </span>
                    </button>
                </div>

            </form>
        </div>
        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Batalkan Proses?</h4>
                </div>
                <div class="modal-body" style="text-align:center;">
                    <p>Jika proses dibatalkan, perubahan tidak akan disimpan.</p>
                </div>
                <div class="modal-footer">
                    <a href="/proyek/" class="btn btn-default" style="color:red;">Iya</a>
                    <a href="/info/edit/{{$kemajuans->id}}" class="btn btn-primary ">Tidak</a>
                </div>
            </div>
            </div>
	    </div>

        <div class="modal fade" id="myMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">				
                        <h4 class="modal-title" style="text-align:center;">Sukses!</h4>	
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-center">Informasi berhasil diubah</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script>

        $( document ).ready(function() {
            $("#editForm").validate({
                rules:{
                    description:{
                        required: true,
                    },
                    reportdate:{
                        required: true,
                    },
                    tipekemajuan:{
                        required: true,
                    },
                    nilai:{
                        required: true,
                        digits: true,
                        min: 1,
                    },
                },
                //For custom messages
                messages:{
                    description:{
                        required: "Deskripsi proyek harus diisi",
                    },
                    reportdate:{
                        required: "Tanggal harus diisi",
                    },
                    tipekemajuan:{
                        required: "Tipe info harus diisi",
                    },
                    nilai:{
                        required: "Value proyek harus diisi",
                        digits: "Value harus berupa angka",
                        min: "Value minimal 1",  //ceklg
                    },
                }, 
                errorElement:'div',
                errorPlacement:function(error,element){
                    var placement = $(element).data('error');
                    if(placement){
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                }
            })
            $("#simpan").click(function(e){
                e.preventDefault();
                if($('#editForm').valid()){ //checks if it's valid
            //horray it's valid
                $("#myMod").modal("show");
                };
            });
            $("#OK").click(function(e){
            $('#editForm').submit();
            });
        });
        </script>
        @endsection
</html>