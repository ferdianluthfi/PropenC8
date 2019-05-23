@extends('layouts.layout')

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <!-- Our Custom CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

@section ('content')
@include('layouts.nav')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="margin-left:150px;">
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="/proyek/lihat/{{$proyek_id}}">Detail Proyek</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="#">Kelola PM</a></li>
    </ol>
</nav>
<body>


<div class="container-fluid card card-detail-proyek form-group" style="padding-top: 20px; padding-bottom: 20px; min-height: auto">
    @if(session('error'))
    <div class="alert alert-warning alert-dismissible" style="margin: 15px;" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong> {{ session('error') }} </strong>
    </div>
    @endif
    <p class="font-subtitle-1">Ubah PM</p>
    <form action="/pm/update" method="post" id="editPM">
        <input type="hidden" name="proyek_id" value="{{ $proyek_id }}">
        <input type="hidden" name="pengguna_id" value="{{ $choosenPmId }}">
        {{ csrf_field() }}
        {{ method_field('post') }}
        <table id="datatable" class="table table-striped table-bordered" >
            <thead>
            <th>ID</th>
            <th>Nama</th>
            <th>Jumlah Proyek</th>
            <th>Kelola</th>
            </thead>
            <tbody>
            @foreach ($pmlist as $pm)
            <tr>
                <td>PM{{ $pm->id }}</td>
                <td>{{ $pm->name }}</td>
                <td>{{ $pm->total }}</td>
                <td style="vertical-align: center">
                    @if ($pm->total<3)
                        @if($pm->id == $choosenPmId)
                        <input type="radio" name="selected" value="{{$pm->id}}" checked>
                        @else
                        <input type="radio" name="selected" value="{{$pm->id}}">
                        @endif
                    @else
                    <p style="color: red">Tidak bisa menambahkan proyek</p>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br><br>
<!--        <div>-->
<!--            @if ($choosenPmId == 0)-->
<!--            <label>Tambahkan kategori pekerjaan pada field di bawah ini</label>-->
<!---->
<!--            <table class="table table-bordered" id="dynamic_field">-->
<!--                <th>Kategori</th>-->
<!--                <th>Nominal</th>-->
<!--                <th>Action</th>-->
<!--                <tr>-->
<!--                    <td><input type="text" name="desc[]" class="help-block text-danger"> {{ $errors->first('file') }}</td>-->
<!--                    <td><input type="number" name="num[]" class="help-block text-danger"> {{ $errors->first('file') }}</td>-->
<!--                    <td><button type="button" name="add" id="add" class="btn btn-success">Tambah Kategori Lain</button></td>-->
<!--                </tr>-->
<!--            </table>-->
<!--            @endif-->
<!--        </div>-->

        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-6" style="vertical-align: center">
                <button id="tolak" class="button-disapprove" data-toggle="modal" data-target="#myModd">BATAL</button>
                <button class="button-approve" id="simpan" aria-hidden="true">SIMPAN</button>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </form>
</div>

<div class="modal fade" id="myModd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Batalkan Proses?</h4>
            </div>
            <div class="modal-body" style="text-align:center;">
                <p>Jika proses dibatalkan, perubahan tidak akan disimpan.</p>
            </div>
            <div class="modal-footer">
                <!--                GANTI JADI BALIK KE DETAIL PROYEK-->
                <a href="/proyek/lihat/{{ $proyek_id }}" class="btn btn-default" style="color:red;">Iya</a>
                <a href="/pm/kelola/{{ $proyek_id }}" class="btn btn-primary">Tidak</a>
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
                <p class="text-center">PM berhasil diubah</p>
            </div>
            <div class="modal-footer">
                <a href="/proyek/lihat/{{ $proyek_id }}" class="btn btn-success">OK</a>
            </div>
        </div>
    </div>
</div>

</body>

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js" integrity="sha256-+h0g0j7qusP72OZaLPCSZ5wjZLnoUUicoxbvrl14WxM=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/umd/util.js"></script>

<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
        $("#simpan").click(function(e){
            //checks if it's valid
            //horray it's valid
            $("#myMod").modal("show");
        });
        $("#OK").click(function(e){
            $('#editPM').submit();
        });
        $("#tolak").click(function(e){
            e.preventDefault();
            //checks if it's valid
            //horray it's valid
            $("#mod").modal("show");
        });
        $("#NO").click(function(e){
            $('#reject').submit();
        });
        var postURL = "<?php echo url('addmore'); ?>";
        console.log(postURL);
        var i=1;
        $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="desc[]" class="help-block text-danger"></td><td><input type="number" name="num[]" class="help-block text-danger"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
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
    });
</script>
@endsection
</html>
