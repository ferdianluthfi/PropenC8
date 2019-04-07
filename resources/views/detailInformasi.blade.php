@extends('layouts.layout')

@section ('content')
@include('layouts.nav')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('assignedproyek') }}">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/proyek/detail/{{$proyek->id}}'>Detail Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href='/informasi/{{$proyek->id}}'>Informasi Kemajuan</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href='/informasi/detail/{{$informasi->id}}'>Detail Kemajuan</a></li>
  </ol>
</nav>

<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Detail Kemajuan</p>
    <hr>

    <div class="container-fluid card card-kontrak">
        <div class="row judul">
                    <div class="col-sm-3 font-subtitle-4">Informasi Umum</div>
        </div>
        <hr>
        <div class="row" style="margin-left: -30px;">
            <div class="col-sm-12">
                    <div class="col-sm-3 font-desc-bold">
                        <ul>
                            <li><p>Tipe Kemajuan</p></li>
                            <li><p>Tanggal Kemajuan</p></li>
                            <li><p>Nilai Kemajuan</p></li>
                            <li><p>Uraian Pekerjaan</p></li>
                        </ul>
                    </div>
                    <div class="col-sm-1">
                        <li><p>:</p></li>
                        <li><p>:</p></li>
                        <li><p>:</p></li>
                        <li><p>:</p></li>
                    </div>
                    <div class="col-sm-8 font-desc">
                        <ul>
                                @if ($informasi->tipeKemajuan ==1)
                                    <li><p>Gaji<p></li> 
                                @elseif ($informasi->tipeKemajuan ==2)
                                    <li><p>Belanja<p></li> 
                                @elseif ($informasi->tipeKemajuan ==3)
                                    <li><p>Administrasi<p></li>  
                                @endif 

                                <li><p>{{ $tanggal }}<p></li>
                                <li><p>Rp {{ $informasi->value}}<p></li>
                                <li><p class="deskripsi" style="margin-bottom:10px;" >{{ $informasi->description }}<p></li> <br>
                                @foreach ($daftarFoto as $foto)
                                    <li><p>{{$foto}}</p></li>
                                    <li><p>{{$foto->id}}</p></li>
                                @endforeach
                        </ul>
                    </div> <br>
            </div>
            <h3> Foto </h3>
            @foreach ($daftarFoto as $foto)
                <p>{{$foto -> path}}</p>
                {{$foto->id}}
            @endforeach
        </div>
    </div><br><br>
    <div class="container1-btn">
        <a href="/info/edit/{{$informasi->id}}" class="container1-form-btn">Ubah Informasi</a>
    </div>
    <div class="container2-btn">
        <a href="/info/delete/{{$informasi->id}}" class="container2-form-btn">Hapus Informasi</a>
    </div>
</div>
@endsection