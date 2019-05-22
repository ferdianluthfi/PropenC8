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
        <div class="row">
            <div class="col-sm-12">
                <center><p class="font-title" style="margin-top: 20px; margin-left: 20px">Detail Proyek {{ $proyek->projectName}}</p></center>
            </div>
        </div><hr>
        <div class="row ketengahin">
            <div class="col-sm-9" style="margin-left: -30px;">
                <div class="card" style="min-height:250px" >
                    <div class="row judul">
                        <div class="col-sm-12 font-subtitle-4">Informasi Umum</div>
                    </div><hr>
                    <div class="row">
                        <div class="col-sm-4 font-desc-bold" style="margin-left: 30px;">
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
                        <div class="col-sm-6 font-desc" >
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
                </div>
            </div>
            <div class="col-sm-2" style="margin-left: -20px;" >
                <div class="card card-pm" style="height:90px;">
                    <br>
                    <p class="font-subtitle-5">Berkas</p><hr>
                    <br>
                    <a href="/informasi/{{ $proyek->id }}" class="button-berkas" style="width: 130px; height: 77px;margin-left: 35px; margin-top: 15px; padding-top: 10px"> INFORMASI <br> KEMAJUAN </a>
                    <br>
                </div>
            </div>
@endsection