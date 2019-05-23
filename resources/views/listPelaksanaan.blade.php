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

        <style>
            .vl {
                border-left: 1px solid lightgray;
                height: 280px;
                margin: 0px 0px 10px 50px;
            }
        </style>
    </head>

    <body>
    
    @section ('content')
    @include('layouts.nav')
       
        
    @if(Auth::user()->role == 6)
     <nav aria-label="breadcrumb" style="margin-left:-135px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Daftar Proyek</a></li>
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" >LAPJUSIK Proyek {{$namaProyek}}</a></li>
            </ol>
        </nav>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="container-fluid card col-md-8" style="min-height:300px;">
            <div class="row"><br>
                <div class="col-md-7" style="margin-right:-50px;">
                    <h2 class="font-title" style="text-align:center;">Daftar LAPJUSIK</h2>
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
                                            @if($pelaksanaan->approvalStatus == 1)
                                                <td><a a class="btn" style=" background-color: whitesmoke;  color: orange; border: 1px solid" href="/pelaksanaan/download/{{$pelaksanaan->id}}">Unduh</a></td>
                                                <td>
                                                    <a class="btn" style=" background-color: whitesmoke;  color: grey; border: 1px solid">
                                                        <span>
                                                            Hapus
                                                        </span>
                                                    </a>
                                                </td>
                                            @elseif($pelaksanaan->approvalStatus == 2 || $pelaksanaan->approvalStatus == 0)
                                                <td><a a class="btn" style=" background-color: whitesmoke;  color: grey; border: 1px solid">Unduh</a></td>
                                                <td>
                                                    <a class="btn" style=" background-color: whitesmoke;  color: red; border: 1px solid"  data-toggle="modal" data-target="#myModal-<?php echo $pelaksanaan->id ?>">
                                                        <span>
                                                            Hapus
                                                        </span>
                                                    </a>
                                                </td>
                                            @endif
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
                <div class="col-md-1">
                    <div class="vl">
                    </div>
                </div>
                <div class="container-fluid col-md-4">
                <div style="min-height:280px; padding:10px;margin-right:-40px;">
                <div class="judul">
                    <div class="font-subtitle-5" style="text-align: center;margin-top:-30px;margin-right:25px;">Buat Ulang LAPJUSIK</div>
                </div>
                <div>
                    <center><span class="labels font-subtitle-5">Bulan Ke</span></center> <br>
                    <select id="changeButton" name="bulanke" class="content bg-1" style="height:38px;"  onchange="myFunction()">
                    @if($draftFlag == null)
                        <option value="" disabled selected>Belum ada LAPJUSIK dihapus</option>
                    </select>
                        <center><p>Sistem akan membuat ulang LAPJUSIK proyek yang sebelumnya telah dihapuskan oleh Manajer Pelaksana</p> <br>
                    @else
                        @if($flaggedPelaksanaan != null)
                            <option value="" disabled selected>-- Pilih Bulan --</option>
                            <option value="{{$flaggedPelaksanaan->id}}" >{{$flaggedPelaksanaan->bulan}}</option>
                            </select>
                            <center><p>Sistem akan membuat ulang LAPJUSIK proyek yang sebelumnya telah dihapuskan oleh Manajer Pelaksana</p><br>
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
                            <br>
                        @else    
                            <option value="" disabled selected>-- Pilih Bulan --</option>          
                            @foreach($draftFlag as $flagged)
                                <option value="{{$flagged->id}}">{{$flagged->bulan}}</option>
                                
                                
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
                            @endforeach

                            </select>
                                <center><p>Sistem akan membuat ulang LAPJUSIK proyek yang sebelumnya telah dihapuskan oleh Manajer Pelaksana</p> <br>
                                <a id="buttonUlang" class="btn btn-primary" data-toggle="modal" >
                                    <span>
                                        Buat Ulang LAPJUSIK
                                    </span>
                                </a>

                                @foreach($draftFlag as $flagged)
                                <div class="modal fade" id="myModal-<?php echo $flagged->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title" style="text-align:center;">Buat Ulang LAPJUSIK? </h4>
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
                            @endforeach
                        @endif
                    @endif 
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>

        
        
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="card col-md-8">
        <br>
                    <h2 class="font-title" style="text-align:center;">Daftar Informasi Proyek</h2>
                        <div class="panel-body">
                            <table id="datatable1" class="table table-striped table-bordered text-center">
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
                                <tbody >
                            </table>
                        </div>
                </div>
        <div class="col-md-2"></div>
    </div>



    @else
    <nav aria-label="breadcrumb" style="margin-left:0px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Daftar Proyek</a></li>
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" >LAPJUSIK Proyek {{$namaProyek}}</a></li>
            </ol>
        </nav>
    <div class="row" style="margin-left: 160px;">
        <div class="container-fluid card col-md-6" style="width:910px;min-height:280px;margin:0 30px;">
            <div class="row">
                <div class="col-md-12"><br>
                    <h2 class="font-title" style="text-align:center;">Daftar LAPJUSIK</h2>
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
                                            <td><a a class="btn" style=" background-color: whitesmoke;  color: orange; border: 1px solid" href="/pelaksanaan/download/{{$pelaksanaan->id}}">Unduh</a></td>
                                                <td>
                                                <a class="btn" style=" background-color: whitesmoke;  color: red; border: 1px solid"  data-toggle="modal" data-target="#myModal-<?php echo $pelaksanaan->id ?>">
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
        function myFunction() {
        var x = document.getElementById("changeButton").value;
        var y = "#myModal-" + x;
        document.getElementById("buttonUlang").setAttribute("data-target", y);
}
    </script>

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
            $('#datatable1').DataTable();
            $('.alert').alert();
        });
        </script>
        @endsection
    </body>
</html>