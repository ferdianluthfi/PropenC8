@extends('layouts.layout')

<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

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
    </style>
</head>

<body>

@section ('content')
@include('layouts.nav')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    @if(Auth::user()->role==7)
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('assignedproyek') }}">Daftar Proyek</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/informasi/{{$proyek->id}}'>Daftar Kemajuan Proyek</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active">Detail Informasi</a></li>
    @elseif(Auth::user()->role==6)
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="/proyek">Daftar Proyek</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/pelaksanaan/{{$proyek->id}}'>LAPJUSIK Proyek {{$proyek->projectName}}</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active">Detail Informasi</a></li>
    @endif
  </ol>
</nav>

<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Detail Informasi</p>
    <hr>

    <div class="container-fluid card card-kontrak">
        <div class="row" style="margin-left: -30px;">
            <div class="col-sm-12">
                <div class="col-sm-3 font-desc-bold"> <br><br><br>
                    <ul>
                        <li><p>Tipe Kemajuan</p></li>
                        <li><p>Tanggal Kemajuan</p></li>
                        <li><p>Nilai Kemajuan</p></li>
                        <li><p>Uraian Pekerjaan</p></li>
                    </ul>
                </div>
                <div class="col-sm-1"> <br><br><br>
                    <li><p>:</p></li>
                    <li><p>:</p></li>
                    <li><p>:</p></li>
                    <li><p>:</p></li>
                </div>
                <div class="col-sm-8 font-desc"> <br><br><br>
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
                            @foreach($listPekerjaan as $pekerjaan)
                                @if($pekerjaan->id == $informasi->pekerjaan_id)
                                    <li><p class="deskripsi" style="margin-bottom:10px;" >{{ $pekerjaan->name }}<p></li> <br>
                                @endif
                            @endforeach
                        @else
                            @foreach($listPekerjaan as $pekerjaan)
                                @if($pekerjaan->id == $informasi->pekerjaan_id)
                                    <li><p class="deskripsi" style="margin-bottom:10px;" >{{ $pekerjaan->name }} ({{ $informasi->description }})<p></li> <br>
                                @endif
                            @endforeach
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div><br>

        <div class="container-fluid card card-kontrak">
            <div class="row judul">
                <div class="font-subtitle-4" style="text-align:center">Daftar Foto</div>
             </div>
        <hr>
            <div class="row" style=" margin: 10px; height:400px;">
                <div class="col-sm-12">
                <div class="your-class">
                    @if ($foto != null)
                        @foreach ($foto as $fot)
                             <div class="responsive " >
                                    <div class="gallery">
                                        <a target="_blank">
                                            <img src="{{asset($fot->path)}}" style="object-fit:cover;object-position:60% 10%;">          
                                        </a>
                                    </div>
                            </div>
                        @endforeach
                        <div class="clearfix"></div>
                    @endif
                </div>
                <br>
                </div>
            </div>
            
        </div> <br>
        @if(Auth::user()->role==7)
        <center> <a class="btn btn-primary" href="tambah/{{$informasi->id}}" style="font-size:12pt; font-weight:bolder;">Tambah Foto</a><br><br>
        @endif
</div>
</body>
@section('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <script>
	$(document).ready( function () {
		$('.your-class').slick({
			infinite: true,				
			lazyLoad: 'ondemand',
			slidesToShow: 2,
			slidesToScroll: 2,
            dots: true
		});
		$('.alert').alert();
	});
	</script>
@endsection
</html>