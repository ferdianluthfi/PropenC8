@extends('layouts.layout')

@section('content')
@include('layouts.nav')

@if ($status =='0')
<!-- Breadcrumbs (ini buat navigation yaa) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek', $id) }}">Detail Proyek {{ $proyek->projectName }}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="#">Menyetujui Kontrak Kerja</a></li>  
  </ol>
</nav>

<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Menyetujui Kontrak Kerja</p>
    <hr>
    <div class="row">
        <div class="col-sm-7 font-subtitle-2">Informasi Kontrak Kerja</div>
        <div class="col-sm-3 font-status-approval">{{ $statusHuruf }}</div>


    </div>
</div>

<form action="/proyek/{{$id}}/kontrak/approve" method="POST" id="save">
        @csrf
        <div class="container-btn">
                    <button class="container-form-btn" id="simpan">
                            <span>
                                SETUJUI
                            </span>
                    </button>
            </div>
    </form>
    <form action="/proyek/{{$id}}/kontrak/disapprove" method="POST", id="reject">
        @csrf
        <div class="container-btn">
                    <button class="container-form-btn" id="tolak">
                            <span>
                                TOLAK
                            </span>
                    </button>
            </div>
    </form>

@endif



@if ($status =='1' || $status =='2')
<!-- Breadcrumbs (ini buat navigation yaa) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek') }}">Proyek</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('proyek', $id) }}">Detail Proyek {{ $proyek->projectName }}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="#">Detail Kontrak Kerja</a></li>
  </ol>
</nav>

<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-2"> Detail </p>
</div>
@endif
