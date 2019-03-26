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
	<h3>Tambah Proyek Potensial</h3>

	@if(session()->has('flash_message'))
		<p class="single-alert">{{session('flash_message')}}</p>
	@endif

	<form action="/proyek/store" method="post">
		{{ csrf_field() }}
        Nama Staf Marketing <input type="text" name="name" required="required" placeholder="Risa"> <br/>
		Nama Proyek <input type="text" name="projectName" required="required" placeholder="Proyek Tol"> <br/>
		Nama Perusahaan <input type="text" name="companyName" required="required" placeholder="PT NKD"> <br/>
		Deskripsi <textarea name="description" required="required" placeholder="Penjelasan proyek"></textarea> <br/>
		Nilai Proyek <input type="number" name="projectValue" required="required" placeholder="50.000.000"> <br/>
        Estimasi Waktu Pengerjaan <input type="number" name="estimatedTime" required="required" placeholder="120"> hari<br/>
        Alamat Proyek <textarea name="projectAddress" required="required" placeholder="Depok"></textarea> <br/>
		<input type="submit" value="Simpan Data">
	</form>
</body>
</html>