@extends('layouts.layout')

<head>

    <!-- Bootstrap CSS CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
     <!-- Our Custom CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>   -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@section('content')
@include('layouts.nav')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Daftar Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="/proyek/detailProyek/{{$proyek->id}}">Detail Proyek {{ $proyek->projectName }}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="/proyek/{{$proyek->id}}/kontrak/buat">Buat Kontrak Kerja</a></li>  
  </ol>
</nav>

<!-- isi -->
<div class="container-fluid card card-detail-proyek">
    <br>
    <p style="text-align:left; margin-left:30px;" class="font-subtitle-1">Buat Kontrak Kerja</p>
    <hr>
    <div class="row judul" style="margin-bottom:15px; margin-top:-10px;">
       
    </div>
    <div class="container-fluid card card-kontrak">
        <div class="row judul">
            <div class="col-sm-9 font-subtitle-4">Informasi Umum</div>
        </div>
    <hr>
    <div class="row" style="margin-left: 0px;">
        <div class="col-sm-7">
                <div class="col-sm-6 font-desc-bold">
                    <ul>
                        <li><p>Nama Proyek</p></li>
                        <li><p>Nama Perusahaan</p></li>
                        <li><p>Estimasi Waktu Pengerjaan</p></li>
                        <li><p>Alamat Proyek</p></li>
                        <li><p>Nama Pelaksana</p></li>
                        <li><p>Nilai Proyek</p></li>
                    </ul>
                </div>
                <div class="col-sm-6 font-desc">
                    <ul> 
                        <li><p>:   {{ $proyek->projectName}}<p></li>
                        <li><p>:   {{ $proyek->companyName}}<p></li>
                        <li><p>:   {{ $proyek->estimatedTime}} hari<p></li>
                        <li><p>:   {{ $proyek->projectAddress}}<p></li>
                        <li><p>:   Abdul Jannah<p></li>
                        <li><p>:   Rp {{ $proyek->projectValue }}
                    </ul>
                </div>
            </div>
        
    </div>
    </div>
    <br>
    <br>

    <div>
        <br>
        <br>
        <div  class="row ketengahin" style="margin-right: 58px; margin-bottom: 30px">
            <div class="col-sm-5">
                <div class="card card-tombol" style="margin-right: 40px; width: 400px; height: 350px">
                    <form action="/proyek/{{$proyek->id}}/kontrak/generateSurat" method="POST" id="save">
                             @csrf
                    <div class="row judul">
                        <div class="font-subtitle-4" style="margin-left:15px;">Buat Surat Kontrak Jual Beli</div>
                    </div>
                    <div style="margin: 30px; height: 60px; position: center">
                        <span>
                            <p style="text-align: justify; text-justify: inter-word">Klik tombol di bawah ini untuk membuat Berkas Surat Kontrak Jual Beli dan penugasan klien ke dalam proyek.</p>
                        </span>
                        
                        <div id="variabel">
                            <br>
                            <div class="col-sm-5 font-desc-bold" style="margin-left:-15px">
                                    <ul>
                                        <li><p>Alamat Perusahaan</p></li>
                                        <br>
                                        <li><p>Nama Klien</p></li>
                                    </ul>
                            </div>
                            <div class="col-sm-6 font-desc">
                                    <div style="border: 0.5px solid #e6e6e6; border-radius: 8px; height: 25px; width:200px;" >
                                        <input class="inputs font-desc" style="font-size:13px; margin-top:5px; margin-left:10px;" type="text" 
                                        name="alamatKlien"  placeholder="Masukkan Alamat Perusahaan" data-error=".alamatKlien">
                                        
                                    </div>
                                    <br>
                                    <select name="namaKlien" class="content bg1" style="width:200px">
                                            @foreach($klien as $tipe)
                                                <option value="{{$tipe->id}}">{{$tipe->name}}</option>
                                            @endforeach
                                    </select>
                            </div>
                        </div>
                        
                            <button class="btn btn-primary simpan" style="margin-left: 10px; position:center; width: 300px">Buat Surat Kontrak Jual Beli</button>
                    </div>
                    </form> 
                </div>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-5" style="margin-left: 20px">
                <div class="card card-tombol" style="height: 350px">
                    <div class="row judul">
                        <div class="font-subtitle-4" style="margin-left:15px;">Upload Berkas Surat Kontrak Kerja</div>
                    </div>
                    <div style="margin: 30px; height: 60px; position: center">
                        <span>
                        </span>
                            <p style="text-align: justify; text-justify: inter-word">Klik tombol di bawah ini untuk mengunggah berkas surat kontrak kerja yang telah ditandatangani untuk dibentuk menjadi berkas kontrak kerja.</p>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <a href="/proyek/{{$proyek->id}}/kontrak/berkasSurat" class="btn btn-primary" style="margin-left: 10px; position:center; width: 300px">Upload Berkas Surat Kontrak Kerja</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <form action="/proyek/{{$proyek->id}}/kontrak/buatSurat/" method="POST" id="save">
            @csrf

    <div class="container-fluid card card-kontrak">
        <div class="row judul">
            <div class="col-sm-9 font-subtitle-4">Buat Surat Kontrak Jual Beli</div>
        </div>
        <hr>
        
        <div id="variabel">
            <div class="col-sm-5 font-desc-bold" style="margin-left:15px;">
                    <ul>
                        <li><p>Alamat Perusahaan</p></li>
                        <br>
                        <li><p>Nama Klien</p></li>
                    </ul>
            </div>
            <div class="col-sm-6 font-desc">
                    <div style="border: 0.5px solid #e6e6e6; border-radius: 8px; height: 25px;" >
                        <input class="inputs font-desc" style="font-size:13px; margin-top:5px; margin-left:10px;" type="text" name="alamatKlien" placeholder="Masukkan Alamat Perusahaan" data-error=".alamatKlien">
                    </div>
                    <br>
                    <select name="namaKlien" class="content bg1">
                            @foreach($klien as $tipe)
                                <option value="{{$tipe->id}}">{{$tipe->name}}</option>
                            @endforeach
                    </select>
            </div>
        </div>
        <br>
        <br>
    
    </div>
    <div class="row" style="margin-top: 20px; ">
    <div class="col-sm-3"> </div>
    <div class="col-sm-3 container1-btn">
        <div style="margin-left:310px;">
        <a class="button-disapprove font-approval"data-toggle="modal" data-target="#myModal" style="padding:10px;">
          <button>Kembali</button>
        </a>
        </div>
    </div>
    <div class="col-sm-3"> 
        
            <button id="simpan" class="button-approve font-approval" style="margin-left:70px">Lanjut</button>
           
    </div>
    </form> 
     -->
    
    
    <!-- <div class="col-sm-4"> </div> -->
