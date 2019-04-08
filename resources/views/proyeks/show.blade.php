@extends('layouts.layout')

@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa) -->
@foreach($proyeks as $proyek)
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
	<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
	<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="{{ url('proyek', $id) }}">Detail Proyek {{ $proyek->projectName }}</a></li>
  </ol>
</nav>
<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Detail Proyek</p>
    <hr>
    <div>
        @if($proyek->approvalStatus === 0)
            <div class="row">
                <div class="col-sm-10"> 
                    <p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName}}</p>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary"  onclick="window.location.href='/proyek/ubah/{{ $proyek->id }}'">Ubah</button> 
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-sm-10"> 
                    <p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName}}</p>
                </div>
            </div>
        @endif
        <br>
    </div>
    <div class="row ketengahin">
        <div class="col-sm-7">
            <div class="card card-info">
                <div class="row judul">
                    <div class="col-sm-6 font-subtitle-4">Informasi Umum</div>
                    <div class="col-sm-5 font-status-approval" style="margin-left:15px;">{{$status}}</div>
                </div>
                <hr style="background-color:black;"/>
                <div class="row">
                    <div class="col-sm-5 font-desc-bold" style="margin-left: 30px;">
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
                    <div class="col-sm-6 font-desc" >
                        <ul>
                            <li><p>:   {{ $proyek->name}}<p></li>
                            <li><p>:   {{ $proyek->projectName}}<p></li>
                            <li><p>:   {{ $proyek->companyName}}<p></li>
                            <li><p>:   Rp{{ $proyek->projectValue}}<p></li>
                            <li><p>:   {{ $proyek->estimatedTime}} hari<p></li>
                            <li><p>:   {{ $proyek->projectAddress}}<p></li>
                            <li><p class="deskripsi" style="margin-bottom:10px;" >: {{ $proyek->description}}<p></li>
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
                <br> <br> <br>
                <p class="font-status-approval" style="text-align: center;">Belum Tersedia.</p>
            </div>
        </div>
    </div>
    <div>
        <div class="row ketengahin">
        @if($proyek->approvalStatus === 1)
            <a href=" /kelolaLelang/{{ $proyek->id }}"><div class="col-sm-12 card card-button-1">
                <p class="font-button-berkas">Kelola Lelang<p>
            </div></a>
        @endif
        </div>
    </div>
</div>
@endforeach
@endsection