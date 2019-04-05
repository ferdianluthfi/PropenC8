@extends('layouts.layout')

@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa) -->
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
        <p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName }}</p>
        <br>
        </div>
    <div class="row ketengahin">
        <div class="col-sm-7">
        <div class="card card-info">
            <div class="row judul">
                <div class="col-sm-9 font-subtitle-4">Informasi Umum</div>
                <div class="col-sm-1 font-status-approval">DISETUJUI</div>
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
                <ul>
                    <li><p>:   {{ $proyek->name}}<p></li>
                    <li><p>:   {{ $proyek->projectName}}<p></li>
                    <li><p>:   {{ $proyek->companyName}}<p></li>
                    <li><p>:   {{ $proyek->startDate}}<p></li>
                    <li><p>:   {{ $proyek->endDate}}<p></li>
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
                <p class="font-subtitle-5">Project Manager</p>
            </div>
        </div>

    </div>
    <div>
        <br>
        <div class="row ketengahin">
<!--            <button type="button" onclick="window.location.href='/kelolaLelang/{{ $proyek->id }}'">-->
<!--                <a>kelola lelankkk</a>-->
<!--            </button>-->
            <a href="/kelolaLelang/{{ $proyek->id }"><div class="col-sm-3 card card-button">
                <p class="font-button-berkas">Kelola Lelang<p>
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



