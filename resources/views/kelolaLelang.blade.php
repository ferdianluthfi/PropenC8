<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="main.js"></script>
</head>
<body>
    <h1>Kelola Berkas Lelang</h1>

    <p>Nama Proyek : {{ $proyek->projectName }}</p>
    <p>Alamat Proyek : {{ $proyek->projectAddress }}</p>
    <p>Nama User apa ini : {{ $proyek->name }}</p>
    <p>Nama Perusahaan : {{ $proyek->companyName }}</p>
    <p>Tanggal Mulai Proyek : {{ $proyek->startDate }}</p>
    <p>Tanggal Selesai Proyek : {{ $proyek->endDate }}</p>
    <p>Deskripsi : {{ $proyek->description }}</p>
    <p>Nilai Proyek : {{ $proyek->projectValue }}</p>
    <p>Perkiraan waktu pengerjaan proyek : {{ $proyek->estimatedTime }} hari</p>
    <p>Deskripsi : {{ $proyek->description }}</p>

    @foreach ($berkass as $object)
        {{ $object->id }}
        {{ $object->fileBerkas }}
        {{ $object->created_at}}
        <br>
    @endforeach

    <br>
    <select>
            <option disabled selected value> -- Pilih Berkas Lelang -- </option>
            @foreach ($templates as $template)
            <option name ="template_id" value="{{ $template->id }}">{{ $template->nama_surat }}</option>
            @endforeach
    </select>
    <form method="post" enctype="multipart/form-data" action="/upload_file">
        <input type="hidden" value="{{ $proyek->id }}">
        <br>
        <input type="file" name="fileBerkas">
        <br>
        <br>
        <input type="submit" name="submit" value="upload" />
    </form>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload New File</div>
                    <div class="panel-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <p>
                            <a href="{{ route('file.form') }}" class="btn btn-primary">Upload File</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Path</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($files as $file)
                                        <tr>
                                            <td>{{ $file->title }}</td>
                                            <td>{{ $file->filename }}</td>
                                            <td>{{ $file->created_at->diffForHumans() }}</td>
                                            <td>
                                            <a href="{{ Storage::url($file->filename) }}" title="View file {{ $file->title }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('file.response', $file->id) }}" title="Show or download file {{ $file->title }}">
                                                <i class="fa fa-expand fa-fw"></i>
                                            </a>
                                            <a href="{{ route('file.download', $file->id) }}" title="Download file {{ $file->title }}">
                                                <i class="fa fa-download fa-fw"></i>
                                            </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
