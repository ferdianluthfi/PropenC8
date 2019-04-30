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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    </head>

    <body>
    @section ('content')
    @include('layouts.nav')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('assignedproyek') }}">Proyek</a></li>
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/proyek/detail/{{$pelaksanaan->proyek_id}}'>Detail Proyek</a></li>
                <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href='/informasi/{{$pelaksanaan->proyek_id}}'>Informasi Kemajuan</a></li>
            </ol>
        </nav>

        <div class="container">
            <div class="row bigCard">
                <div class="col-md-12">
                    <h2 style="text-align:center;">Daftar Kemajuan Proyek</h2><br>
                    <div class="card-table">
                        <div class="panel-body">
                            <table id="datatable" class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr class="title">
                                    <th> Uraian Pekerjaan</th>
                                    <th> Tanggal Pekerjaan</th>
                                    <th> Detail</th>
                                    </tr>
                                </thead>
                                <tbody >
                                @foreach($listInformasi as $informasi)
                                        <tr style="background-color: whitesmoke;">

                                            @if( $informasi->description == NULL)
                                                <th>{{ $lizWork[$informasi->pekerjaan_id - 1] }}</th>
                                            @else
                                                <th>{{ $lizWork[$informasi->pekerjaan_id - 1] }} ({{ $informasi->description }})</th>
                                            @endif
                                            <td> {{ date('F d' , strtotime($informasi->reportDate)) }}</td>
                                            <td><a href="/informasi/detail/{{$informasi->id}}" class="btn btn-primary">Lihat</a></td>
                                            <td><a class="btn btn-warning" href="/info/edit/{{$informasi->id}}">Ubah</a></td>
                                            <td>
                                            <a class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                                <span>
                                                    Hapus
                                                    <i aria-hidden="true"></i>
                                                </span>
                                            </a>
                                            </td>
                                        </tr>
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
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <a href="/info/tambah/{{$pelaksanaan->id}}" class="btn btn-primary">Tambah Informasi</a>
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