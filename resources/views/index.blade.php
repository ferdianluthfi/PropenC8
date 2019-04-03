<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Daftar Proyek</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
	<link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}" >
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type=""> -->
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" type="">
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
<body style="background-color: #f4f4f4;">
	<div class="container">
		<a href="/proyek/"> Proyek > </a>
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
				<h1 style="text-align:center;">Daftar Proyek Potensial</h1>
				<div class="row">
					<!-- <div class="col-md-3">
						<a href="/proyek/tambah">
							<div class="add-project">
								<center><img src="https://image.flaticon.com/icons/svg/109/109526.svg"   style="width:70px;height:100px;"><center>
								<p> Tambah Proyek </p>
							</div>
						</a>
					</div> -->
					<div class="col-md-12">
						<div class="your-class">
							@foreach($proyekPoten as $pPotensial)
								
								<div class="col-md-6 project">
									
										<center class="turncate"><a href="/proyek/setujuiProyek/{{$pPotensial->id}}">{{ $pPotensial->projectName }}</a><center>
										<center class="turncate">{{ $pPotensial->companyName }}<center>
									<!-- </a> -->
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
				<h1 style="text-align:center;">Riwayat Proyek</h1>
				<div class="card-table">
					<div class="panel-body">
						<table id="datatable">
							<thead>
								<tr class="title">
									<th>Nama Proyek</th>
									<th>Status</th>
									<th>Waktu</th>
								</tr>
							</thead>
							<tbody >
							@foreach($proyekNonPoten as $pNonPotensial)
									<tr style="background-color: aliceblue;">
										<td><a href="/proyek/detailProyek/{{ $pNonPotensial->id }}">{{ $pNonPotensial->projectName }}</a></td>
										@if($pNonPotensial->approvalStatus === 1) <td> Disetujui Direksi </td>
										@else	<td> Ditolak </td>
										@endif
										
										<td>{{ $pNonPotensial->created_at }}</td>
									</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
  </div>

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
</body>	
</html>