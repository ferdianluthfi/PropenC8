@extends('layouts.layout')

@section('content')
@include('layouts.nav')
<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="margin-left:150px;">
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('homeAccountManager') }}">Beranda</a></li>
			<li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="#">Tambah User</a></li>
		</ol>
	</nav>

<div class="container" nonvalidate="nonvalidate" id="jqueryvalidation">
        
        @if(session('error'))
			<div class="alert alert-warning alert-dismissible" style="margin: 15px;" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong> {{ session('error') }} </strong>
			</div>
		@endif

                    <form method="POST" action="{{ route('register') }}" id="addForm">
                        <h1 style="text-align:center;">Tambah Akun</h1><br>
			            {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <input id="role" type="number" class="form-control" name="role" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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
		$("#addForm").validate({
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
					min: "Nilai proyek proyek minimal 1 rupiah",
					digits: "Nilai proyek harus berupa angka dan minimal 1 rupiah",
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
		})
		$("#simpan").click(function(e){
			e.preventDefault();
			if($('#addForm').valid()){ //checks if it's valid
		//horray it's valid
			$("#myMod").modal("show");
			};
		});
		$("#OK").click(function(e){
		   $('#addForm').submit();
		});
  	});
	</script>
@endsection
