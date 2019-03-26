<!DOCTYthE html>
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
@foreach($proyeks as $proyek)
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading"> Detail Proyek {{ $proyek->projectName}}</div>
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
		<tr>
			<td>{{ $proyek->name }}</td>
			<td>{{ $proyek->projectName }}</td>
			<td>{{ $proyek->companyName }}</td>
			<td>{{ $proyek->description }}</td>
			<td>{{ $proyek->projectValue }}</td>
			<td>{{ $proyek->estimatedTime }} hari</td>
			<td>{{ $proyek->projectAddress }}</td>
		</tr>
	</table>

            </div>
        </div>
    </div>
</div>
@endforeach

</body>
</html>