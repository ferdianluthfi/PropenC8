@extends('layouts.layout')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TRAYEK</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type=""> -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" type=""> -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --> 
        
        <!-- Bootstrap CSS CDN -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <!-- Our Custom CSS -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>
    
    @section ('content')
    @include('layouts.nav')
        <nav aria-label="breadcrumb" style="margin-left:-200px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" >LAPJUSIK Proyek {{$namaProyek}}</a></li>
            </ol>
        </nav>

        <div class="container">
            <div class="row bigCard" style="margin:3px;">
                <div class="col-md-12">
                    <h2 class="font-title" style="text-align:center;margin:5px;">Daftar LAPJUSIK</h2>
                        <div class="panel-body">
                            <table id="datatable" class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr class="title">
                                    <th><center> Nama LAPJUSIK</th>
                                    <th><center> Status LAPJUSIK</th>
                                    <th><center> Tanggal Dibuat</th>
                                    <th><center> Lihat </th>
                                    @if(Auth::user()->role == 6)
                                        <th><center> Unduh </th>
                                        <th><center> Hapus </th>
                                    @endif
                                    </tr>
                                </thead>
                                <tbody >
                                @foreach($listPelaksanaan as $pelaksanaan)
                                    @if($pelaksanaan->flag == 1)
                                        <tr style="background-color: whitesmoke;">
                                            <td>LAPJUSIK Bulan {{$pelaksanaan->bulan}}</td>
                                            @if( $pelaksanaan->approvalStatus == 0)
                                                <td style="color:blue">MENUNGGU PERSETUJUAN</td>
                                            @elseif( $pelaksanaan->approvalStatus == 1)
                                                <td style="color:#00C48C">DISETUJUI</td>
                                            @elseif( $pelaksanaan->approvalStatus == 2)
                                                <td style="color:#FF647C">DITOLAK</td>
                                            @endif
                                            <td>{{ date('F d' , strtotime($pelaksanaan->createdDate)) }}</td>
                                            <td><a href="/pelaksanaan/detail/{{$pelaksanaan->id}}" class="btn btn-primary">Lihat</a></td>
                                            @if(Auth::user()->role == 6)
                                                <td><a class="btn btn-warning" href="/pelaksanaan/download/{{$pelaksanaan->id}}">Unduh</a></td>
                                                <td>
                                                <a class="btn btn-danger" data-toggle="modal" data-target="#myModal-<?php echo $pelaksanaan->id ?>">
                                                    <span>
                                                        Hapus
                                                    </span>
                                                </a>
                                                </td>
                                            @endif
                                        </tr>
                                        
                                        <div class="modal fade" id="myModal-<?php echo $pelaksanaan->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" style="text-align:center;">Hapus LAPJUSIK?</h4>
                                                    </div>
                                                    <div class="modal-body" style="text-align:center;">
                                                        <p>Pelaksanaan yang sudah terbuat sebelumnya akan dihapus.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <center><a href="" class="btn btn-primary ">Kembali</a>
                                                        <a href="/pelaksanaan/delete/{{$pelaksanaan->id}}" class="btn btn-default" style="color:red;">Hapus</a></center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>

        <br>

        @if(Auth::user()->role == 6)
    
            <div class="container">
                <div class="row bigCard">
                    <div class="col-md-12">
                        <div class="card-table">
                        <h4 style="text-align:center;">Buat Ulang LAPJUSIK</h4><br>
                        
                        <div class="content bg1">
                            <span class="labels">Bulan Ke</span>
                            <select name="bulanke" class="content bg1">
                            @if($draftFlag == null)
                                </select>
                                <center><p>Sistem akan membuat ulang LAPJUSIK proyek</p>
                                <p>yang sebelumnya telah dihapuskan oleh Manajer Pelaksana</p> <br>
                            @else
                                @if($flaggedPelaksanaan != null)
                                    <option value="{{$flaggedPelaksanaan->id}}" >{{$flaggedPelaksanaan->bulan}}</option>
                                    </select>
                                    <center><p>Sistem akan membuat ulang LAPJUSIK proyek</p>
                                    <p>yang sebelumnya telah dihapuskan oleh Manajer Pelaksana</p> <br>

                                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                        <span>
                                            Buat Ulang LAPJUSIK
                                        </span>
                                    </a>

                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title" style="text-align:center;">Buat Ulang LAPJUSIK?</h4>
                                                </div>
                                                <div class="modal-body" style="text-align:center;">
                                                    <p>Informasi kemajuan terbaru akan digabungkan.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <center><a href="" class="btn btn-default" style="color:red;">Kembali</a>
                                                    <a href="/pelaksanaan/tambah/{{$flaggedPelaksanaan->id}}" class="btn btn-primary ">Buat</a></center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @else
                                    @foreach($draftFlag as $flagged)
                                        <option value="{{$flagged->id}}" >{{$flagged->bulan}}</option>
                                    @endforeach
                                        </select>
                                        <center><p>Sistem akan membuat ulang LAPJUSIK proyek</p>
                                        <p>yang sebelumnya telah dihapuskan oleh Manajer Pelaksana</p> <br>

                                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?php echo $flagged->id ?>">
                                            <span>
                                                Buat Ulang LAPJUSIK
                                            </span>
                                        </a>

                                        <div class="modal fade" id="myModal-<?php echo $flagged->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" style="text-align:center;">Buat Ulang LAPJUSIK?</h4>
                                                    </div>
                                                    <div class="modal-body" style="text-align:center;">
                                                        <p>Informasi kemajuan terbaru akan digabungkan.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <center><a href="" class="btn btn-default" style="color:red;">Kembali</a>
                                                        <a href="/pelaksanaan/tambah/{{$flagged->id}}" class="btn btn-primary ">Buat</a></center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        <br>
            <div class="container">
                <div class="row bigCard">
                    <div class="col-md-12">
                        <h2 style="text-align:center;">Daftar Informasi Proyek</h2><br>
                        <div class="card-table">
                            <div class="panel-body">
                                <table id="datatable" class="table table-striped table-bordered text-center">
                                    <thead>
                                        <tr class="title">
                                        <th><center> Uraian Pekerjaan</th>
                                        <th><center> Tanggal Kemajuan</th>
                                        <th><center> Detail </th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    @foreach($listInformasi as $informasi)
                                    <tr style="background-color: whitesmoke;">

                                        @if( $informasi->description == NULL)
                                            @foreach($listPekerjaan as $pekerjaan)
                                                @if($pekerjaan->id == $informasi->pekerjaan_id)
                                                    <td>{{ $pekerjaan->name }} </td>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach($listPekerjaan as $pekerjaan)
                                                @if($pekerjaan->id == $informasi->pekerjaan_id)
                                                    <td>{{ $pekerjaan->name }} ({{ $informasi->description }})</td>
                                                @endif
                                            @endforeach
                                        @endif
                                                <td>{{ date('F d' , strtotime($informasi->reportDate)) }}</td>
                                                <td><a href="/informasi/detail/{{$informasi->id}}" class="btn btn-primary">Lihat</a></td>
                                            </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        @endif
    @endsection

    @section("scripts")
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js" integrity="sha256-+h0g0j7qusP72OZaLPCSZ5wjZLnoUUicoxbvrl14WxM=" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/umd/util.js"></script> -->

    <script>
        $(document).ready( function () {
            $('.your-class').slick({
                infinite: true,				
                lazyLoad: 'ondemand',
                slidesToShow: 3,
                slidesToScroll: 3,
                dots: true
            });
            $('#datatable').DataTable();
            $('.alert').alert();
        });
        </script>
        @endsection
    </body>
</html>
