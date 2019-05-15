@extends('layouts.layout')

<head>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
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
    <form action="/proyek/{{$proyek->id}}/kontrak/buatSurat/" method="POST" id="save">
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
                    <div style="border: 0.5px solid #e6e6e6; border-radius:8px; height: 25px;">
                        <input class="inputs font-desc" style="font-size:13px; margin-top:5px; margin-left:10px;" type="text" name="contactPerson" placeholder="Masukkan Nama Klien" data-error=".contactPerson">
                    </div>
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
    
    
    
    <div class="col-sm-4"> </div>
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
				<a href="{{ route('buat-kontrak', $proyek->id) }}" class="btn btn-primary ">Tidak</a>
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

    <div id="mod" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">			
					<h4 class="modal-title"></h4>	
				</div>
				<div class="modal-body">
					<p class="text-center">Kontrak kerja berhasil ditolak.</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-block" data-dismiss="modal" id="NO">OK</button>
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