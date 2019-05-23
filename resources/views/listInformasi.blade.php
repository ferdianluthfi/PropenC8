@extends('layouts.layout')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TRAYEK</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen">

    <!-- Bootstrap CSS CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
     <!-- Our Custom CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" type=""> -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>

    <body>
    @section ('content')
    @include('layouts.nav')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('assignedproyek') }}">Daftar Proyek</a></li>
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active">Daftar Kemajuan Proyek</a></li>
            </ol>
        </nav>

        <div class="container">
            <div class="row bigCard">
                <div class="col-md-12">
                    <h2 style="text-align:center;" class="font-title">Daftar Kemajuan Proyek</h2><br>
                    <div style=" background-color: white;">
                            <a href="/info/tambah/{{$id}}" class="btn btn-primary" style=" float: right; margin-right:15px" >+ TAMBAH INFORMASI</a><br><br>
                        <div class="panel-body">
                            <table id="datatable" class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr class="title">
                                    <th><center> Uraian Pekerjaan</th>
                                    <th><center> Tanggal Pekerjaan</th>
                                    <th><center> Lihat</th>
                                    <th><center> Ubah</th>
                                    <th><center> Hapus</th>
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
                                        <td> {{ date('d F Y' , strtotime($informasi->reportDate)) }}</td>
                                        <td><a href="/informasi/detail/{{$informasi->id}}" class="btn btn-primary">LIHAT</a></td>

                                        @foreach($approvedPelaksanaan as $approved)
                                            @if($approved->id == $informasi->pelaksanaan_id)
                                                <?php $approvedIsExist = true; ?>
                                                <td><a class="btn" style=" background-color: whitesmoke;  color: grey; border: 2px solid">UBAH</a></td>
                                                <td>
                                                <a class="btn" style=" background-color: whitesmoke;  color: grey; border: 2px solid">
                                                    <span>
                                                        HAPUS
                                                    </span>
                                                </a>
                                                </td>
                                            @endif
                                        @endforeach

                                        @if($approvedIsExist==false)
                                            <td><a class="btn" style=" background-color: whitesmoke;  color: orange; border: 2px solid" href="/info/edit/{{$informasi->id}}">UBAH</a></td>
                                            <td>
                                            <a class="btn" style=" background-color: whitesmoke;  color: red; border: 2px solid" data-toggle="modal" data-target="#myModal-<?php echo $informasi->id ?>">
                                                <span>
                                                    HAPUS
                                                </span>
                                            </a>
                                            </td>
                                        @endif
                                    </tr>

                                    <?php $approvedIsExist = false; ?>
                                    
                                    <div class="modal fade" id="myModal-<?php echo $informasi->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                    <center><a href="" class="btn btn-primary ">Kembali</a>
                                                    <a href="/info/delete/{{$informasi->id}}" class="btn btn-default" style="color:red;">Hapus</a></center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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