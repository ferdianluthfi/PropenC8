@extends('layouts.layout')

@section ('content')
@include('layouts.nav')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('assignedproyek') }}">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/proyek/detail/{{$pelaksanaan->proyek_id}}'>Detail Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/informasi/{{$pelaksanaan->proyek_id}}'>Informasi Kemajuan</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/informasi/detail/{{$kemajuan->id}}'>Detail Kemajuan</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href='/informasi/detail/tambah/{{$kemajuan->id}}'>Tambah Foto</a></li>
  </ol>
</nav>

<form method="post" action="/foto/submit/{{$kemajuan->id}}" id="addForm" enctype="multipart/form-data">
<h2 style="text-align:center;">Tambah Foto Proyek</h2> <br>
{{ csrf_field() }}
    <div class="form-group {{ !$errors->has('file') ?: 'has-error' }}">
        <label>Foto</label>

        <table class="table table-bordered" id="dynamic_field">  
            <tr>  
                <td><input type="file" name="file[]" class="help-block text-danger"> {{ $errors->first('file') }}</td>  
                <td><button type="button" name="add" id="add" class="btn btn-success">Tambah Foto Lain</button></td>  
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
            <a href='/informasi/{{$pelaksanaan->proyek_id}}' class="btn btn-default" style="color:red;">Iya</a>
            <a href='{{$kemajuan->id}}' class="btn btn-primary ">Tidak</a>
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