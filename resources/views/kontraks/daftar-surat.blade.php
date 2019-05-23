@extends('layouts.layout')

<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TRAYEK</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}" >

    <!-- Bootstrap CSS CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	
     <!-- Our Custom CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
</head>

<nav aria-label="breadcrumb">

  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Daftar Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="/proyek/lihat/{{ $proyek->id }}">Detail Proyek {{ $proyek->projectName }}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="#">Buat Kontrak Kerja</a></li>  
  </ol>
</nav>

@section ('content')
@include('layouts.nav')
<div class="container-fluid card card-detail-proyek" style="padding-bottom:20px;">
    <br>
    <p class="font-subtitle-1">Buat Kontrak Kerja</p>
    <hr>
    
    <br>
    <form action ="/proyek/{{$proyek->id}}/kontrak/createKontrak" method ="post" id="save" enctype="multipart/form-data">
        @csrf
        <table id="datatable" data-page-length='25' class="table table-striped table-bordered" >
            <thead>
            <tr style="text-align: center">
                <th>Nomor</th>
                <th>Nama Surat</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Surat Keputusan Otorisasi Pelaksanaan</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr> 
                <td>2</td>
                <td>Surat Perintah Pelaksanaan Program</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Surat Perintah Panitia Pelelangan</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Surat Undangan</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Berita Acara Penjelasan Pekerjaan</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>6</td>
                <td>Daftar Hadir Panitia dan Peserta Lelang</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>7</td>
                <td>Daftar Permintaan Barang</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>8</td>
                <td>Daftar Harga Perkiraan Sendiri</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>9</td>
                <td>Berita Acara Pembukaan Dokumen Penawaran</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>10</td>
                <td>Surat Penawaran Rekanan</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>11</td>
                <td>Surat Jaminan Penawaran</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>12</td>
                <td>Data Perusahaan Pemenang</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>13</td>
                <td>Berita Acara Negosiasi</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>14</td>
                <td>Surat Keputusan Pelulusan Pemenang</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>15</td>
                <td>Surat Perintah Kerja</td>
                <td><input type="file" name="surat[]"></td> 
            </tr>
            <tr>
                <td>16</td>
                <td>Surat Jaminan Bank</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            <tr>
                <td>17</td>
                <td>Surat Kontrak Jual Beli</td>
                <td><input type="file" name="surat[]"></td>
            </tr>
            </tbody>
        </table>
        <br>
        <br>
        
        <div class="col-sm-3"> </div>
        <div class="col-sm-3 container1-btn">
            <div style="margin-left:310px;">
            <a class="button-disapprove font-approval"data-toggle="modal" data-target="#myModal" style="padding:10px;">
            <button>Kembali</button>
            </a>
            </div>
        </div>
        <div class="col-sm-3"> 
            
            <button id="simpan" class="button-approve font-approval" style="margin-left:70px">Lanjut</button>
        </div>
    </form>
    <br>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
				<a href="{{ route('buat-kontrak', $proyek->id) }}" class="btn btn-default" style="color:red;">Iya</a>
				<a data-dismiss="modal" class="btn btn-primary ">Tidak</a>
			</div>
		</div>
		</div>
    </div>

`    <div id="myMod" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>	
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Berkas Kontrak berhasil disimpan.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
                    </div>
                </div>
            </div>
        </div>

    </div>`
    
</div>



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
    });


    $( document ).ready(function() {

        
        $("#simpan").click(function(e){
            e.preventDefault();
            //checks if it's valid
        //horray it's valid
            $("#myMod").modal("show");
            
        });
        $("#OK").click(function(e){
        $('#save').submit();
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
    });
</script>
@endsection
