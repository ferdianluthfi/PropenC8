@extends('layouts.layout')

<!--INI PUNYA STAFF MARKETING -->
@if(Auth::user()->role == 3)
@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa)-->
@foreach($proyeks as $proyek)
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="{{ url('proyek', $id) }}">Detail Proyek {{ $proyek->projectName }}</a></li>
    </ol>
</nav>
<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <div class="row">
        <div class="col-sm-6">
            <p class="font-title" style="margin-top: 20px; margin-left: 20px">Detail Proyek {{ $proyek->projectName}}</p>
        </div>
        <div class="col-sm-6">
            @if($proyek->approvalStatus == 2 || $proyek->approvalStatus == 3 || $proyek->approvalStatus == 5 || $proyek->approvalStatus == 6) <p style="text-align: right; margin-right: 20px; margin-top: 30px; color:blue;">DISETUJUI</p>
            @elseif($proyek->approvalStatus == 1 || $proyek->approvalStatus == 4 || $proyek->approvalStatus == 7 || $proyek->approvalStatus == 8 ) <p style="text-align: right; margin-right: 20px; margin-top: 30px; color:green;">MENUNGGU PERSETUJUAN</p>
            @elseif($proyek->approvalStatus == 9 || $proyek->approvalStatus == 10) <p style="text-align: right; margin-right: 20px; margin-top: 30px;color:red;">DITOLAK</p>
            @endif
        </div>
    </div>
    <hr><br>
    <!-- {{-- <div>
        <div class="row">
            <div class="col-sm-10">
                <p class="font-subtitle-2"></p>
            </div>
        </div>
        <br>
    </div> --}} -->
    <div class="row ketengahin">
        <div class="col-sm-7">
            <div class="card card-info">
                <div class="row judul">
                
                    <div class="col-sm-6 font-subtitle-4">Informasi Umum</div>
                    <div class="col-sm-5 font-status-approval" style="margin-left:30px;">
                        @if ($proyek->approvalStatus == 7)
                        <a>PM : {{$pmName}}</a>
                        @elseif ($proyek->approvalStatus == 6)
                        <a href="/pm/kelola/{{$proyek->id}}">Belum ada PM</a>
                        @endif
                    </div>
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
        @if ($proyek->approvalStatus == 3)
        <div class="col-sm-2">
            <div class="card card-pm" style="margin-left: 90px">
                <br>
                <p class="font-subtitle-5">Status Lelang</p>
                <a href="/kelolaLelang/{{ $proyek->id }}"><button class="button-berkas" style="margin-left: 27px; margin-bottom: 5px; margin-top: 5px; width: 145px; height: 30px; font-size: 12px">LIHAT BERKAS LELANG</button></a>
                <hr/><br>
                <form action="/proyek/kalah/<?php echo $proyek->id ?>" method="GET" id="reject">
                    @csrf
                    <button id="tolak" class="button-disapprove" style="border-color: #c32222; margin-left: 35px; margin-bottom: 10px; color: #c32222">KALAH</button>
                </form>
                <form action="/proyek/menang/<?php echo $proyek->id ?>" method="GET" id="save">
                    @csrf
                    <button id="simpan" class="button-approve font-approval"  style="margin-left: 35px; margin-bottom: 10px">MENANG</button>
                </form>
            </div>
        </div>
        @elseif ($proyek->approvalStatus == 1)
        <div class="col-sm-2">
            <div class="card card-pm" style="margin-left: 90px">
                <br>
                <p class="font-subtitle-5">Berkas</p>
                <hr/>
                <br>
                <a class="button-berkas-inactive" style="margin-left: 35px; margin-top: 35px; padding-top: 10px">Lelang</a>
                <br>
            </div>
        </div>
        @elseif ( $proyek->approvalStatus == 2)
        <div class="col-sm-2">
            <div class="card card-pm" style="margin-left: 90px">
                <br>
                <p class="font-subtitle-5">Berkas</p>
                <hr/>
                <br>
                <a href="/kelolaLelang/{{ $proyek->id }}" class="button-berkas" style="margin-left: 35px; margin-top: 35px; padding-top: 7px">LELANG</a>
                <br>
            </div>
        </div>
        @else
        <div class="col-sm-2">
            <div class="card card-pm" style="margin-left: 90px">
                <br>
                <p class="font-subtitle-5">Berkas</p>
                <hr/>
                @if ($proyek->approvalStatus == 4)
                <a href="{{ route('buat-kontrak', $proyek->id) }}"><button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">KONTRAK</button></a>
                <button class="button-berkas-inactive" style="margin-left: 35px; margin-bottom: 10px">LAPJUSIK</button>
                <button class="button-berkas-inactive" style="margin-left: 35px">LPJ</button>
                @elseif( $proyek->approvalStatus == 5)
                <a href="{{ route('view-kontrak', $proyek->id) }}"><button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">KONTRAK</button></a>
                <button class="button-berkas-inactive" style="margin-left: 35px; margin-bottom: 10px">LAPJUSIK</button>
                <button class="button-berkas-inactive" style="margin-left: 35px">LPJ</button>
                @elseif( $proyek->approvalStatus == 6)
                <a href="{{ route('view-kontrak', $proyek->id) }}"><button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">KONTRAK</button></a>
                <button class="button-berkas-inactive" style="margin-left: 35px; margin-bottom: 10px">LAPJUSIK</button>
                <button class="button-berkas-inactive" style="margin-left: 35px">LPJ</button>
                @elseif( $proyek->approvalStatus == 7 )
                <button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">Kontrak</button>
                <button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px">LAPJUSIK</button>
                <button class="button-berkas-inactive" style="margin-left: 35px">LPJ</button>
                @elseif( $proyek->approvalStatus == 8 )
                <button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">Kontrak</button>
                <button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px">LAPJUSIK</button>
                <button class="button-berkas" style="margin-left: 35px">LPJ</button>
                @elseif($proyek-> approvalStatus == 9 || $proyek-> approvalStatus == 10)
                <button class="button-berkas-inactive" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">Kontrak</button>
                <button class="button-berkas-inactive" style="margin-left: 35px; margin-bottom: 10px">LAPJUSIK</button>
                <button class="button-berkas-inactive" style="margin-left: 35px">LPJ</button>
                @endif
            </div>
        </div>
        @endif
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
@endforeach
@endsection

