<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Overview Kontrak Kerja</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
</head>

@extends('layouts.layout')

@include('layouts.nav')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="/proyek/{{ $proyek->id }}/lihatKontrak/">Overview Kontrak Kerja</a></li>
  </ol>
</nav>

<body>
    
    <div id="header">
        <h2>Overview Kontrak Kerja</h2>
    </div>

    <div id="info">
        <p>Informasi Kontrak Kerja</p>
        <p style="text-align: right">Menunggu Persetujuan</p>
    </div>

    <div id="infoUmum">
        <h3>Informasi Umum</h3>
        <p>Nama Proyek          : {{ $proyek->projectName }} </p>
        <p>Nama Perusahan       : {{ $proyek->companyName }}</p>
        <p>Alamat Proyek        : {{ $proyek->projectAddress }} </p>
        <p>Nama Pelaksana       : </p>
        <p>Nilai Proyek         : {{ $proyek->projectValue }}</p>
        <p>Alamat Perusahaan    : {{ $proyek->projectAddress }}</p>
        <p>Tanggal Kontrak      : {{ $tanggals }}</p>
        <p>Nilai Proyek Huruf   : </p>
        <p>PenanggungJawab      : </p>
    </div>

    <div id="berkasSurat">
        <h3>Surat Diproses</h3>
        <ul>
            <li>BBB CREAM PAPAPAA</li>
            <li>LIPSTICK GUL MAMAMAMA</li>
        </ul>
    </div>

    <div id="tombol">
            <button>Batal</button>
            <button>Buat Kontrak</button>
    </div>
    
</body>
</html>