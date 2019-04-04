@extends('layouts.layout')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
</head>
<body>
	@foreach($proyeks as $proyek)
	<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
		<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
		<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="{{ url('proyek', $id) }}">Detail Proyek {{ $proyek->projectName }}</a></li>
	</ol>
	</nav>
	<div class="container" style="padding:5%;">
		<div class="row bigCard">
			<h3 class="col-md-12" style="text-align:center;">Detail Proyek </h3>
			
			@if($proyek->approvalStatus === 0)
				<h4 class="col-md-12" style="text-align:left;">Detail Proyek {{ $proyek->projectName}} <button type="button" class="btn btn-primary" style="float:right;" onclick="window.location.href='/proyek/ubah/{{ $proyek->id }}'">UBAH</button> </h4>
			@else
				<h4 class="col-md-12" style="text-align:left;">Detail Proyek {{ $proyek->projectName}} <button type="button" class="btn btn-primary disabled" style="float:right;" >UBAH</button> </h4>
			@endif
			<br><br>
			
			<div class="col-md-8 card" style="width: 50%;">
				
				<h4 > Informasi Umum &emsp; <mark style="background-color:#e3f0f3;">{{$status}}</mark> </h4>
				
				<hr style="background-color:black;"/>				
							<b>Nama Staf Marketing &nbsp;: {{ $proyek->name }}</b> <br>
				
							<b>Nama Proyek&nbsp;&emsp;&emsp;&emsp;&emsp;: {{ $proyek->projectName }} </b><br>
				
							<b >Nama Perusahaan  &nbsp;&emsp;: {{ $proyek->companyName }}</b> <br>
				
							<b >Deskripsi &nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: {{ $proyek->description }} </b><br>

							<b>Nilai Proyek &emsp;&emsp;&emsp;&emsp;&emsp;: Rp {{ $proyek->projectValue }}.- </b><br>
				
							<b>Estimasi Waktu Pengerjaan &nbsp;: {{ $proyek->estimatedTime }} hari</b> <br>
			
							<b>Alamat Proyek&nbsp;&nbsp;&emsp;&emsp;&emsp;: {{ $proyek->projectAddress }} </b>
							
			</div>
			<div class="col-md-4 card" style="width: 20%;">
				<h4 style="text-align:center;"> Project Manager</h4>
				<hr style="background-color:black;"/><br><br>					
				<h4 style="text-align:center;"> Belum Tersedia </h4>
			</div>
			<div class="col-md-12" style="padding:20px; margin:20px;">
				<div class="berkas">
					<button type="button" class="btn btn-primary disabled">BERKAS KONTRAK </button>
				</div>
				<div class="lapjusik">
					<button type="button" class="btn btn-primary disabled">LAPJUSIK </button>
				</div>
				<div class="lpj">
					<button type="button" class="btn btn-primary disabled">LPJ </button>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</body>
</html>
 
<!-- @extends('layouts.layout')

@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa) -->
<!-- <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
	<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
	<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="{{ url('proyek', $id) }}">Detail Proyek {{ $proyek->projectName }}</a></li>
  </ol>
</nav> -->

<!-- isinya -->
<!-- <div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Detail Proyek</p>
    <hr>
    <div>
		@if($proyek->approvalStatus === 0)
			<p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName}} <button type="button" class="btn btn-primary" style="float:right;" onclick="window.location.href='/proyek/ubah/{{ $proyek->id }}'">UBAH</button> </p>
		@else
			<p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName}} <button type="button" class="btn btn-primary disabled" style="float:right;" >UBAH</button> </p>
		@endif
        <br>
    </div>
    <div class="row ketengahin">
        <div class="col-sm-7">
        <div class="card card-info">
            <div class="row judul">
                <div class="col-sm-9 font-subtitle-4">Informasi Umum</div>
                <div class="col-sm-1 font-status-approval">{{$status}}</div>
			</div>
			<!-- <hr style="background-color:black;"/>	 -->
            <!-- <div class="row">
            <div class="col-sm-5 font-desc-bold">
                <ul>
                    <li><p>Nama Staf Marketing</p></li>
                    <li><p>Nama Proyek</p></li>
                    <li><p>Nama Perusahaan</p></li>
                    <li><p>Nilai Proyek</p></li>
                    <li><p>Estimasi Waktu Pengerjaan</p></li>
                    <li><p>Alamat Proyek</p></li>
                    <li><p>Deskripsi Proyek</p></li>
                </ul>
            </div>
            <div class="col-sm-7 font-desc">
                <ul>
                    <li><p>:   {{ $proyek->name}}<p></li>
                    <li><p>:   {{ $proyek->projectName}}<p></li>
                    <li><p>:   {{ $proyek->companyName}}<p></li>
                    <li><p>:   {{ $proyek->projectValue}}<p></li>
                    <li><p>:   {{ $proyek->estimatedTime}} Hari<p></li>
                    <li><p>:   {{ $proyek->projectAddress}}<p></li>
                    <li><p>:   {{ $proyek->description}}<p></li>
                </ul>
            </div>
            </div>
        </div>  
        </div>
        <div class="col-sm-2">
            <div class="card card-pm">
                <br>
				<p class="font-subtitle-5">Project Manager</p>
				<hr style="background-color:black;"/>
                <br>
                <br>
                <br>
                <br>
                <p class="font-status-approval" style="text-align: center;">Belum Tersedia.</p>
            </div>
        </div>

    </div>
    <div>
        <br>
        <div class="row ketengahin">
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

</div> -->
  