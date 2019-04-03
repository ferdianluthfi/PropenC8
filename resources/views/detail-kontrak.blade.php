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
    <div class="row">
        <div class="col-sm-7 font-subtitle-2">Informasi Kontrak Kerja</div>
        <div class="col-sm-3 font-status-approval">{{ $statusHuruf }}</div>


    </div>
</div>

<form action="/proyek/{{$id}}/kontrak/approve" method="POST" id="save">
    @csrf
    <div class="container-btn">
                <button class="container-form-btn" id="simpan">
                        <span>
                            SETUJUI
                        </span>
                </button>
        </div>
</form>
<form action="/proyek/{{$id}}/kontrak/disapprove" method="POST", id="reject">
    @csrf
    <div class="container-btn">
                <button class="container-form-btn" id="tolak">
                        <span>
                            TOLAK
                        </span>
                </button>
        </div>
</form>

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
    <p class="font-subtitle-2"> Detail </p>
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