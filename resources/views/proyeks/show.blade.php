<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
</head>
<body>
	@foreach($proyeks as $proyek)
	<div class="container" style="padding:5%;">
		<h3><a href="/proyek/"> Proyek > Detail Proyek {{ $proyek->projectName}} </a></h3><br>
		<div class="row bigCard">
			<h3 class="col-md-12" style="text-align:center;">Detail Proyek </h3>
			
			@if($proyek->approvalStatus === 0)
				<h4 class="col-md-12" style="text-align:left;">Detail Proyek {{ $proyek->projectName}} <button type="button" class="btn btn-primary" style="float:right;" onclick="window.location.href='/proyek/ubah/{{ $proyek->id }}'">UBAH</button> </h4>
			@else
				<h4 class="col-md-12" style="text-align:left;">Detail Proyek {{ $proyek->projectName}} <button type="button" class="btn btn-primary disabled" style="float:right;" >UBAH</button> </h4>
			@endif
			<br><br>
			
			<div class="col-md-8 card" style="width: 50%;">
				
				<h4 > Informasi Umum &emsp; <mark style="background-color:#e3f0f3;">{{$status}}</mark> </h4>
				
				<hr style="background-color:black;"/>				
							<b>Nama Staf Marketing &nbsp;: {{ $proyek->name }}</b> <br>
				
							<b>Nama Proyek&nbsp;&emsp;&emsp;&emsp;&emsp;: {{ $proyek->projectName }} </b><br>
				
							<b >Nama Perusahaan  &nbsp;&emsp;: {{ $proyek->companyName }}</b> <br>
				
							<b >Deskripsi &nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: {{ $proyek->description }} </b><br>

							<b>Nilai Proyek &emsp;&emsp;&emsp;&emsp;&emsp;: Rp {{ $proyek->projectValue }}.- </b><br>
				
							<b>Estimasi Waktu Pengerjaan &nbsp;: {{ $proyek->estimatedTime }} hari</b> <br>
			
							<b>Alamat Proyek&nbsp;&nbsp;&emsp;&emsp;&emsp;: {{ $proyek->projectAddress }} </b>
							
			</div>
			<div class="col-md-4 card" style="width: 20%;">
				<h4 style="text-align:center;"> Project Manager</h4>
				<hr style="background-color:black;"/><br><br>					
				<h4 style="text-align:center;"> Belum Tersedia </h4>
			</div>
			<div class="col-md-12" style="padding:20px; margin:20px;">
				<div class="berkas">
					<button type="button" class="btn btn-primary disabled">BERKAS KONTRAK </button>
				</div>
				<div class="lapjusik">
					<button type="button" class="btn btn-primary disabled">LAPJUSIK </button>
				</div>
				<div class="lpj">
					<button type="button" class="btn btn-primary disabled">LPJ </button>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</body>
</html>