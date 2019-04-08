@extends('layouts.layout')

<!-- Punya Momo -->
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Daftar Proyek</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
	<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}" >
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	
</head>
<!-- INI PUNYA STAFF MARKETING -->
@if(Auth::user()->role == 3)
@section ('content')
@include('layouts.nav')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="{{ url('proyek') }}">Proyek</a></li>
		</ol>
	</nav>

	<div class="container">
		<div class="row bigCard">
			<div class="col-md-12">
				@if(session('flash_message'))
					<div class="alert alert-success alert-dismissible" style="margin: 15px;" role="alert">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong> {{ session('flash_message') }} </strong>
					</div>
				@endif
				<h2 style="text-align:center;">Daftar Proyek Potensial</h2><br>
				<div class="row">
					
					<div class="col-md-12">
						<div class="your-class">
							@foreach($proyekPoten as $proyeks)
								
								<div class="col-md-6 project">
									
										<center class="turncate" style="font-size:12pt; font-weight:bolder;">{{ $proyeks->projectName }}<center>
										<center class="turncate">{{ $proyeks->companyName }}<center>
										<center><a class="btn btn-primary" href="/proyek/setujuiProyek/{{ $proyeks->id }}" style="font-size:8pt; font-weight:bolder;">Lihat</a> <center>
										
								</div>
							
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row bigCard">
			<div class="col-md-12">
				<h2 style="text-align:center;">Riwayat Proyek</h2><br>
				<div class="card-table">
					<div class="panel-body">
						<table id="datatable">
							<thead>
								<tr class="title">
									<th><center>Nama Proyek</th>
									<th><center>Waktu</th>
									<th><center>Status</th>
									<th><center>Lihat Proyek</th>
								</tr>
							</thead>
							<tbody >
							@foreach($proyekNonPoten as $proyeks)
								<tr style="background-color: whitesmoke;">
									<td><center>{{ $proyeks->projectName }}</td>
									<td><center>{{ $proyeks->created_at }}</td>
									@if($proyeks->approvalStatus === 1) <td style="color:blue; "><center> DISETUJUI</td>
									@elseif($proyeks->approvalStatus === 2) <td style="color:limegreen;"><center> SEDANG BERJALAN </td>
									@else <td style="color:red;"><center> DITOLAK </td>
									@endif
									<td><center><a class="btn btn-primary" href="/proyek/detailProyek/{{ $proyeks->id }}">Lihat</a>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
 	</div>
@endsection

<!--INI PUNYA SI PROJECT MANAGERR-->
@elseif(Auth::user()->role == 7)
@section ('content')
@include('layouts.nav')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
    </ol>
</nav>

<div class="container">
    <div class="row bigCard">
        <div class="col-md-12">
            @if(session()->has('flash_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="material-icons">&#xE876;</i>Berhasil!</strong> {{session('flash_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <h2 style="text-align:center;">Daftar Proyek Siap Lelang</h2><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="your-class">
                        @foreach($proyekPoten as $proyeks)
                        <!-- @if($proyeks->approvalStatus == 0) -->
                        <div class="col-md-6 project">
                            <!-- <a href="/proyek/lihat/{{$proyeks->id}}"> -->
                            <center class="turncate"><a href="/proyek/lihat/{{$proyeks->id}}" style="font-size:12pt; font-weight:bolder;">{{ $proyeks->projectName }}</a><center>
                        </div>
                        <!-- @endif -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
@endsection
@endif

@section('scripts')
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
</html>