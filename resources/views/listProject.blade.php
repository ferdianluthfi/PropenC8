<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daftar Proyek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <style>
        div#proyekPoten{
            background-color:#9fc5e8;
            text-align : center;
            width : 800px;
            border-radius: 15px;
        } 

        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }
    </style>

</head>
<body>
    <center>
    <div id="proyekPoten">
        <h1>Proyek Potensial</h1>
        @foreach($proyekPoten as $pPoten)
            <p>{{$pPoten->projectName}}</p>
            <p>{{$pPoten->companyName}}</p>
            <a href="/proyek/setujuiProyek/{{ $pPoten->id }}">Lihat Proyek</a>
        @endforeach
    </div>
    </center>

    <br>

    <center>
    <div id = "RiwayatProyek">
        <h1>Riwayat Proyek</h1>
        <table = id="tabel1">
            <tr>
                <th>Nama Proyek</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
            @foreach($proyekNonPoten as $pNonPoten)
            <tr>
                <td><a href="/proyek/detailProyek/{{ $pNonPoten->id }}">{{$pNonPoten->projectName}}</a></td>
                <td>{{$pNonPoten->created_at}}</td>
                @if($pNonPoten->approvalStatus == 1)
                    <td>Disetujui Direksi</td>
                @elseif($pNonPoten-> approvalStatus == 2)
                    <td>Sedang Berjalan</td>
                @else
                    <td>Ditolak</td>
                @endif
            </tr>
            @endforeach
        </table>
    </div> 
    </center>

</body>
</html>