<!--INI PUNYA PROGRAM MANAGER-->
@elseif(Auth::user()->role == 5)
@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa) -->
@foreach($proyeks as $proyek)
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="{{ url('proyek', $id) }}">Detail Proyek {{ $proyek->projectName }}</a></li>
    </ol>
</nav>
<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <div class="row">
        <div class="col-sm-6">
            <p class="font-title" style="margin-top: 20px; margin-left: 20px">Detail Proyek {{ $proyek->projectName}}</p>
        </div>
        <div class="col-sm-6">
            <p style="text-align: right; margin-right: 20px; margin-top: 30px">{{ $status }}</p>
        </div>
    </div>
    <hr>
    <div>
        <div class="row">
            <div class="col-sm-10">
                <p class="font-subtitle-2"></p>
            </div>
        </div>
        <br>
    </div>
    <div class="row ketengahin">
        <div class="col-sm-8">
            <div class="card card-info">
                <div class="row judul">
                    <div class="col-sm-6 font-subtitle-4">Informasi Umum</div>
                    <div class="col-sm-5 font-status-approval" style="margin-left:30px;">
                        @if ($proyek->approvalStatus == 6)
                        <a>Belum ada PM</a>
                        @elseif ($proyek->approvalStatus == 7)
                        <a>PM : {{$pmName}}</a>
                        <span class="glyphicon glyphicon-pencil"></span>
                        @endif
                    </div>
                </div>
                <hr style="background-color:black;"/>
<!--                <div class="row">-->
<!--                    <div class="col-sm-10">-->
<!--                        <p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName}}</p>-->
<!--                    </div>-->
<!--                </div>-->
                <br>
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
                <p class="font-subtitle-5">Berkas</p>
                <hr/>
<!--                <button href="/kelolaLelang/{{ $proyek->id }}" class="button-disapprove" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">Kontrak</button>-->
                <a href="/kelolaLelang/{{ $proyek->id }}" class="button-berkas" style="margin-left: 35px; margin-top: 60px; padding-top: 10px">Lelang</a>
<!--                <button class="button-disapprove" style="margin-left: 35px">LPJ</button>-->
            </div>
        </div>
    </div>
