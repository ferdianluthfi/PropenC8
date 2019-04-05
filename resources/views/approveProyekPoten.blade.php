<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Detail Proyek</title>
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
    <script src="main.js"></script>
    <h1>Setujui Proyek</h1>
</head>
<body>
<!-- Jangan lupa ganti variabel pnya karena jelek -->
    <h1>Detail Informasi Proyek Perangkat Lunak</h1>
    <h3>Infomasi Umum<h3>
    <p>{{$status}}</p>
    @foreach($proyek as $p)
        <p>Staff Marketing   : {{ $p->name }}</p> 
        <p>Nama Proyek       : {{ $p->projectName }}</p>
        <p>Nama Perusahaan   : {{ $p->companyName }}</p> 
        <p>Alamat Proyek     : {{ $p->projectAddress }}</p> 
        <p>Deskripsi Proyek  : {{ $p->description }}</p> 
        <p>Nilai Proyek      : Rp {{ $p->projectValue }},-</p> 
        <p>Estimasi Waktu Pengerjaan	: {{ $p->estimatedTime }} hari</p>  
        <a href="">Berkas Kontrak</a>
        <a href="">LAPJUSIK</a>
        <a href="">LPJ</a>
        <form action="/proyek/setujuiProyek/setuju/{{ $p->id }}" method="post" id="save">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
            <div class="container-btn">
                    <button class="container-form-btn" id="simpan">
                            <span>
                                SETUJUI
                            </span>
                    </button>
            </div>  
        </form> 
        <form action="/proyek/setujuiProyek/tolak/{{ $p->id }}" method="post" id="reject">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
            <div class="container1-btn">
                    <button class="container1-form-btn" id="tolak">
                        <span>
                            TOLAK
                        </span>
                    </button>
            </div>
        </form>
    
    @endforeach 


    
    
    


    <!-- <div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		Modal content
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
	</div> --> 

	<div id="myMod" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">
					<div class="icon-box">
						<i class="material-icons">&#xE876;</i>
					</div>				
					<h4 class="modal-title">SETUJUI!</h4>	
				</div>
				<div class="modal-body">
					<p class="text-center">Proyek potensial berhasil disetujui.</p>
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
					<div class="icon-box">
						<i class="material-icons">&#xE876;</i>
					</div>				
					<h4 class="modal-title">TOLAK!</h4>	
				</div>
				<div class="modal-body">
					<p class="text-center">Proyek potensial berhasil ditolak</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success btn-block" data-dismiss="modal" id="NO">OK</button>
				</div>
			</div>
		</div>
	</div>     


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

</body>
</html>