</div>
    
    <br>
    <br>
    
    

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="text-align:center;">Batalkan Proses?</h4>
			</div>
			<div class="modal-body" style="text-align:center;">
				<p>Jika proses dibatalkan, perubahan tidak akan disimpan.</p>
			</div>
			<div class="modal-footer">
				<a href="/proyek/lihat/{{ $proyek->id }}" class="btn btn-default" style="color:red;">Iya</a>
				<a data-dismiss="modal" class="btn btn-primary ">Tidak</a>
			</div>
		</div>
		</div>
	</div>

    <div id="myMod" class="modal fade"> 
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">
                    <h4 class="modal-title">Sukses!</h4>	
				</div>
				<div class="modal-body">
					<p class="text-center">Surat Kontrak Jual Beli berhasil dibuat.</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
				</div>
			</div>
		</div>
	</div>     

</div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script>
	$( document ).ready(function() {

        
		$("#simpan").click(function(e){
			e.preventDefault();
			//checks if it's valid
		//horray it's valid
			$("#myMod").modal("show");
			
		});
		$("#OK").click(function(e){
		   $('#save').submit();
		});

        $("#tolak").click(function(e){
			e.preventDefault();
			//checks if it's valid
		//horray it's valid
			$("#mod").modal("show");
			
		});
		$("#NO").click(function(e){
		   $('#reject').submit();
		});
  	});
	</script>
@endsection 