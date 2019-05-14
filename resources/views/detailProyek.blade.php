@extends('layouts.layout')

@section ('content')
@include('layouts.nav')
<!-- kemajuan proyek -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('assignedproyek') }}">Daftar Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active">Detail Proyek</a></li>
  </ol>
</nav>
<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <br>
    <hr>
    <div>
        <div class="row">
            <div class="col-sm-12"> 
                <p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName}}</p>
            </div>
        </div>
        <br>
    </div>
    <div class="row ">
        <div class="col-sm-12 ketengahin">
            <div class="col-sm-12 font-subtitle-5">Informasi Umum</div> <br>
                <hr style="background-color:black;"/>
                    <div class="col-sm-3 font-desc-bold">
                        <ul>
                            <li><p>Nama Staf Marketing</p></li>
                            <li><p>Nama Perusahaan</p></li>
                            <li><p>Nilai Proyek</p></li>
                            <li><p>Estimasi Waktu Pengerjaan</p></li>
                            <li><p>Alamat Proyek</p></li>
                            <li><p>Deskripsi Proyek</p></li>
                        </ul>
                    </div>
                    <div class="col-sm-1">
                        <li><p>:</p></li>
                        <li><p>:</p></li>
                        <li><p>:</p></li>
                        <li><p>:</p></li>
                        <li><p>:</p></li>
                        <li><p>:</p></li>
                    </div>
                    <div class="col-sm-8 font-desc" >
                        <ul>
                            <li><p>{{ $proyek->name}}<p></li>
                            <li><p>{{ $proyek->companyName}}<p></li>
                            <li><p>Rp {{ $proyek->projectValue}}<p></li>
                            <li><p>{{ $proyek->estimatedTime}} Hari<p></li>
                            <li><p>{{ $proyek->projectAddress}}<p></li>
                            <li><p class="deskripsi" style="margin-bottom:10px;" >{{ $proyek->description}}<p></li>
                        </ul>
                    </div>
            </div>  
        </div> <br>
        <div class="row ketengahin">
            <a href="/informasi/{{ $proyek->id }}"><div class="col-sm-12 card card-button-1">
                <p class="font-button-berkas">Informasi Kemajuan<p>
            </div></a>
        </div>
    </div>
    <div>
    </div>
</div>
@endsection