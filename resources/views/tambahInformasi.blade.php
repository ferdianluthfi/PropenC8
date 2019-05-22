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

    <style>
        .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
        }

        /* Tooltip text */
        .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: #555;
        color: #fff;
        text-align: center;
        padding: 5px 0;
        border-radius: 6px;

        /* Position the tooltip text */
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -60px;

        /* Fade in tooltip */
        opacity: 0;
        transition: opacity 0.3s;
        }

        /* Tooltip arrow */
        .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
        }
    </style>
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


                <form method="post" action="/info/submit/{{$proyekId}}" id="addForm" enctype="multipart/form-data" style="background-color:#fff">
                <p class="font-title" style="text-align:center;margin-top:-35px;">Tambah Informasi Proyek</p> <br>
                    {{ csrf_field() }}

                    <?php $strJenis = "Kategori dari pekerjaan yang dilakukan dalam sebuah proyek. Jenis pekerjaan terbagi menjadi 3 jenis yaitu Gaji, Belanja dan Administrasi."?>
                    <?php $strUraian = "???"?>
                    <?php $strDeskripsi = "Deskripsi lanjutan yang dapat diberikan untuk memperjelas sebuah informasi kemajuan. Contoh: Lantai 1, Lantai 2, dst."?>
                    <?php $strTanggal = "Tanggal dimana suatu kemajuan proyek terlaksana."?>
                    <?php $strNominal = "Total biaya yang dikeluarkan perusahaan untuk pengerjaan suatu kemajuan proyek."?>
                    <?php $strFoto = "Daftar foto pendukung yang berfungsi sebagai bukti kemajuan pada suatu proyek."?>

                    <div class="content bg1">
                        <span class="labels font-subtitle-5" href="#" data-toggle="tooltip" title="<?php echo $strJenis ?>" data-placement="right">Jenis Informasi</span>
                        <select name="tipekemajuan" class="content bg1" style="background-color:white">
                            <option value="1" >Gaji</option>
                            <option value="2" >Belanja</option>
                            <option value="3" >Administrasi</option>
                        </select>
                    </div>


                    <div class="content bg1">
                        <span class="labels font-subtitle-5" href="#" data-toggle="tooltip" title="<?php echo $strUraian ?>" data-placement="right">Uraian Pekerjaan</span>
                        <select name="tipepekerjaan" class="content bg1" style="background-color:white">
                            @foreach($pekerjaan as $tipe)
                                <option value="{{$tipe->id}}">{{$tipe->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="content bg1">
                        <span class="labels font-subtitle-5" href="#" data-toggle="tooltip" title="<?php echo $strDeskripsi ?>" data-placement="right">Deskripsi Tambahan</span>
                        <input type="text" name="description" class="inputs" placeholder="Masukkan Deskripsi Kemajuan Tambahan" data-error=".errorDescription">
                        <div class="errorMessage errorDescription"></div>
                    </div>
    
                    <div class="content bg1">
                        <span class="labels font-subtitle-5" href="#" data-toggle="tooltip" title="<?php echo $strTanggal ?>" data-placement="right">Tanggal Informasi</span>
                        <input type="date" name="reportdate" min="<?php echo $minDate ?>" max = "<?php echo $maxDate ?>" class="inputs" data-error=".errorDate" >
                        <div class="errorMessage errorDate"></div>
                    </div>

                    <div class="content bg1">
                        <span class="labels font-subtitle-5" href="#" data-toggle="tooltip" title="<?php echo $strNominal ?>" data-placement="right">Nominal</span>
                            <input type="number" name="nilai" class="inputs" placeholder="Rp xxx.xxx.xxx" data-error=".errorVal">
                            <div class="errorMessage errorVal"></div>
                    </div>

                    <div class="form-group {{ !$errors->has('file') ?: 'has-error' }} content bg1">
                        <span class="labels font-subtitle-5" href="#" data-toggle="tooltip" title="<?php echo $strFoto ?>" data-placement="right">Foto</span>

                        <table class="table table-borderless" id="dynamic_field">  
                            <tr>  
                                <td><input type="file" name="file[]" class="help-block text-danger"> {{ $errors->first('file') }}</td>  
                                <td><button type="button" name="add" id="add" class="btn" style="background-color:#3378D3;color:white;margin-right:-100px">Tambah Foto Lain</button></td>  
                            </tr>  
                        </table>  

                    </div>

                    <br>

                    <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-2">
                                    <button class="button-disapprove font-approval" data-toggle="modal" data-target="#myModal">
                                        <span>
                                            BATAL
                                        </span>
                                    </button>
                            </div>
                            <div class="col-sm-2">
                                    <button class="button-approve font-approval" id="simpan">
                                            <span>
                                                SIMPAN
                                            </span>
                                    </button>
                            </div>
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
                    <center><a href="" class="btn btn-primary ">Tidak</a>
                    <a href="/informasi/{{$proyekId}}" class="btn btn-default" style="color:red;">Iya</a></center>
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
            $('[data-toggle="tooltip"]').tooltip();
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
