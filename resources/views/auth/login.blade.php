<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
     <!-- Our Custom CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type='text/css'>
    
    <style>
        body{
            margin-bottom:120px;
            margin-top: 80px;
            background-color: rgb(232, 249, 255);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: left bottom;
            background-size: 100%;
            
        }
        form {
    display: inline-block;
}
        .navbar{
            background-color: #ffffff;
            }
        .navbar-logo-trayek{
            margin-top: 2px;
            margin-bottom:-2px;
            margin-left: 1px;
        }
        .centered {
            position: fixed;
            top: 32%;
            left: 43%;
            margin-top: -50px;
            margin-left: -100px;
        }
    </style>

</head>
<body>

<nav class="navbar navbar-light navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <img class="navbar-brand"src="{{ asset('img/logoTrayek.svg')}}"><a class="navbar-brand font-nav-logo" href="{{ url('home') }}">TRAYEK</a>
    </div>
  </div>
</nav>


@if(session('error'))
			<div class="alert alert-warning alert-dismissible" style="margin: 15px;" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong> {{ session('error') }} </strong>
			</div>
	@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="centered" style="column-count:2;">
                    <img src="{{ asset('img/logoTrayek.svg')}}" width="170" height="120">
                    <br><br><br>
                    <h1 >TRAYEK</h1>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="centered" style="margin-top:100px;width:830px;">
                        @csrf

                        <div class="form-group row">
                            
                            <div class="col-md-6">
                                <label for="username" class="col-md-4 col-form-label text-md-right" style="padding-left:0px">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <div class="col-md-6">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="padding-left:0px">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        
                        <div style="width:100%">
                            <button type="submit" class="btn btn-primary" style="margin-left:170px">
                                {{ __('Login') }}
                            </button>
                        </div>
            
                    </form>
                </div>
            
        </div>
    </div>
</div>

</body>
</html>
