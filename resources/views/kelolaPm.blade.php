@extends('layouts.layout')

<html>
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

@section ('content')
@include('layouts.nav')
<body>


<div class="container-fluid card card-detail-proyek form-group {{ !$errors->has('selected') ?: 'has-error' }}" style="padding-top: 20px; padding-bottom: 20px; min-height: auto">
    <span class="help-block text-danger">{{ $errors->first('selected') }}</span>
    <p class="font-subtitle-1">Ubah PM</p>
    <form action="/pm/update" method="post">
        {{ csrf_field() }}
        {{ method_field('post') }}
        <table id="datatable" class="table table-striped table-bordered" >
            <thead>
                <th>ID</th>
                <th>Nama</th>
                <th>Jumlah Proyek</th>
                <th>Kelola</th>
            </thead>
            <tbody>
            @foreach ($pmgrs as $pm)
            <tr>
                <td>{{ $pm->id }}</td>
                <td>{{ $pm->username }}</td>
                <td>{{ $count }}</td>
                <td style="vertical-align: center"><input type="radio" name="selected" value="{{$pm->id}}">
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-6" style="vertical-align: center">
                <button class="button-disapprove">BATAL</button>
                <button class="button-approve" id="simpan" aria-hidden="true">SIMPAN</button>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </form>
</div>

</body>

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js" integrity="sha256-+h0g0j7qusP72OZaLPCSZ5wjZLnoUUicoxbvrl14WxM=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/umd/util.js"></script>

<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    });
</script>
@endsection
</html>
