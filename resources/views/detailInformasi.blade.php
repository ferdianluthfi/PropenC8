@extends('layouts.layout')

<head>
    <style>
    div.gallery {
    border: 1px solid #ccc;
    }

    div.gallery:hover {
    border: 1px solid #777;
    }

    div.gallery img {
    width: 100%;
    height: auto;
    }

    * {
    box-sizing: border-box;
    }

    .responsive {
    padding: 0 6px;
    float: left;
    width: 24.99999%;
    }

    @media only screen and (max-width: 700px) {
    .responsive {
        width: 49.99999%;
        margin: 6px 0;
    }
    }

    @media only screen and (max-width: 500px) {
    .responsive {
        width: 100%;
    }
    }
    .clearfix:after {
  content: "";
  display: table;
  clear: both;
}
    </style>
</head>

<body>

@section ('content')
@include('layouts.nav')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('assignedproyek') }}">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/proyek/detail/{{$proyek->id}}'>Detail Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/informasi/{{$proyek->id}}'>Informasi Kemajuan</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href='/informasi/detail/{{$informasi->id}}'>Detail Kemajuan</a></li>
  </ol>
</nav>

<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Detail Informasi</p>
    <hr>

    <div class="container-fluid card card-kontrak">
        <div class="row judul">
            <div class="col-sm-3 font-subtitle-4">Informasi Umum</div>
        </div>
        <hr>
        <div class="row" style="margin-left: -30px;">
            <div class="col-sm-12">
                <div class="col-sm-3 font-desc-bold">
                    <ul>
                        <li><p>Tipe Kemajuan</p></li>
                        <li><p>Tanggal Kemajuan</p></li>
                        <li><p>Nilai Kemajuan</p></li>
                        <li><p>Uraian Pekerjaan</p></li>
                    </ul>
                </div>
                <div class="col-sm-1">
                    <li><p>:</p></li>
                    <li><p>:</p></li>
                    <li><p>:</p></li>
                    <li><p>:</p></li>
                </div>
                <div class="col-sm-8 font-desc">
                    <ul>
                        @if ($informasi->tipeKemajuan ==1)
                            <li><p>Gaji<p></li> 
                        @elseif ($informasi->tipeKemajuan ==2)
                            <li><p>Belanja<p></li> 
                        @elseif ($informasi->tipeKemajuan ==3)
                            <li><p>Administrasi<p></li>  
                        @endif 

                        <li><p>{{ $tanggal }}<p></li>
                        <li><p>Rp {{ $informasi->value}}<p></li>

                        @if( $informasi->description == NULL)
                            <li><p class="deskripsi" style="margin-bottom:10px;" >{{ $lizWork[$informasi->pekerjaan_id - 1] }}<p></li> <br>
                        @else
                            <li><p class="deskripsi" style="margin-bottom:10px;" >{{ $lizWork[$informasi->pekerjaan_id - 1] }} ({{ $informasi->description }})<p></li> <br>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div><br>

        <div class="container-fluid card card-kontrak">
            <div class="row judul">
                <div class="col-sm-3 font-subtitle-4">Daftar Foto</div>
             </div>
        <hr>
            <div class="row" style="margin-left: -30px;">
                <div class="col-sm-12">
                    @if ($foto != null)
                        @foreach ($foto as $fot)
                        <div class="responsive">
                            <div class="gallery">
                                <a target="_blank">
                                    <img src="{{asset($fot->path)}}" width="300" height="300">
                                </a>
                            </div>
                        </div>
                        @endforeach
                        <div class="clearfix"></div>
                    @endif
                <br>
                </div>
            </div>
        </div> <br>
        @if(Auth::user()->role==7)
        <center> <a class="btn btn-primary" href="tambah/{{$informasi->id}}" style="font-size:12pt; font-weight:bolder;">Tambah Foto</a><br><br>
        @endif
</div>
</body>
@endsection