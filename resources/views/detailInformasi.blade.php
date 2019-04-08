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
    <p class="font-subtitle-1">Detail Kemajuan</p>
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
                            <li><p> Daftar Foto </p></li>
                            <!--@if ($foto==[])
                                <li><p> Tidak Ada </p></li>
                            @endif-->
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
                                <li><p class="deskripsi" style="margin-bottom:10px;" >{{ $informasi->description }}<p></li> <br>
                        </ul>
                    </div> <br>
                    @if ($foto != null)
                        @foreach ($foto as $fot)
                        <br>
                        <div class="responsive">
                            <div class="gallery">
                                <a target="_blank">
                                    <img src="{{asset($fot->path)}}" width="600" height="400">
                                </a>
                            </div>
                        </div>
                        @endforeach
                        <div class="clearfix"></div>
                    @endif
            </div>
        </div>
    </div><br><br>
        
        <center><a class="btn btn-primary" href="/info/edit/{{$informasi->id}}" style="font-size:12pt; font-weight:bolder;">Ubah</a>  
        <!--<a class="btn btn-danger" href="/info/delete/{{$informasi->id}}" style="font-size:12pt; font-weight:bolder;" aria-hidden="true" data-toggle="modal" data-target="#myModal">Hapus</a><center>-->
        
        <a class="btn btn-danger" data-toggle="modal" data-target="#myModal" style="font-size:12pt; font-weight:bolder;">
            <span>
                Hapus
                <i aria-hidden="true"></i>
            </span>
		</a>

    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Hapus Informasi?</h4>
                </div>
                <div class="modal-body" style="text-align:center;">
                    <p>Informasi mengenai kemajuan proyek akan dihapus.</p>
                </div>
                <div class="modal-footer">
                    <a href="/info/delete/{{$informasi->id}}" class="btn btn-default" style="color:red;">Hapus</a>
                    <a href="/informasi/detail/{{$informasi->id}}" class="btn btn-primary ">Kembali</a>
                </div>
            </div>
            </div>
	    </div>
</div>
</body>
@endsection