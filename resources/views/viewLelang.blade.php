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
    <p>Nama Proyek : {{ $proyek->projectName }}</p>
    <p>Alamat Proyek : {{ $proyek->projectAddress }}</p>
    <p>Nama User apa ini : {{ $proyek->name }}</p>
    <p>Nama Perusahaan : {{ $proyek->companyName }}</p>
    <p>Tanggal Mulai Proyek : {{ $proyek->startDate }}</p>
    <p>Tanggal Selesai Proyek : {{ $proyek->endDate }}</p>
    <p>Deskripsi : {{ $proyek->description }}</p>
    <p>Nilai Proyek : {{ $proyek->projectValue }}</p>
    <p>Perkiraan waktu pengerjaan proyek : {{ $proyek->estimatedTime }} hari</p>
    <p>Deskripsi : {{ $proyek->description }}</p>
</body>
</html>
