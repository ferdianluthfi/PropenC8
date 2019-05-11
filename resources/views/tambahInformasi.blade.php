@extends('layouts.layout')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
@section ('content')
@include('layouts.nav')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('assignedproyek') }}">Daftar Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active">Tambah Informasi Proyek</a></li>
  </ol>
</nav>
            <div class="container" nonvalidate="nonvalidate" id="jqueryvalidation">

                @if(session()->has('flash_message'))
                    <p>{{session('flash_message')}}</p>
                @endif


                <form method="post" action="/info/submit" id="addForm" enctype="multipart/form-data">
                <h2 style="text-align:center;">Tambah Informasi Proyek</h2> <br>
                    {{ csrf_field() }}

                    <div class="content bg1">
                        <span class="labels">Uraian Pekerjaan</span>
                        <select name="tipepekerjaan" class="content bg1">
                            @foreach($pekerjaan as $tipe)
                                <option value="{{$tipe->id}}" >{{$tipe->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="content bg1">
                        <span class="labels">Deskripsi Tambahan</span>
                        <input type="text" name="description" class="inputs" placeholder="Masukkan Deskripsi Kemajuan Tambahan" data-error=".errorDescription">
                        <div class="errorMessage errorDescription"></div>
                    </div>
    
                    <div class="content bg1">
                        <span class="labels">Tanggal Informasi</span>
                        <input type="date" name="reportdate" min="<?php echo $minDate ?>" class="inputs" data-error=".errorDate">
                        <div class="errorMessage errorDate"></div>
                    </div>

                    <div class="content bg1">
                        <span class="labels">Jenis Informasi</span>
                        <select name="tipekemajuan" class="content bg1">
                            <option value="1" >Gaji</option>
                            <option value="2" >Belanja</option>
                            <option value="3" >Administrasi</option>
                        </select>
                    </div>

                    <div class="content bg1">
                        <span class="labels">Nilai Kemajuan</span>
                            <input type="number" name="nilai" class="inputs" placeholder="Rp xxx.xxx.xxx" data-error=".errorVal">
                            <div class="errorMessage errorVal"></div>
                    </div>

                    <div class="form-group {{ !$errors->has('file') ?: 'has-error' }}">
                        <label>Foto</label>

                        <table class="table table-bordered" id="dynamic_field">  
                            <tr>  
                                <td><input type="file" name="file[]" class="help-block text-danger"> {{ $errors->first('file') }}</td>  
                                <td><button type="button" name="add" id="add" class="btn btn-success">Tambah Foto Lain</button></td>  
                            </tr>  
                        </table>  

                    </div>

                    <br>

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
                    <a href="/informasi/{{$proyekId}}" class="btn btn-default" style="color:red;">Iya</a>
                    <a href="/info/tambah" class="btn btn-primary ">Tidak</a>
                </div>
            </div>
            </div>
	    </div>

        <div id="myMod" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">				
                        <h4 class="modal-title" style="text-align:center;">Sukses!</h4>	
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Proyek berhasil disimpan</p>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
        <script>

        $( document ).ready(function() {

            var postURL = "<?php echo url('addmore'); ?>";
            console.log(postURL);
            var i=1;  

            $('#add').click(function(){  
                i++;  
                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="file[]" class="help-block text-danger"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
            });  

            $(document).on('click', '.btn_remove', function(){  
                var button_id = $(this).attr("id");   
                $('#row'+button_id+'').remove();  
            });  


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $(".print-success-msg").css('display','none');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }

            $("#addForm").validate({
                rules:{
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
                    reportdate:{
                        required: "Tanggal kemajuan harus diisi",
                    },
                    tipekemajuan:{
                        required: "Tipe info harus diisi",
                    },
                    nilai:{
                        required: "Value kemajuan harus diisi",
                        min: "Value kemajuan minimal sebesar 1",
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
                if($('#addForm').valid()){ //checks if it's valid
            //horray it's valid
                $("#myMod").modal("show");
                };
            });
            $("#OK").click(function(e){
            $('#addForm').submit();
            });
        });
        </script>
    </body>
@endsection