@extends('layouts.layout')

<html>
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

@if(Auth::user()->role == 5)
@section ('content')
@include('layouts.nav')
<body>
<!-- INI BUAT PROGRAM MANAGER -->
<div class="container-fluid card card-detail-proyek">
    <br>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <br>
    <p class="font-subtitle-1">Rincian Berkas Lelang</p>
    <hr>
    <div>
        <p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName }}</p>
        <br>
    </div>
    <div class="row ketengahin">
        <div class="col-sm-7">
            <div class="card card-info">
                <div class="row judul">
                    <div class="col-sm-9 font-subtitle-4">Informasi Umum</div>
                    <div class="col-sm-1 font-status-approval">{{ $status }}</div>
                </div>
                <hr style="background-color:black;"/>
                <div class="row">
                    <div class="col-sm-5 font-desc-bold" style="margin-left: 30px;">
                        <ul>
                            <li><p>Nama Staf Marketing</p></li>
                            <li><p>Nama Proyek</p></li>
                            <li><p>Nama Perusahaan</p></li>
                            <li><p>Estimasi Waktu Pengerjaan</p></li>
                            <li><p>Alamat Proyek</p></li>
                            <li><p>Deskripsi Proyek</p></li>
                            <li><p>Nilai Proyek</p></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 font-desc">
                        <ul>
                            <li><p>:   {{ $proyek->name}}<p></li>
                            <li><p>:   {{ $proyek->projectName}}<p></li>
                            <li><p>:   {{ $proyek->companyName}}<p></li>
                            <li><p>:   {{ $proyek->estimatedTime}} hari<p></li>
                            <li><p>:   {{ $proyek->projectAddress}}<p></li>
                            <li><p>:   {{ $proyek->description}}<p></li>
                            <li><p>:   Rp {{ $proyek->projectValue}}<p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="card card-pm">
                <br>
                <p class="font-subtitle-5">Project Manager</p>
                <hr style="background-color:black;"/>
                <br> <br> <br>
                <p class="font-status-approval" style="text-align: center;">Belum Tersedia.</p>
            </div>
        </div>
    </div>
<!--    INI BAGIAN TOMBOL2 SI KELOLA LELANG-->
    <div>
        <br>
        <br>
        <div  class="row ketengahin" style="margin-right: 58px; margin-bottom: 30px">
            <div class="col-sm-5">
                <div class="card card-tombol" style="margin-right: 40px">
                    <div class="row judul">
                        <div class="font-subtitle-4">Buat Surat Otomatis</div>
                    </div>
                    <div style="margin: 30px; height: 60px; position: center">
                        <span>
                            <p style="text-align: justify; text-justify: inter-word">Klik tombol untuk membuat secara otomatis berkas berikut. Berkas akan langsung ditambahkan ke Daftar Berkas Lelang.</p>
                        </span>
                        <br>
                        <a href="/generate-pdf/{{ $proyek->id }}" class="btn btn-primary" style="margin-bottom: 10px; margin-left: 10px; position:center; width: 300px">Surat Penawaran Rekanan</a>
                        <br>
                        <a href="/generate-pdf2/{{ $proyek->id }}" class="btn btn-primary" style="margin-left: 10px; position:center; width: 300px">Surat Pengajuan Jaminan Bank</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-5" style="margin-left: 20px">
                <div class="card card-tombol">
                    <div class="row judul">
                        <div class="font-subtitle-4">Upload Surat</div>
                    </div>
                    <div style="margin: 30px; height: 60px; position: center">
                        <span>
                            <p style="text-align: justify; text-justify: inter-word">Jika berkas tidak ada pada pilihan Buat Berkas Otomatis, unggah berkas Anda dengan klik tombol berikut.</p>
                        </span>
                        <br>
                        <br>
                        <a href="/file/upload/{{ $proyek->id }}" class="btn btn-primary" style="margin-left: 10px; position:center; width: 300px">Upload File</a>
                    </div>
                </div>
            </div>
        </div>
<!--        <div class="row" style="margin-left: 40px">-->


<!--        </div>-->
    </div>
</div>
<div class="container-fluid card card-detail-proyek" style="padding-top: 20px">
    <table id="datatable" class="table table-striped table-bordered" >
        <caption style="text-align: center">Kelola Berkas Lelang</caption>
        <thead>
        <tr style="text-align: center">
