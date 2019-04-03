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

    <br>
    <table border="I">
        <caption>Kelola Berkas Lelang</caption>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>File Name</th>
                <th>Created_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($berkass as $object)
            <tr>
                <td>
                    {{ $object->id }}
                </td>
                <td>
                    {{ $object->title }}
                </td>
                <td>
                    {{ $object->filename }}
                </td>
                <td>
                    {{ $object->created_at->diffForHumans()}}
                </td>
                <td>
                    <a href="{{ Storage::url($object->path) }}" title="View file {{ $object->title }}">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('file.response', $object->id) }}" title="Show or download file {{ $object->title }}">
                        <i class="fa fa-expand fa-fw"></i>
                    </a>
                    <a href="{{ route('file.download', $object->id) }}" title="Download file {{ $object->title }}">
                        <i class="fa fa-download fa-fw"></i>
                    </a>
                    <a href="/file/{{ $object->id }}/delete" title="Delete file {{ $object->title }}">
                        <i class="fa fa-trash fa-fw"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            <!-- <tr>
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
            </tr> -->
        </tbody>
    </table>
    <br>
    <br>
    <div>Upload New File</div>
    <div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <p>
        <a href="/file/upload/{{ $proyek->id }}" class="btn btn-primary">Upload File</a>
    </p>
</body>
</html>
