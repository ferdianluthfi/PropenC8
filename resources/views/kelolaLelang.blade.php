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
    <table>
        <tbody>
            <tr>
                <td>
                    Nama Proyek
                </td>
                <td>
                    :   {{ $proyek->projectName }}
                </td>
            </tr>
            <tr>
                <td>
                    Alamat Proyek
                </td>
                <td>
                    :   {{ $proyek->projectAddress }}
                </td>
            </tr>
            <tr>
                <td>
                    Nama User apa ini
                </td>
                <td>
                    :   {{ $proyek->name }}
                </td>
            </tr>
            <tr>
                <td>
                    Nama Perusahaan
                </td>
                <td>
                    :   {{ $proyek->companyName }}
                </td>
            </tr>
            <tr>
                <td>
                    Alamat Proyek
                </td>
                <td>
                    :   {{ $proyek->projectAddress }}
                </td>
            </tr>
            <tr>
                <td>
                    Deskripsi
                </td>
                <td>
                    :   {{ $proyek->description }}
                </td>
            </tr>
            <tr>
                <td>
                    Nilai Proyek
                </td>
                <td>
                    :   {{ $proyek->projectValue }}
                </td>
            </tr>
            <tr>
                <td>
                    Perkiraan waktu pengerjaan proyek
                </td>
                <td>
                    :   {{ $proyek->estimatedTime }}
                </td>
            </tr>
        </tbody>
    </table>


<!--    @foreach ($berkass as $object)-->
<!--        {{ $object->id }}-->
<!--        {{ $object->fileBerkas }}-->
<!--        {{ $object->created_at}}-->
<!--        <br>-->
<!--    @endforeach-->

    <br>
    <table border="I">
        <caption>Kelola Berkas Lelang</caption>
        <thead>
            <tr>
                <th>Berkas</th>
                <th>Hapus Berkas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($berkass as $object)
            <tr>
                <th>
                    {{ $object->id }}
                    {{ $object->fileBerkas }}
                    {{ $object->created_at}}
                </th>
                <th>
                    <button type="button" onclick="window.location.href='/kelolaLelang/delete/{{ $object->id }}'">
                        <a>hapus</a>
                    </button>
                </th>
            </tr>
            @endforeach
            <tr>
                <th>
                    <input type="hidden" value="{{ $proyek->id }}">
                    <select>
                        <option disabled selected value> -- Pilih Berkas Lelang -- </option>
                        @foreach ($templates as $template)
                        <option name ="template_id" value="{{ $template->id }}">{{ $template->nama_surat }}</option>
                        @endforeach
                    </select>
                    <input type="file" name="fileBerkas">
                </th>
                <th>

                </th>
            </tr>
            <tr>
                <th>
                    <button>Tambah Berkas</button>
                </th>
            </tr>


            <br>


        </tbody>
    </table>
    <form>
<!--        <input type="hidden" value="{{ $proyek->id }}">-->
<!--        <select>-->
<!--            <option disabled selected value> -- Pilih Berkas Lelang -- </option>-->
<!--            @foreach ($templates as $template)-->
<!--            <option name ="template_id" value="{{ $template->id }}">{{ $template->nama_surat }}</option>-->
<!--            @endforeach-->
<!--        </select>-->
        <br>
        <br>
        <input type="file" name="fileBerkas">
        <br><br>
        <button type="button">
            <a>Simpan</a>
        </button>
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
