<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Detail Proyek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <h1>Detail Proyek</h1>
</head>
<body>
<!-- Jangan lupa ganti variabel pnya karena jelek -->
    <h1>Detail Informasi Proyek Perangkat Lunak</h1>
    <h3>Infomasi Umum<h3>
    <p>{{$status}}</p>
    @foreach($proyek as $p)    
    <p>Staff Marketing   : {{ $p->name }}</p> 
    <p>Nama Proyek       : {{ $p->projectName }}</p>
    <p>Nama Perusahaan   : {{ $p->companyName }}</p> 
    <p>Alamat Proyek     : {{ $p->projectAddress }}</p> 
    <p>Deskripsi Proyek  : {{ $p->description }}</p> 
    <p>Nilai Proyek      : Rp {{ $p->projectValue }},-</p> 
    <p>Data Proyek       :</p>  
    <a href="">Berkas Kontrak</a>
    <a href="">LAPJUSIK</a>
    <a href="">LPJ</a>
    <br>
    <br>
    @endforeach 
</body>
</html>