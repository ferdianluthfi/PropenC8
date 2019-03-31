<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	
</head>
<body>
	<div class="container container-basic" nonvalidate="nonvalidate" id="jqueryvalidation">

		@if(session()->has('flash_message'))
			<p>{{session('flash_message')}}</p>
		@endif
		
        @foreach($proyeks as $proyek)
		<form action="/proyek/update" method="post" id="editForm">
			<a href="/proyek/"> Proyek > Ubah Proyek </a>
			<h1 style="text-align:center;">Ubah Proyek Potensial</h1>
			{{ csrf_field() }}

            <input type="hidden" name="id" value="{{ $proyek->id }}"> <br/>
		
			<div class="content bg1">
						<span class="labels">Nama Staf Marketing</span>
						<input class="inputs" type="text" name="name" value="{{ $proyek->name }}" data-error=".errorName">
						<div class="errorMessage errorName"></div>
			</div>

			<div class="content bg1">
						<span class="labels">Nama Proyek</span>
						<input class="inputs" type="text" name="projectName" value="{{ $proyek->projectName }}" data-error=".errorProjectName">
						<div class="errorMessage errorProjectName"></div>
			</div>

			<div class="content bg1">
						<span class="labels">Nama Perusahaan</span>
						<input class="inputs" type="text" name="companyName" value="{{ $proyek->companyName }}" data-error=".errorCompanyName">
						<div class="errorMessage errorCompanyName"></div>
			</div>

			<div class="content bg1">
						<span class="labels">Deskripsi</span>
						<textarea class="inputs" type="text" name="description" style="height:150px" data-error=".errorDescription"> {{ $proyek->description }} </textarea>
						<div class="errorMessage errorDescription"></div>
			</div>

			<div class="content bg1">
						<span class="labels">Nilai Proyek</span>
						<input class="inputs" type="number" name="projectValue" value="{{ $proyek->projectValue }}" data-error=".errorValue">
						<div class="errorMessage errorValue"></div>
			</div>

			<div class="content bg1">
						<span class="labels">Estimasi Waktu Pengerjaan</span>
						<input class="inputs" type="number" name="estimatedTime" value="{{ $proyek->estimatedTime }}" data-error=".errorTime">
						<div class="errorMessage errorTime"></div>
			</div>

			<div class="content bg1">
						<span class="labels">Alamat Proyek</span>
						<textarea class="inputs" type="text" name="projectAddress" data-error=".errorProjectAdd"> {{ $proyek->projectAddress }} </textarea>
						<div class="errorMessage errorProjectAdd"></div>
			</div>

			<div class="container1-btn">
					<a class="container1-form-btn" data-toggle="modal" data-target="#myModal">
						<span>
							Batal
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</a>
			</div>
			
			<div class="container-btn">
						<button class="container-form-btn">
							<span>
								Simpan Data
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
			</div>
		</form>
        @endforeach
	</div>

	<div class="container">
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Batalkan Proses</h4>
			</div>
			<div class="modal-body">
			<p>Jika proses dibatalkan perubahan tidak akan disimpan.</p>
			</div>
			<div class="modal-footer">
			@foreach($proyeks as $proyek)
				<a href="/proyek/ubah/{{ $proyek->id }}" class="btn btn-default">Tidak</button>
			@endforeach
				<a href="/proyek/" class="btn btn-default">Iya</a>
			</div>
		</div>
		
		</div>
	</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script>
	$('#editForm').validate({
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
	</script>
</body>	
</html>