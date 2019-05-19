@extends('layouts.layout')

@section('content')
@include('layouts.nav')

@if ($status =='0')
<!-- Breadcrumbs (ini buat navigation yaa) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek', $id) }}">Detail Proyek {{ $proyek->projectName }}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="#">Menyetujui Kontrak Kerja</a></li>  
  </ol>
</nav>

<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Menyetujui Kontrak Kerja</p>
    <hr>
    <div class="row judul" style="margin-bottom:15px; margin-top:-10px;">
        <p class="col-sm-9 font-subtitle-2">Informasi Kontrak Kerja</p>
        <p class="col-sm-3 font-status-approval" style="margin-top:7px; margin-left:-40px;">{{ $statusHuruf }}</p>
    </div>
    <div class="container-fluid card card-kontrak">
        <div class="row judul">
            <div class="col-sm-9 font-subtitle-4">Informasi Umum</div>
        </div>
    <hr>
    <div class="row" style="margin-left: -30px;">
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
                        <li><p>:   Juanita<p></li>
                        <li><p>:   Rp {{ $formatValue }}
                    </ul>
                </div>
            </div>
        <div class="col-sm-5" style="margin-left:-50px;">
                <div class="col-sm-6 font-desc-bold">
                    <ul>
                        <li><p>Tanggal Kontrak</p></li>
                        <li><p>Nilai Proyek Huruf</p></li>
                        <li><p>Penanggung Jawab</p></li>
                    </ul>
                </div>
                <div class="col-sm-6 font-desc">
                    <ul>
                        <li><p>:   12/05/2019<p></li>
                        <li><p>:   Lima Miliar<p></li>
                        <li><p>:   staf<p></li>
                    </ul>
                </div>
                </div>
        </div>
    </div>
    <br>
    <div class="container-fluid card card-kontrak">
        <div class="row judul">
            <div class="col-sm-9 font-subtitle-4">Berkas Kontrak Kerja</div>
        </div>
        <hr>
    </div>
    <div class="row" style="margin-top: 20px; ">
    <div class="col-sm-4"> </div>
    <div class="col-sm-2"> 
        <form action="/proyek/{{$id}}/kontrak/disapprove" method="POST" id="reject">
            @csrf
            <button id="tolak" class="button-disapprove font-approval">TOLAK</button>
        </form> 
    </div>
    <div class="col-sm-2"> 
        <form action="/proyek/{{$id}}/kontrak/approve" method="POST" id="save">
            @csrf
            <button id="simpan" class="button-approve font-approval">SETUJUI</button>
        </form>    
    </div>
    <div class="col-sm-4"> </div>
</div>
    <br>
    <br>
    </div>
</div>


@endif



@if ($status =='1' || $status =='2')
<!-- Breadcrumbs (ini buat navigation yaa) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek', $id) }}">Detail Proyek {{ $proyek->projectName }}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="#">Detail Kontrak Kerja</a></li>
  </ol>
</nav>

<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Detail Kontrak Kerja</p>
    <hr>
    <div class="row judul" style="margin-bottom:15px; margin-top:-10px;">
        <p class="col-sm-9 font-subtitle-2">Informasi Kontrak Kerja</p>
        <p class="col-sm-3 font-status-approval" style="margin-top:7px; margin-left:-40px;">{{ $statusHuruf }}</p>
    </div>
    <div class="container-fluid card card-kontrak">
        <div class="row judul">
            <div class="col-sm-9 font-subtitle-4">Informasi Umum</div>
        </div>
    <hr>
    <div class="row" style="margin-left: -30px;">
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
                        <li><p>:   {{ $proyek->estimatedTime}} hari<p></li>
                        <li><p>:   {{ $proyek->projectName}}<p></li>
                        <li><p>:   {{ $proyek->companyName}}<p></li>
                        <li><p>:   {{ $proyek->projectAddress}}<p></li>
                        <li><p>:   Abdul Jannah<p></li>
                        <li><p>:   Rp {{ $formatValue }}
                    </ul>
                </div>
            </div>
        <div class="col-sm-5" style="margin-left:-50px;">
                <div class="col-sm-6 font-desc-bold">
                    <ul>
                        <li><p>Tanggal Kontrak</p></li>
                        <li><p>Nilai Proyek Huruf</p></li>
                        <li><p>Penanggungjawab</p></li>
                    </ul>
                </div>
                <div class="col-sm-6 font-desc">
                    <ul>
                        <li><p>:   {{ $kontrak->contractDate}}<p></li>
                        <li><p>:   nilaiproyek<p></li>
                        <li><p>:   {{ $proyek->name}}<p></li>
                    </ul>
                </div>
                </div>
        </div>
    </div>
    <br>
    <div class="container-fluid card card-kontrak">
        <div class="row judul">
            <div class="col-sm-9 font-subtitle-4">Berkas Kontrak Kerja</div>
        </div>
        <hr>
    </div>
    <br>
    <br>
    </div>
</div>
@endif

<div id="myMod" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">
                    <h4 class="modal-title"></h4>	
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
				<div class="modal-body">
					<p class="text-center">Kontrak kerja berhasil disetujui.</p>
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

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script>
	$( document ).ready(function() {
        console.log("hhh");
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