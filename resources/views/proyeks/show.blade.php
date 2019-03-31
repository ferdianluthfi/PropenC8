<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
</head>
<body>

@foreach($proyeks as $proyek)
<div class="container bg-grey">
		<div class="container">
				<a href="/proyek/"> Proyek > Detail Proyek {{ $proyek->projectName}} </a>
				<br>
				<h1 style="text-align:center;">Detail Proyek {{ $proyek->projectName}}</h1>
					
				<div class="card">
					<h3> Informasi Umum {{$proyek->approvalStatus}}</h3>
					<hr class="hr-light">					
								<b>Nama Staf Marketing: </b>
								{{ $proyek->name }}
								<br>
					
								<b>Nama Proyek: </b>
								{{ $proyek->projectName }}
								<br>
					
								<b >Nama Perusahaan: </b>
								{{ $proyek->companyName }}
								<br>
					
								<b >Deskripsi: </b>
								{{ $proyek->description }} 
								<br>

								<b>Nilai Proyek: </b>
								{{ $proyek->projectValue }}
								<br>
					
								<b>Estimasi Waktu Pengerjaan: </b>
								{{ $proyek->estimatedTime }} hari
								<br>
				
								<b>Alamat Proyek: </b>
								{{ $proyek->projectAddress }}
				</div>
		</div>
</div>
@endforeach

</body>
</html>