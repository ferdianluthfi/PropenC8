<!DOCTYthE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
 
	<h3>Edit Proyek Potensial</h3>
	
    @if(session()->has('flash_message'))
		<p class="single-alert">{{session('flash_message')}}</p>
	@endif

	@foreach($proyeks as $proyek)
	<form action="/proyek/update" method="post">
		{{ csrf_field() }}
		
        <input type="hidden" name="id" value="{{ $proyek->id }}"> <br/>
        Nama Staf Marketing <input type="text" name="name" required="required" value="{{ $proyek->name }}"> <br/>
		Nama Proyek <input type="text" name="projectName" required="required" value="{{ $proyek->projectName }}"> <br/>
		Nama Perusahaan <input type="text" name="companyName" required="required" value="{{ $proyek->companyName }}"> <br/>
		Deskripsi <textarea name="description" required="required">{{ $proyek->description }}</textarea> <br/>
		Nilai Proyek <input type="number" name="projectValue" required="required" value="{{ $proyek->projectValue }}"> <br/>
        Estimasi Waktu Pengerjaan <input type="text" name="estimatedTime" required="required" value="{{ $proyek->estimatedTime }}"> <br/>
        Alamat Proyek <textarea name="projectAddress" required="required">{{ $proyek->projectAddress }}</textarea> <br/>
		<input type="submit" value="Simpan Data">
	</form>
	@endforeach
		
 
</body>
</html>