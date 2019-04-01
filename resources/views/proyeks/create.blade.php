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
	<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="bg-grey">-
		<div class="container" nonvalidate="nonvalidate" id="jqueryvalidation">

			@if(session()->has('flash_message'))
				<p>{{session('flash_message')}}</p>
			@endif
			
			<form action="/proyek/store" method="post" id="addForm">
				<a href="/proyek/"> Proyek > Tambah Proyek </a>
				<h1 style="text-align:center;">Tambah Proyek Potensial</h1>
				{{ csrf_field() }}
			
				<div class="content bg1">
							<span class="labels">Nama Staf Marketing</span>
							<input class="inputs" type="text" name="name" placeholder="Masukkan Nama" data-error=".errorName">
							<div class="errorMessage errorName"></div>
				</div>

				<div class="content bg1">
							<span class="labels">Nama Proyek</span>
							<input class="inputs" type="text" name="projectName" placeholder="Masukkan Nama Proyek" data-error=".errorProjectName">
							<div class="errorMessage errorProjectName"></div>
				</div>

				<div class="content bg1" >
							<span class="labels">Nama Perusahaan</span>
							<input class="inputs" type="text" name="companyName" placeholder="Masukkan Nama Perusahaan" data-error=".errorCompanyName">
							<div class="errorMessage errorCompanyName"></div>
				</div>

				<div class="content bg1" >
							<span class="labels">Deskripsi</span>
							<textarea class="inputs" type="text" name="description" placeholder="Penjelasan Proyek" style="height:150px" data-error=".errorDescription"></textarea>
							<div class="errorMessage errorDescription"></div>
				</div>

				<div class="content bg1" >
							<span class="labels">Nilai Proyek</span>
							<input class="inputs" type="number" name="projectValue" placeholder="50.000.000" data-error=".errorValue">
							<div class="errorMessage errorValue"></div>
				</div>

				<div class="content bg1" >
							<span class="labels">Estimasi Waktu Pengerjaan</span>
							<input class="inputs" type="number" name="estimatedTime" placeholder="120 (Hari)" data-error=".errorTime">
							<div class="errorMessage errorTime"></div>
				</div>

				<div class="content bg1" >
							<span class="labels">Alamat Proyek</span>
							<textarea class="inputs" type="text" name="projectAddress" placeholder="Masukkan Alamat Proyek" data-error=".errorProjectAdd"></textarea>
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
						<button class="container-form-btn" id="simpan">
								<span>
									Simpan Data
									<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
								</span>
						</button>
				</div>
			</form>
		</div>
	</div>

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
				<a href="/proyek/tambah" class="btn btn-default">Tidak</button>
				<a href="/proyek/" class="btn btn-default">Iya</a>
			</div>
		</div>
		</div>
	</div>

	<div id="myMod" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">
					<div class="icon-box">
						<i class="material-icons">&#xE876;</i>
					</div>				
					<h4 class="modal-title">Awesome!</h4>	
				</div>
				<div class="modal-body">
					<p class="text-center">Your booking has been confirmed. Check your email for detials.</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
				</div>
			</div>
		</div>
	</div>     

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
</body>	
</html>