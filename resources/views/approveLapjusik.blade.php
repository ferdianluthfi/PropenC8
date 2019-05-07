@extends('layouts.layout')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}" >

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	@section ('content')
	@include('layouts.nav')


	<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" data-toggle="modal" data-target="#myModd">Beranda</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" data-toggle="modal" data-target="#myModd">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="/proyek/detailProyek/{{ $proyek->id }}">Setujui {{ $proyek->projectName }}</a></li>
  </ol>
</nav>



<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Detail Proyek</p>
    <hr>

    <div> 
        <div class="row">
            <div class="col-sm-10"> 
                <p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName}}</p>
            </div>
        </div>
    <br>
    </div>

    <div class="row ketengahin">
        <div class="col-sm-7">
            <div class="card card-info">
                <div class="row judul">
                    <div class="col-sm-6 font-subtitle-4">Informasi Umum</div>
                    <div class="col-sm-5 font-status-approval" style="margin-left:15px;color:orange;">{{$status}}</div>
                </div>
                <hr style="background-color:black;"/>
                <div class="row">
                    <div class="col-sm-5 font-desc-bold" style="margin-left: 30px;">
                        <ul>
                            <li><p>Nama Staf Marketing</p></li>
                            <li><p>Nama Proyek</p></li>
                            <li><p>Nama Perusahaan</p></li>
                            <li><p>Alamat Proyek</p></li>
                            <li><p>Estimasi Waktu Pengerjaan</p></li>
                            <li><p>Nilai Proyek</p></li>
                            <li><p>Deskripsi Proyek</p></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 font-desc" >
                        <ul>
                            <li><p>:   {{ $proyek->name}}<p></li>
                            <li><p>:   {{ $proyek->projectName}}<p></li>
                            <li><p>:   {{ $proyek->companyName}}<p></li>
                            <li><p>:   {{ $proyek->projectAddress}}<p></li>
                            <li><p>:   {{ $proyek->estimatedTime}} Hari<p></li>
                            <li><p>:   Rp {{ $proyek->projectValue}}<p></li>
                            <li><p class="deskripsi" style="margin-bottom:10px;" >: {{ $proyek->description}}<p></li>
                        </ul>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-sm-2">
            <div class="card card-pm">
                <br>
				<p class="font-subtitle-5">Staf Marketing</p>
				<hr style="background-color:black;"/>
                <br> <br> <br>
                <p class="font-status-approval" style="text-align: center;">{{ $proyek->name}}</p>
            </div>
        </div>
    </div>
    <div>
        <br>
        <div class="row ketengahin">
            <!-- bikin kondisi dulu -->
            <a href="#"><div class="col-sm-3 card card-button">
                <p class="font-button-berkas-inactive">Berkas Kontrak<p>
            </div></a>
            <a href="#"><div class="col-sm-3 card card-button">
                <p class="font-button-berkas-inactive">LAPJUSIK<p>
            </div></a>
            <a href="#"><div class="col-sm-3 card card-button">
                <p class="font-button-berkas-inactive">LPJ<p>
            </div></a>
        </div>
    </div>  

    <div class="row" style="margin-top: 20px; ">
    <div class="col-sm-4"> </div>
    <div class="col-sm-2"> 
        <form action="/proyek/setujuiProyek/tolak/{{ $proyek->id }}" method="POST" id="reject">
            @csrf
            <button id="tolak" class="button-disapprove font-approval">TOLAK</button>
        </form> 
    </div>
    <div class="col-sm-2"> 
        <form action="/proyek/setujuiProyek/setuju/{{ $proyek->id }}" method="POST" id="save">
            @csrf
            <button id="simpan" class="button-approve font-approval">SETUJUI</button>
        </form>    
    </div>
    <div class="col-sm-4"> </div>

</div>
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
					<a href="/proyek/" class="btn btn-default" style="color:red;">Iya</a>
				
					<a href="/proyek/setujuiProyek/{{ $proyek->id }}" class="btn btn-primary">Tidak</a>
			
			</div>
		</div>
		
		</div>
	</div>
    
    <div id="mod" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">				
					<h4 class="modal-title" style="text-align:center;">Tolak!</h4>	
				</div>
				<div class="modal-body">
					<p class="text-center">Proyek berhasil ditolak</p>
				</div>
				<div class="modal-footer text-center">
					<button class="btn btn-success btn-block" data-dismiss="modal" id="NO">OK</button>
				</div>
			</div>
		</div>
	</div>  

	<div id="myMod" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">				
					<h4 class="modal-title" style="text-align:center;">Setuju!</h4>	
				</div>
				<div class="modal-body">
					<p class="text-center">Proyek berhasil disetujui</p>
				</div>
				<div class="modal-footer text-center">
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