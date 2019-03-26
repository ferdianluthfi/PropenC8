<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
	<h3>Potensial Proyek</h3>

	<a href="/proyek/tambah"> + Tambah Proyek Potensial Baru</a>
	
	<br/>
	<br/>
    @if(session()->has('flash_message'))
		<p class="single-alert">{{session('flash_message')}}</p>
	@endif
	<table border="1">
		<tr>
			<th>Nama Staf Marketing</th>
			<th>Nama Proyek</th>
			<th>Nama Perusahaan</th>
			<th>Deskripsi</th>
			<th>Nilai Proyek</th>
            <th>Estimasi Waktu Pengerjaan</th>
            <th>Alamat Proyek</th>
		</tr>
		@foreach($proyek as $proyeks)
		<tr>
			<td>{{ $proyeks->name }}</td>
			<td><a href="/proyek/lihat/{{$proyeks->id}}">{{ $proyeks->projectName }}</a></td>
			<td>{{ $proyeks->companyName }}</td>
			<td>{{ $proyeks->description }}</td>
			<td>{{ $proyeks->projectValue }}</td>
			<td>{{ $proyeks->estimatedTime }}</td>
			<td>{{ $proyeks->projectAddress }}</td>
			<td>
				<a href="/proyek/ubah/{{ $proyeks->id }}">Edit</a>
				|
				<a href="/proyek/hapus/{{ $proyeks->id }}">Hapus</a>
			</td>
		</tr>
		@endforeach
	</table>


</body>
</html>
