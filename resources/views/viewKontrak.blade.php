@extends('layouts.layout')


<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <!-- Our Custom CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
    
</head>


<!-- Breadcrumbs (ini buat navigation yaa) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="/proyek">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="/proyek/detailProyek/{{ $proyek->id }}">Detail Proyek {{ $proyek->projectName }}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="/proyek/{{ $proyek->id }}/lihatKontrak/">Overview Kontrak Kerja {{ $proyek->projectName }}</a></li>  
  </ol>
</nav>

@section('content')
@include('layouts.nav')


<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <br>
    <div class="row">
        <div class="col-sm-7">
            <p class="font-title" style="margin-top: 20px; margin-left: 20px">Overview Kontrak Kerja</p>
        </div>
        <div class="col-sm-5">
            <p style="text-align: right; margin-right: 20px; margin-top: 30px; color: blue">{{ $statusHuruf }}</p>
        </div>
    </div>
    <br><br>
    <div class="container-fluid card card-kontrak">
        <div class="row judul">
            <div class="col-sm-9 font-subtitle-4">Informasi Umum</div>
            @if(Auth::user()->role == 3)
            <a href="{{ route('buat-kontrak', $proyek->id) }}"  class="btn btn-primary" style="margin-left:50px;" >Ubah Kontrak</a><br><br>
            @endif
        </div>
    <hr>
    <div class="row" >
        <div class="col-sm-6">
                <div class="col-sm-6 font-desc-bold">
                    <ul>
                        <li><p>Nama Proyek</p></li>
                        <li><p>Nama Perusahaan</p></li>
                        <li><p>Estimasi Pengerjaan</p></li>
                        <li><p>Alamat Proyek</p></li>
                    </ul>
                </div>
                <div class="col-sm-6 font-desc">
                    <ul>
                        <li><p>:   {{ $proyek->projectName}}<p></li>
                        <li><p>:   {{ $proyek->companyName}}<p></li>
                        <li><p>:   {{ $proyek->estimatedTime}} hari<p></li>
                        <li><p>:   {{ $proyek->projectAddress}}<p></li>
                    </ul>
                </div>
            </div>
        <div class="col-sm-6">
                <div class="col-sm-5 font-desc-bold">
                    <ul>
                        <li><p>Nama Pelaksana</p></li>
                        <li><p>Nilai Proyek</p></li>
                        <li><p>Tanggal Kontrak</p></li>
                        <li><p>Penanggung Jawab</p></li>
                    </ul>
                </div>
                <div class="col-sm-7 font-desc">
                    <ul>
                        <li><p>:   {{ $proyek->name}}<p></li>
                        <li><p>:   Rp{{ $proyek->projectValue }}
                        <li><p>:   {{ $tanggals }}<p></li>
                        <li><p>:   {{ $proyek->name }}<p></li>
                    </ul>
                </div>
                </div>
        </div>
    </div>
    <br>
    <div class="container-fluid card card-kontrak">
            <div class="font-subtitle-4" style="text-align: center">Berkas Surat Kontrak Kerja</div>
        
        <hr>
        <table id="datatable" data-page-length='25' class="table table-striped table-bordered" >
            <thead>
            <tr>
                <th style="text-align: center">Nama Surat</th>
                <th style="text-align: center">Tanggal Dibuat</th>
                <th style="text-align: center">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listKontrak as $kontrak)
            <tr>
                <td >{{$kontrak->title}}</td>
                
                <td style="text-align: center">{{$kontrak->created_at}}</td>
                <td style="text-align: center">
                    <a href="{{ Storage::url($kontrak->path) }}" title="View file">
                    
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <a href="{{ route('download-surat-kontrak', $kontrak->id) }}" title="Download file {{$kontrak->title}}">
                        <i class="glyphicon glyphicon-download"></i>
                    </a>
                    <a href="{{ route('delete-surat-kontrak', $kontrak->id) }}" title="Delete file {{$kontrak->title}}">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </td>
            </tr>
            </tbody>
            @endforeach
        </table>
    </div>
    <br>
    <br>

@if(Auth::user()->role == 2 && $kontrak->approvalStatus == 0 && $proyek->approvalStatus == 5)

<div class="row" style="margin-top: 20px; ">
    <div class="col-sm-4"> </div>
    <div class="col-sm-2"> 
        <form action="/proyek/{{$proyek->id}}/kontrak/disapprove" method="POST" id="reject">
            @csrf
            <button id="tolak" class="button-disapprove font-approval">TOLAK</button>
        </form> 
    </div>
    <div class="col-sm-2"> 
        <form action="/proyek/{{$proyek->id}}/kontrak/approve" method="POST" id="save">
            @csrf
            <button id="simpan" class="button-approve font-approval">SETUJUI</button>
        </form>    
    </div>
    <div class="col-sm-4"> </div>
</div>
    <br>
    <br>
    </div>
</div>

<div id="myMod" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">
                    <h4 class="modal-title"></h4>	
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body">
					<p class="text-center">Kontrak kerja berhasil disetujui.</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
				</div>
			</div>
		</div>
	</div>     

    <div id="mod" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">			
					<h4 class="modal-title"></h4>	
				</div>
				<div class="modal-body">
					<p class="text-center">Kontrak kerja berhasil ditolak.</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-block" data-dismiss="modal" id="NO">OK</button>
				</div>
			</div>
		</div>
	</div>   

@endif


</div>

@endsection



    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js" integrity="sha256-+h0g0j7qusP72OZaLPCSZ5wjZLnoUUicoxbvrl14WxM=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/umd/util.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
            $(".simpan").click(function(e){
                //checks if it's valid
                //horray it's valid
                $("#myMod").modal("show");
            });


            $("#simpan").click(function(e){
                e.preventDefault();
                //checks if it's valid
                //horray it's valid
                $("#myMod").modal("show");
                
            });
            $("#OK").click(function(e){
                $('#save').submit();
            });
            
            $("#tolak").click(function(e){
                e.preventDefault();
                //checks if it's valid
                //horray it's valid
                $("#mod").modal("show");
            
            });
            $("#NO").click(function(e){
                $('#reject').submit();
            });
        });

    </script>
    @endsection 


