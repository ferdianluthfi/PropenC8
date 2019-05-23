@extends('layouts.layout')



@if(Auth::user()->role == 1)
@section('content')
@include('layouts.nav')

@if(session('error'))
			<div class="alert alert-warning alert-dismissible" style="margin: 15px;" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong> {{ session('error') }} </strong>
			</div>
		@endif
<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="margin-left:150px;">
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="#">Tambah User</a></li>
		</ol>
	</nav>

<div class="container" nonvalidate="nonvalidate" id="jqueryvalidation">
        
        

                    <form method="POST" action="{{ route('register') }}" id="addForm" style="height:500px;width:1000px;background:white;padding-top: 8px; margin:0 auto;">
                        <h1 class="font-title" style="text-align:center; margin-top:10px;margin-bottom:10px;">Tambah Akun</h1>
						<hr>
			            {{ csrf_field() }}
						<br>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right font-subtitle-4">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="font-desc form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">Sudah ada akun dengan nama tersebut!</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right font-subtitle-4">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="font-desc form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">Sudah ada akun dengan username tersebut!</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right font-subtitle-4">{{ __('Alamat E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="font-desc form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">Email sudah pernah digunakan!</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right font-subtitle-4">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="font-desc form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">Passowrd tidak cocok</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right font-subtitle-4">{{ __('Ulangi Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right font-subtitle-4">{{ __('Jabatan') }}</label>
                            <div class="col-md-6 font-desc">
								<select name="role" class="content bg1">
                           			<option value="1" >Akun Manajer</option>
                            		<option value="2" >Direksi</option>
                            		<option value="3" >Staf Marketing</option>
									<option value="4" >Manajer Marketing</option>
									<option value="5" >Program Manajer</option>
									<option value="6" >Manajer Pelaksana</option>
									<option value="7" >PM</option>
									<option value="8" >Klien</option>
                        		</select>
                            </div>
                        </div>

						<br>

						<div class="container1-btn" style="place-content: flex-end;float: right;">
								<a class="button-disapprove font-approval" data-toggle="modal" data-target="#myModal" style="padding:10px;">
									<span>
										BATAL
										<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
									</span>
								</a>
								<button class="button-approve font-approval" id="simpan" style="margin-left:5px;">
										<span>
											SIMPAN
											<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
										</span>
								</button>
						</div>
						

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="text-align:center;">Batalkan Proses?</h4>
			</div>
			<div class="modal-body" style="text-align:center;">
				<p>Jika proses dibatalkan, perubahan tidak akan disimpan.</p>
			</div>
			<div class="modal-footer">
					<a href="/" class="btn btn-default" style="color:red;">Iya</a>
				
					<a data-dismiss="modal" class="btn btn-primary">Tidak</a> 
			
			</div>
		</div>
		
		</div>
</div>

<div id="myMod" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title" style="text-align:center;">Sukses!</h4>	
			</div>
			<div class="modal-body text-center">
				<p class="text-center">Data Akun berhasil ditambah</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
			</div>
		</div>
	</div>
</div>
@include('layouts.footer')
@endsection

@else
@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa) -->
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active font-breadcrumb-active" aria-current="page"><a href="{{ url('home') }}">Beranda</a></li>
  </ol>
</nav>

<!-- isinya -->
<div class="container-fluid card card-main">
    <br>
    <div class="text-center font-title">
        Oops!
    </div>
    <br>
    <div class="no-access-image">
        <img src="{{ asset('img/no-access.svg')}}">
    </div>
    <br>
    <br>
    <div class="text-center font-subtitle-4">
        <p class="text-center font-subtitle-4">Anda tidak memiliki akses untuk halaman ini.</p>
        <p class="text-center font-subtitle-4">Kembali ke <a href="{{ url('home') }}">Beranda</a> </p>
    </div>
</div>

@include('layouts.footer')
@endsection
@endif

@section('scripts')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script>
	$( document ).ready(function() {
		$("#addForm").validate({
			rules:{
				name:{
					required: true,
					minlength: 2,
				},
				username:{
					required: true,
				},
				email:{
					required: true,
				},
				password:{
					required: true,
				}
			},
			//For custom messages
			messages:{
				name:{
					required: "Nama  harus diisi",
					minlength: "Minimal panjang nama adalah 2 huruf"
				},
				username:{
					required: "Username harus diisi",
				},
				email:{
					required: "Email harus diisi",
				},
				password:{
					required: "Password harus diisi",
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
		})
		
		
  	});
	</script>
	<style>
	.error{
		color:red;
	}
	</style>
	
@endsection