<!--                <th>Id</th>-->
            <th>Title</th>
            <th>File Name</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($berkass as $object)
<!--            <tr>-->
<!--                <td>-->
<!--                    {{ $object->id }}-->
<!--                </td>-->
            <td>
                {{ $object->title }}
            </td>
            <td>
                {{ $object->filename }}
            </td>
            <td>
                {{ $object->created_at->diffForHumans()}}
            </td>
            <td style="text-align: center">
                <a href="{{ Storage::url($object->path) }}" title="View file {{ $object->title }}">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
<!--                    <a href="{{ route('file.response', $object->id) }}" title="Show or download file {{ $object->title }}">-->
<!--                        <span class="glyphicon glyphicon-save"></span>-->
<!--                    </a>-->
                <a href="{{ route('file.download', $object->id) }}" title="Download file {{ $object->title }}">
                    <i class="glyphicon glyphicon-download"></i>
                </a>
                <a href="/file/{{ $object->id }}/delete" title="Delete file {{ $object->title }}">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
@endsection

<!--INI BUAT STAFF MARKETING-->
@elseif(Auth::user()->role == 3)
@section ('content')
@include('layouts.nav')
<body>
<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Rincian Berkas Lelang</p>
    <hr>
    <div>
        <p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName }}</p>
        <br>
    </div>
    <div class="row ketengahin">
        <div class="col-sm-7">
            <div class="card card-info">
                <div class="row judul">
                    <div class="col-sm-9 font-subtitle-4">Informasi Umum</div>
                    <div class="col-sm-1 font-status-approval">{{ $status }}</div>
                </div>
                <hr style="background-color:black;"/>
                <div class="row">
                    <div class="col-sm-5 font-desc-bold" style="margin-left: 30px;">
                        <ul>
                            <li><p>Nama Staf Marketing</p></li>
                            <li><p>Nama Proyek</p></li>
                            <li><p>Nama Perusahaan</p></li>
                            <li><p>Estimasi Waktu Pengerjaan</p></li>
                            <li><p>Alamat Proyek</p></li>
                            <li><p>Deskripsi Proyek</p></li>
                            <li><p>Nilai Proyek</p></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 font-desc">
                        <ul>
                            <li><p>:   {{ $proyek->name}}<p></li>
                            <li><p>:   {{ $proyek->projectName}}<p></li>
                            <li><p>:   {{ $proyek->companyName}}<p></li>
                            <li><p>:   {{ $proyek->estimatedTime}} hari<p></li>
                            <li><p>:   {{ $proyek->projectAddress}}<p></li>
                            <li><p>:   {{ $proyek->description}}<p></li>
                            <li><p>:   Rp {{ $proyek->projectValue}}<p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="card card-pm">
                <br>
                <p class="font-subtitle-5">Project Manager</p>
                <hr style="background-color:black;"/>
                <br> <br> <br>
                <p class="font-status-approval" style="text-align: center;">Belum Tersedia.</p>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid card card-detail-proyek" style="padding-top: 20px">
    <table id="datatable" class="table table-striped table-bordered" >
        <caption style="text-align: center">Kelola Berkas Lelang</caption>
        <thead>
        <tr style="text-align: center">
            <!--                <th>Id</th>-->
            <th>Title</th>
            <th>File Name</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($berkass as $object)
        <!--            <tr>-->
        <!--                <td>-->
        <!--                    {{ $object->id }}-->
        <!--                </td>-->
        <td>
            {{ $object->title }}
        </td>
        <td>
            {{ $object->filename }}
        </td>
        <td>
            {{ $object->created_at->diffForHumans()}}
        </td>
        <td style="text-align: center">
            <a href="{{ Storage::url($object->path) }}" title="View file {{ $object->title }}">
                <span class="glyphicon glyphicon-eye-open"></span>
            </a>
            <!--                    <a href="{{ route('file.response', $object->id) }}" title="Show or download file {{ $object->title }}">-->
            <!--                        <span class="glyphicon glyphicon-save"></span>-->
            <!--                    </a>-->
            <a href="{{ route('file.download', $object->id) }}" title="Download file {{ $object->title }}">
                <i class="glyphicon glyphicon-download"></i>
            </a>
        </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
@endsection

@endif

@section('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js" integrity="sha256-+h0g0j7qusP72OZaLPCSZ5wjZLnoUUicoxbvrl14WxM=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/umd/util.js"></script>

<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    });
</script>
@endsection


</html>