</div>
<!--<div>-->
<!--        <div class="row ketengahin">-->
<!--            <a href=" /kelolaLelang/{{ $proyek->id }}"><div class="col-sm-12 card card-button-1">-->
<!--                    <p class="font-button-berkas">Kelola Lelang<p>-->
<!--                </div></a>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
@endforeach
@endsection

<!--INI PUNYA MGR PELAKSANA, dan if else yang udah lengkap kelola lelangnya soon-->
@elseif(Auth::user()->role == 6 or Auth::user()->role == 4)
@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa) -->
@foreach($proyeks as $proyek)
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Daftar Proyek</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="{{ url('proyek', $id) }}">Detail Proyek {{ $proyek->projectName }}</a></li>
    </ol>
</nav>
<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <div class="row">
        <div class="col-sm-6">
            <p class="font-title" style="margin-top: 20px; margin-left: 20px">Detail Proyek {{ $proyek->projectName}}</p>
        </div>
        <div class="col-sm-6">
            <p style="text-align: right; margin-right: 20px; margin-top: 30px; color: blue">{{ $status }}</p>
        </div>
    </div>
    <hr><br>
    <div class="row ketengahin">
        <div class="col-sm-8">
            <div class="card card-info">
                <div class="row judul">
                    <div class="col-sm-6 font-subtitle-4">Informasi Umum</div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-3 font-status-approval" style="margin-left:30px;">
                        @if(Auth::user()->role == 4)
                        @if ($proyek->approvalStatus == 6)
                        <a>Belum ada PM</a>
                        @elseif ($proyek->approvalStatus == 7)
                        <a>PM : {{$pmName}}</a>
                        <span class="glyphicon glyphicon-pencil"></span>
                        @endif

                        @else
                        @if ($proyek->approvalStatus == 6)
                        <a href="/pm/kelola/{{$proyek->id}}" style="text-align: right; color:#63A2F6;">+ Tambah PM</a>
                        @elseif ($proyek->approvalStatus == 7)
                        <a href="/pm/kelola/{{$proyek->id}}" style="text-align: right; color:#63A2F6;">{{$pmName}}<span class="glyphicon glyphicon-pencil"></span></a>
                        @endif
                        @endif
                    </div>
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
                <p class="font-subtitle-5">Berkas</p>
                <hr/>

                @if($proyek->approvalStatus == 4)
                <a href="{{ route('buat-kontrak', $proyek->id) }}"><button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">KONTRAK</button></a>
                <button class="button-berkas-inactive" style="margin-left: 35px; margin-bottom: 10px">LAPJUSIK</button>
                <button class="button-berkas-inactive" style="margin-left: 35px">LPJ</button>
                @elseif ($proyek->approvalStatus == 6)
                <a href="/kelolaLelang/{{ $proyek->id }}"><button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">Kontrak</button></a>
                <button class="button-berkas-inactive" style="margin-left: 35px; margin-bottom: 10px">LAPJUSIK</button>
                <button class="button-berkas-inactive" style="margin-left: 35px">LPJ</button>
                @elseif ($proyek->approvalStatus == 7)
                <a href="/kelolaLelang/{{ $proyek->id }}"><button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">Kontrak</button></a>
                <a href="/pelaksanaan/{{$proyek->id}}"><button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px">LAPJUSIK</button></a>
                <button class="button-berkas-inactive" style="margin-left: 35px">LPJ</button>
                @endif
                
            </div>
        </div>

    </div>
</div>
@endforeach
@endsection

<!--INI PUNYA KLIEN-->
@elseif(Auth::user()->role == 8)
@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa) -->
@foreach($proyeks as $proyek)
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="{{ url('proyek', $id) }}">Detail Proyek {{ $proyek->projectName }}</a></li>
    </ol>
