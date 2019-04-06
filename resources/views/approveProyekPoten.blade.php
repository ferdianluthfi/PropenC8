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
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="/proyek/detailProyek/{{ $proyek->id }}">Setujui {{ $proyek->projectName }}</a></li>
  </ol>
</nav>



<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Detail Proyek</p>
    <hr>
    <div>
        <p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName }}</p>
        <br>
        </div>
    <div class="row ketengahin">
        <div class="col-sm-7">
        <div class="card card-info">
            <div class="row judul">
                <div class="col-sm-9 font-subtitle-4">Informasi Umum</div>
                <div class="col-sm-1 font-status-approval">{{ $status }}</div>
            </div>
            <div class="row">
            <div class="col-sm-5 font-desc-bold">
                <ul>
                    <li><p>Nama Staf Marketing</p></li>
                    <li><p>Nama Proyek</p></li>
                    <li><p>Nama Perusahaan</p></li>
                    <li><p>Nilai Proyek</p></li>
                    <li><p>Estimasi Waktu Pengerjaan</p></li>
                    <li><p>Alamat Proyek</p></li>
                    <li><p>Deskripsi Proyek</p></li>
                    <li><p>Nilai Proyek</p></li>
                </ul>
            </div>
            <div class="col-sm-7 font-desc">
            <li><p>:   {{ $proyek->startDate}}<p></li>
                <ul>
                    <li><p>:  abdol <p></li>
                    <li><p>:   {{ $proyek->projectName}}<p></li>
                    <li><p>:   {{ $proyek->companyName}}<p></li>
                    <li><p>:   {{ $proyek->projectValue}}<p></li>
                    <li><p>:   {{ $proyek->estimatedTime}}<p></li>
                    <li><p>:   {{ $proyek->projectAddress}}<p></li>
                    <li><p>:   {{ $proyek->description}}<p></li>
                    <li><p>:   {{ $proyek->projectValue}}<p></li>
                </ul>
            </div>
            </div>
        </div>  
        </div>
        <div class="col-sm-2">
            <div class="card card-pm">
                <br>
                <p class="font-subtitle-5">Staf Marketing</p>
            </div>
        </div>

    </div>
    <div>
        <br>
        <div class="row ketengahin">
            <a href=""><div class="col-sm-3 card card-button">
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

</div>

<form action="/proyek/setujuiProyek/setuju/{{ $proyek->id }}" method="post" id="save">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
            <div class="container-btn">
                    <button class="container-form-btn" id="simpan">
                            <span>
                                SETUJUI
                            </span>
                    </button>
            </div>  
        </form> 
        <form action="/proyek/setujuiProyek/tolak/{{ $proyek->id }}" method="post" id="reject">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
            <div class="container1-btn">
                    <button class="container1-form-btn" id="tolak">
                        <span>
                            TOLAK
                        </span>
                    </button>
            </div>
	</form>
	
	<div id="myMod" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">
					<div class="icon-box">
						<i class="material-icons">&#xE876;</i>
					</div>				
					<h4 class="modal-title">SETUJUI!</h4>	
				</div>
				<div class="modal-body">
					<p class="text-center">Proyek potensial berhasil disetujui.</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
				</div>
			</div>
		</div>
	</div>     

    <div id="mod" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">
					<div class="icon-box">
						<i class="material-icons">&#xE876;</i>
					</div>				
					<h4 class="modal-title">TOLAK!</h4>	
				</div>
				<div class="modal-body">
					<p class="text-center">Proyek potensial berhasil ditolak</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-block" data-dismiss="modal" id="NO">OK</button>
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
        console.log("hhh");
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