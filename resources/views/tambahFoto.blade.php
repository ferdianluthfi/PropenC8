@extends('layouts.layout')

<head>
     <!-- Bootstrap CSS CDN -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
     <!-- Our Custom CSS -->
     <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <style>
    div.gallery {
    border: 1px solid #ccc;
    }
    div.gallery:hover {
    border: 1px solid #777;
    }
    div.gallery img {
    width: 100%;
    height: auto;
    }
    * {
    box-sizing: border-box;
    }
    .responsive {
    padding: 0 6px;
    float: left;
    width: 24.99999%;
    }
    @media only screen and (max-width: 700px) {
    .responsive {
        width: 49.99999%;
        margin: 6px 0;
    }
    }
    @media only screen and (max-width: 500px) {
    .responsive {
        width: 100%;
    }
    }
    </style>
</head>

<body>

@section ('content')
@include('layouts.nav')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('assignedproyek') }}">Daftar Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/informasi/{{$pelaksanaan->proyek_id}}'>Daftar Kemajuan Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/informasi/detail/{{$kemajuan->id}}'>Detail Informasi</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active">Tambah Foto</a></li>
  </ol>
</nav>

<div class="container-fluid card card-kontrak">
    <div class="row judul">
        <p class="font-title" style="text-align:center">Riwayat Foto</p>
    </div>
<hr>
<div class="row" style=" margin: 10px; height:400px;">
    <div class="col-sm-12">
    <div class="your-class">
        @if ($foto != null)
            @foreach ($foto as $fot)
                    <div class="responsive " >
                        <div class="gallery">
                            <a target="_blank">
                                <img src="{{asset($fot->path)}}" style="object-fit:cover;object-position:60% 10%;">          
                            </a>
                        </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
        @endif
    </div>
    <br>
    </div>
</div>
</div> <br>

<div class="container-fluid" style="width:800px;">  
    <form method="post" action="/foto/submit/{{$kemajuan->id}}" id="addForm" enctype="multipart/form-data" style="background-color:white;">
    <p class="font-title" style="text-align:center;margin-top:-27px;">Tambah Foto Kemajuan</p> <br>
    {{ csrf_field() }}
        <div class="form-group {{ !$errors->has('file') ?: 'has-error' }}">
            <span class="labels font-subtitle-5">Foto</span>

            <table class="table table-borderless" id="dynamic_field" style="height:30px;">  
                <tr>  
                    <td><input type="file" name="file[]" class="help-block text-danger"> {{ $errors->first('file') }}</td>  
                    <td><button type="button" name="add" id="add" class="btn" style="background-color:#3378D3;color:white;margin-right:-70px">Tambah Foto Lain</button></td>  
                </tr>  
            </table>  
        </div><br>

        <div class="container1-btn" >
            <a class="container1-form-btn" data-toggle="modal" data-target="#myModal" style="width:150px; margin-top:-15px;margin-left:150px;">
                <span>
                    Batal
                    <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                </span>
            </a>
        </div>

        <div class="container-btn">
            <button class="container-form-btn" id="simpan" style="width:150px;margin-top:-15px;margin-left:-200px;">
                    <span>
                        Simpan
                        <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                    </span>
            </button>
        </div>
    </form>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Batalkan Proses?</h4>
            </div>
            <div class="modal-body" style="text-align:center;">
                <p>Jika proses dibatalkan, foto tidak akan disimpan.</p>
            </div>
            <div class="modal-footer">
                <center><a href='' class="btn btn-primary ">Tidak</a>
                <a href='/informasi/detail/{{$kemajuan->id}}' class="btn btn-default" style="color:red;">Iya</a></center>
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
                    <p class="text-center">Foto berhasil ditambah</p>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</body>

@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
$( document ).ready(function() {
    $('.your-class').slick({
        infinite: true,				
        lazyLoad: 'ondemand',
        slidesToShow: 2,
        slidesToScroll: 2,
        dots: true
	});
	$('.alert').alert();
    var postURL = "<?php echo url('addmore'); ?>";
    console.log(postURL);
    var i=1;  
    $('#add').click(function(){  
        i++;  
        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="file[]" class="help-block text-danger"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"" style=" background-color: whitesmoke;  color: red; border: 2px solid">X</button></td></tr>');  
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
@endsection
</html>