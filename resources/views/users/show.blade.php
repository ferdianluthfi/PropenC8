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

		@foreach($users as $user)
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="margin-left:100px;">
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('homeAccountManager') }}">Beranda</a></li>
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href= "/user/ubah/{{ $user->id }}">Detail User {{ $user->name }}</a></li>
		</ol>
		</nav>
		
		<form action="/user/update" method="post" id="editForm" style="height:500px;width:1000px;background:white;padding-top: 8px; margin:0 auto;">
			
            <h1 class="font-title" style="text-align:center;">Detail Akun</h1>
            <hr>
			{{ csrf_field() }}

			<input type="hidden" name="id" value="{{ $user->id }}"> <br/>
		
			<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right font-subtitle-4">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input value="{{ $user->name }}" id="name" type="text" class="font-desc form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

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
                                <input value="{{ $user->username }}" id="username" type="text" class="font-desc form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

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
                                <input value="{{ $user->email }}"id="email" type="email" class="font-desc form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                        <input value="{{ $user->password }}" id="password" type="password" class="font-desc form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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
                        <input value="{{ $user->password }}" id="password-confirm" type="password" class="font-desc form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right font-subtitle-4">{{ __('Jabatan') }}</label>
                    <div class="col-md-6">
					@switch($user->role)
					@case(1)
						<select name="role" class="content bg1 font-desc">
							<option value="1" >Akun Manajer</option>
							<option value="2" >Direksi</option>
							<option value="3" >Staf Marketing</option>
							<option value="4" >Manajer Marketing</option>
							<option value="5" >Program Manajer</option>
							<option value="6" >Manajer Pelaksana</option>
							<option value="7" >PM</option>
							<option value="8" >Klien</option>
						</select>
						@break
					@case(2)
						<select name="role" class="content bg1">
							<option value="2" >Direksi</option>
							<option value="1" >Akun Manajer</option>
							<option value="3" >Staf Marketing</option>
							<option value="4" >Manajer Marketing</option>
							<option value="5" >Program Manajer</option>
							<option value="6" >Manajer Pelaksana</option>
							<option value="7" >PM</option>
							<option value="8" >Klien</option>
						</select>
						@break
					@case(3)
						<select name="role" class="content bg1">
							<option value="3" >Staf Marketing</option>
							<option value="2" >Direksi</option>
							<option value="1" >Akun Manajer</option>
							<option value="3" >Staf Marketing</option>
							<option value="4" >Manajer Marketing</option>
							<option value="5" >Program Manajer</option>
							<option value="6" >Manajer Pelaksana</option>
							<option value="7" >PM</option>
							<option value="8" >Klien</option>
						</select>
						@break
					@case(4)
						<select name="role" class="content bg1">
							<option value="4" >Manajer Marketing</option>
							<option value="3" >Staf Marketing</option>
							<option value="2" >Direksi</option>
							<option value="1" >Akun Manajer</option>
							<option value="3" >Staf Marketing</option>
							<option value="5" >Program Manajer</option>
							<option value="6" >Manajer Pelaksana</option>
							<option value="7" >PM</option>
							<option value="8" >Klien</option>
						</select>
						@break
					@case(5)
						<select name="role" class="content bg1">
							<option value="5" >Program Manajer</option>
							<option value="4" >Manajer Marketing</option>
							<option value="3" >Staf Marketing</option>
							<option value="2" >Direksi</option>
							<option value="1" >Akun Manajer</option>
							<option value="3" >Staf Marketing</option>
							<option value="6" >Manajer Pelaksana</option>
							<option value="7" >PM</option>
							<option value="8" >Klien</option>
						</select>
						@break
					@case(6)
						<select name="role" class="content bg1">
							<option value="6" >Manajer Pelaksana</option>
							<option value="5" >Program Manajer</option>
							<option value="4" >Manajer Marketing</option>
							<option value="3" >Staf Marketing</option>
							<option value="2" >Direksi</option>
							<option value="1" >Akun Manajer</option>
							<option value="3" >Staf Marketing</option>
							<option value="7" >PM</option>
							<option value="8" >Klien</option>
						</select>
						@break
					@case(7)
						<select name="role" class="content bg1">
							<option value="7" >PM</option>
							<option value="6" >Manajer Pelaksana</option>
							<option value="5" >Program Manajer</option>
							<option value="4" >Manajer Marketing</option>
							<option value="3" >Staf Marketing</option>
							<option value="2" >Direksi</option>
							<option value="1" >Akun Manajer</option>
							<option value="3" >Staf Marketing</option>
							<option value="8" >Klien</option>
						</select>
						@break
					@case(8)
						<select name="role" class="content bg1">
							<option value="8" >Klien</option>
							<option value="7" >PM</option>
							<option value="6" >Manajer Pelaksana</option>
							<option value="5" >Program Manajer</option>
							<option value="4" >Manajer Marketing</option>
							<option value="3" >Staf Marketing</option>
							<option value="2" >Direksi</option>
							<option value="1" >Akun Manajer</option>
							<option value="3" >Staf Marketing</option>
						</select>
						@break
					@endswitch
					<div>
						@if($user->status == 0)
						<a class="button-disapprove font-approval" data-toggle="modal" data-target="#myDeleteModal" style="padding:10px;color:red;border:1.5px solid red;">
							<span>
								Nonaktifkan
							</span>
						</a>
						@else
						<a class="button-disapprove font-approval"" data-toggle="modal" data-target="#myUpdateModal" style="padding:10px;">
							<span>
								Aktifkan
							</span>
						</a>
						@endif
					</div>
					</div>
					

                </div>

				
				<div class="container1-btn" style="place-content: flex-end;float: right;">
						<a class="button-disapprove font-approval" data-toggle="modal" data-target="#myModal" style="padding:10px;">
							<span>
								BATAL
							</span>
						</a>
						<button class="button-approve font-approval" id="simpan" style="margin-left:5px;">
								<span>
									SIMPAN
								</span>
						</button>
				</div>
		</form>
		@endforeach
	</div>
	

	<div class="modal fade" id="myDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="text-align:center;">Hapus Akun?</h4>
			</div>
			<div class="modal-body" style="text-align:center;">
				<p>Jika proses dibatalkan, perubahan tidak akan disimpan.</p>
			</div>
			<div class="modal-footer">
					<a href="/user/delete/<?php echo $user->id ?>" class="btn btn-default" style="color:red;">Iya</a>
				
					<a data-dismiss="modal" class="btn btn-primary">Tidak</a> 
			
			</div>
		</div>
		
		</div>
</div>

<div class="modal fade" id="myUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="text-align:center;">Aktifkan Akun?</h4>
			</div>
			<div class="modal-body" style="text-align:center;">
				<p>Jika proses dibatalkan, perubahan tidak akan disimpan.</p>
			</div>
			<div class="modal-footer">
					<a href="/user/unlock/<?php echo $user->id ?>" class="btn btn-default" style="color:red;">Iya</a>
				
					<a data-dismiss="modal" class="btn btn-primary">Tidak</a> 
			
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
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script>
	$( document ).ready(function() {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        dd($validator->fails());
        if($validator->fails()) {
            session()->flash('error', 'Ada kesalahan input');
            return redirect('/user/lihat/$request->id')
                ->withErrors($validator)
                ->withInput();
        
        } else {
		$("#editForm").validate({
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
					required: "Nama harus diisi",
					minLength: "Minimal nama adalah 2 huruf"
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