</nav>
<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <div class="row">
        <div class="col-sm-7">
            <p class="font-title" style="margin-top: 20px; margin-left: 20px">Detail Proyek {{ $proyek->projectName}}</p>
        </div>
        <!-- <div class="col-sm-5">
            <p style="text-align: right; margin-right: 20px; margin-top: 30px; color: blue">{{ $status }}</p>
        </div> -->
    </div>
    <hr>
    <div>
        <div class="row">
            <div class="col-sm-10">
                <p class="font-subtitle-2"></p>
            </div>
        </div>
        <br>
    </div>
    <div class="row ketengahin">
        <div class="col-sm-8">
            <div class="card card-info">
                <div class="row judul">
                    <div class="col-sm-6 font-subtitle-4">Informasi Umum</div>
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
        <div class="col-sm-1"></div>
        <div class="col-sm-3">
            <div class="card card-pm" style="margin-left:-50px">
                <br>
                <p class="font-subtitle-5">Berkas</p>
                <hr/>
                @if($kontrak==null)
                <button class="button-disapprove" style="margin-left: 35px; border:2px solid #b5b5b5; border-radius:10px;color:#b5b5b5;margin-top:5px; margin-bottom:5px;">KONTRAK</button>
                @else
                <a href="/proyek/{{$proyek->id}}/kontrak"><button class="button-disapprove" style="margin-left: 35px;margin-top:5px; margin-bottom:5px;">KONTRAK</button>
                @endif
                
                @if($pelaksanaan->isempty())
                <button class="button-disapprove" style="margin-left: 35px; border:2px solid #b5b5b5; border-radius:10px;color:#b5b5b5;margin-top:5px; margin-bottom:5px;">LAPJUSIK</button>
                @else
                <a href="/pelaksanaan/{{$proyek->id}}"><button class="button-disapprove" style="margin-left: 35px;margin-top:5px; margin-bottom:5px;">LAPJUSIK</button></a>
                @endif

                <button class="button-disapprove" style="margin-left: 35px; border:2px solid #b5b5b5; border-radius:10px;color:#b5b5b5;margin-top:5px; margin-bottom:5px;">LPJ</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

<!--INI PUNYA DIREKSI-->
@elseif(Auth::user()->role == 2)
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
    <div class="row">
        <div class="col-sm-7">
            <p class="font-title" style="margin-top: 20px; margin-left: 20px">Detail Proyek {{ $proyek->projectName}}</p>
        </div>
        <div class="col-sm-5">
            <p style="text-align: right; margin-right: 20px; margin-top: 30px; color: blue">{{ $status }}</p>
        </div>
    </div>
    <hr>
    <div>
        <div class="row">
            <div class="col-sm-10">
                <p class="font-subtitle-2"></p>
            </div>
        </div>
        <br>
    </div>
    <div class="row ketengahin">
        <div class="col-sm-8">
            <div class="card card-info">
                <div class="row judul">
                    <div class="col-sm-6 font-subtitle-4">Informasi Umum</div>
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
        <div class="col-sm-1"></div>
        <div class="col-sm-3">
            <div class="card card-pm" style="margin-left:-50px">
                <br>
                <p class="font-subtitle-5">Berkas</p>
                <hr/>
                @if($proyek->approvalStatus == 1 || $proyek->approvalStatus == 2)

                        <br>
                        <a href="/kelolaLelang/{{ $proyek->id }}" class="button-berkas" style="margin-left: 35px; margin-top: 35px; padding-top: 7px">LELANG</a>
                        <br>
                
                @else

                    @if ($proyek->approvalStatus == 5 || $proyek->approvalStatus == 6)
                    <a href="{{ route('view-kontrak', $proyek->id) }}"><button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">KONTRAK</button></a>
                    <button class="button-berkas-inactive" style="margin-left: 35px; margin-bottom: 10px">LAPJUSIK</button>
                    <button class="button-berkas-inactive" style="margin-left: 35px">LPJ</button>
                    
                    @elseif($proyek->approvalStatus == 7 || $proyek->approvalStatus == 8)
                    <a href="{{ route('view-kontrak', $proyek->id) }}"><button class="button-berkas" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">KONTRAK</button></a>
                    <a href="/pelaksanaan/{{$proyek->id}}"><button class="button-disapprove" style="margin-left: 35px;margin-top:5px; margin-bottom:5px;">LAPJUSIK</button></a>
                    <button class="button-berkas-inactive" style="margin-left: 35px">LPJ</button>

                    @else
                    <button class="button-berkas-inactive" style="margin-left: 35px; margin-bottom: 10px; margin-top: 5px">KONTRAK</button>
                    <button class="button-berkas-inactive" style="margin-left: 35px; margin-bottom: 10px">LAPJUSIK</button>
                    <button class="button-berkas-inactive" style="margin-left: 35px">LPJ</button>
                    @endif
                @endif

            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@endif
