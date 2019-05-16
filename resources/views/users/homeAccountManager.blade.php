@extends('layouts.layout')
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TRAYEK</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}" >

    <!-- Bootstrap CSS CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	
     <!-- Our Custom CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

@section ('content')
@include('layouts.nav')
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="margin-left:100px;">
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('homeAccountManager') }}">Beranda</a></li>
		</ol>
		</nav>

		<div class="container">
		<div class="row bigCard" style="margin 0 auto;">
			<div id="myTabContent" class="tab-content">
				<!-- PraLelang -->
				<div class="tab-pane" id="pra" style="display:block">
					<div class="col-md-12">
								<h2 class="font-title" style="text-align:center;">Daftar Akun</h2>
								<hr>
								<div class="panel-body" style="text-align:center;">
									<table id="datatable-1" class="table table-striped table-bordered text-center">
										<thead>
											<tr class="title" style="background-color: whitesmoke;">
												<th><center>Nama Pengguna</th>
												<th><center>Role</th>
												<th><center>Status</th>
												<th><center>Lihat</th>
											</tr>
										</thead>
										<tbody >
										@foreach($users as $user)
											<tr style="background-color: white;">
												<td>{{ $user->name }}</td>
												<td>
												@switch($user->role)
													@case(1)
														Manajer Akun
														@break
													@case(2)
														Direksi
														@break
													@case(3)
														Staf Marketing
														@break
													@case(4)
														Manajer Marketing
														@break
													@case(5)
														Program Manajer
														@break
													@case(6)
														Manajer Pelaksana
														@break
													@case(7)
														PM
														@break
													@case(8)
														Klien
														@break
													@endswitch
												</td>	
												<td>
												@switch($user->status)
													@case(0)
														Aktif
														@break
													@case(1)
														Tidak Aktif
														@break
													@endswitch
												</td>
												<td><center><a class="btn btn-primary" href="/user/lihat/{{ $user->id }}">Lihat</a>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
					</div>
				</div>
			</div>
		</div>
</div>
@include('layouts.footer')
@endsection

@section('scripts')
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js" integrity="sha256-+h0g0j7qusP72OZaLPCSZ5wjZLnoUUicoxbvrl14WxM=" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	
	<script>
	$(document).ready( function () {
		$('.your-class').slick({
			infinite: true,				
			lazyLoad: 'ondemand',
			slidesToShow: 3,
			slidesToScroll: 3,
			dots: true
		});
		$('.alert').alert();
		$('#datatable-1').DataTable();
	});
	</script>
@endsection