@extends('layouts.layout')

@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa) -->

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
	<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
	<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="/proyek/detailProyek/{{ $proyek->id }}">Detail Proyek {{ $proyek->projectName }}</a></li>
  </ol>
</nav>
<!-- isinya -->
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
                     <div class="col-sm-5 font-status-approval" style="margin-left:15px; color:limegreen;">{{$status}}</div>
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
                <p class="font-status-approval" style="text-align: center;"> {{ $proyek->name}}</p>
            </div>
        </div>
    </div>
    <div>
        <br>
        <div class="row ketengahin">
            <!-- bikin kondisi dulu -->
            @if($proyek->approvalStatus == 4)
            <a href="{{ route('buat-kontrak', $proyek->id) }}"><div class="col-sm-3 card card-button">
                <p class="font-button-berkas">Berkas Kontrak<p>
            </div></a>
            @elseif($proyek->approvalStatus == 5 || $proyek->approvalStatus == 6 || $proyek->approvalStatus == 7 ||
            $proyek->approvalStatus == 8)
            <a href="{{ route('view-kontrak', $proyek->id) }}"><div class="col-sm-3 card card-button">
                <p class="font-button-berkas">Berkas Kontrak<p>
            </div></a>
            @endif
            <a href="#"><div class="col-sm-3 card card-button">
                <p class="font-button-berkas-inactive">LAPJUSIK<p>
            </div></a>
            <a href="#"><div class="col-sm-3 card card-button">
                <p class="font-button-berkas-inactive">LPJ<p>
            </div></a>
        </div>
    </div>  
</div>
@endsection