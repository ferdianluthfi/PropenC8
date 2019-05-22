@extends('layouts.layout')

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

@section ('content')
@include('layouts.nav')
	<div class="container container-basic" nonvalidate="nonvalidate" id="jqueryvalidation">

		@if(session('error'))
			<div class="alert alert-warning alert-dismissible" style="margin: 15px;" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong> {{ session('error') }} </strong>
			</div>
		@endif

		@foreach($proyeks as $proyek)
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="margin-left:0px;">
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href= "/proyek/ubah/{{ $proyek->id }}">Ubah Data Proyek {{ $proyek->projectName }}</a></li>
		</ol>
		</nav>
		<form action="/proyek/update" method="post" id="editForm" style="background-color:#fff">
			
			<p class="font-title"style="text-align:center;margin-top:-35px;">Ubah Proyek Potensial</p>
			{{ csrf_field() }}
			<br>
			<input type="hidden" name="id" value="{{ $proyek->id }}">
		
			<div class="content bg1">
						<span class="labels font-subtitle-5">Nama Staf Marketing</span>
						<input class="inputs" readonly="readonly" type="text" name="name" value="{{ $proyek->name }}" data-error=".errorName">
						<div class="errorMessage errorName"></div>
			</div>

			<div class="content bg1">
						<span class="labels font-subtitle-5">Nama Proyek</span>
						<input class="inputs" type="text" name="projectName" value="{{ $proyek->projectName }}" data-error=".errorProjectName">
						<div class="errorMessage errorProjectName"></div>
			</div>

			<div class="content bg1">
						<span class="labels font-subtitle-5">Nama Perusahaan</span>
						<input class="inputs" type="text" name="companyName" value="{{ $proyek->companyName }}" data-error=".errorCompanyName">
						<div class="errorMessage errorCompanyName"></div>
			</div>

			<div class="content bg1">
						<span class="labels font-subtitle-5">Deskripsi</span>
						<textarea class="inputs" type="text" name="description" style="height:150px" data-error=".errorDescription"> {{ $proyek->description }} </textarea>
						<div class="errorMessage errorDescription"></div>
			</div>

			<div class="content bg1">
						<span class="labels font-subtitle-5">Nilai Proyek</span>
						<input class="inputs" type="number" name="projectValue" value="{{ $proyek->projectValue }}" data-error=".errorValue">
						<div class="errorMessage errorValue"></div>
			</div>

			<div class="content bg1">
						<span class="labels font-subtitle-5">Estimasi Waktu Pengerjaan</span>
						<input class="inputs" type="number" name="estimatedTime" value="{{ $proyek->estimatedTime }}" data-error=".errorTime">
						<div class="errorMessage errorTime"></div>
			</div>

			<div class="content bg1">
						<span class="labels font-subtitle-5">Alamat Proyek</span>
						<textarea class="inputs" type="text" name="projectAddress" data-error=".errorProjectAdd"> {{ $proyek->projectAddress }} </textarea>
						<div class="errorMessage errorProjectAdd"></div>
			</div>
            <div class="row">
            <div class="col-sm-8"></div>
            <div class="col-sm-2">
                <a class="button-disapprove font-approval" data-toggle="modal" data-target="#myModal" style="padding-top: 10px">
                    <span>
                        BATAL
                    </span>
                </a>
            </div>
            <div class="col-sm-2">
                <button class="button-approve font-approval" id="simpan">
                    <span>
                        SIMPAN
                    </span>
                </button>
            </div>
        </div>
		</form>
		@endforeach
	</div>
	
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
                        <a href="/proyek/" class="btn btn-default" style="color:red;">Iya</a>
                    @foreach($proyeks as $proyek)
                        <a href="/proyek/ubah/{{ $proyek->id }}" class="btn btn-primary">Tidak</a>
                    @endforeach
                </div>
            </div>
		</div>
	</div>

	<div class="modal fade" id="myMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">				
					<h4 class="modal-title" style="text-align:center;">Sukses!</h4>	
				</div>
				<div class="modal-body text-center">
					<p class="text-center">Data proyek berhasil diubah</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
				</div>
			</div>
		</div>
	</div>  
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script>
	$( document ).ready(function() {
		$("#editForm").validate({
			rules:{
				name:{
					required: true,
					minlength: 2,
				},
				projectName:{
					required: true,
				},
				companyName:{
					required: true,
				},
				description:{
					required: true,
				},
				projectValue:{
					required: true,
					digits: true,
					min: 1,
				},
				estimatedTime:{
					required: true,
					digits: true,
					min: 1, //ceklg
				},
				projectAddress:{
					required: true,
				}
			},
			//For custom messages
			messages:{
				name:{
					required: "Nama staf marketing harus diisi",
				},
				projectName:{
					required: "Nama proyek harus diisi",
				},
				companyName:{
					required: "Nama perusahaan harus diisi",
				},
				description:{
					required: "Deskripsi proyek harus diisi",
				},
				projectValue:{
					required: "Nilai proyek harus diisi",
					digits: "Nilai proyek harus berupa angka",
					min: "Nilai proyek proyek minimal 1 rupiah",
				},
				estimatedTime:{
					required: "Waktu pengerjaan proyek harus diisi",
					digits: "Waktu pengerjaan proyek harus berupa angka",
					min: "Waktu pengerjaan proyek minimal 1 hari",  //ceklg
				},
				projectAddress:{
					required: "Alamat proyek harus diisi",
				}
			}, 
			errorElement:'div',
			errorPlacement:function(error,element){
				var placement = $(element).data('error');
				if(placement){
					$(placement).append(error)
				} else {
					error.insertAfter(element);
				}
			}
		});
		$("#simpan").click(function(e){
			e.preventDefault();
			if($('#editForm').valid()){ //checks if it's valid
		//horray it's valid
			$("#myMod").modal("show");
			};
		});
		$("#OK").click(function(e){
		   $('#editForm').submit();
		});
	});
	</script>
@endsection

</html>
