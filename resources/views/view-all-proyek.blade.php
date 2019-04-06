@extends('layouts.layout')

@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="{{ url('proyek') }}">Proyek</a></li>
  </ol>
</nav>

<!-- isinya -->
<div class="container-fluid card card-proyek-list">

    <br>
    <p class="font-subtitle-1">Proyek Potensial</p>
    <hr>

    @foreach ($proyekPotensial as $proyek)
    <a href="{{ route('detail-proyek', $proyek->id) }}">
        <div>
            {{ $proyek->projectName}}
        </div>
    </a>
    @endforeach
    
</div>

<div class="container-fluid card card-proyek-list">

    <br>
    <p class="font-subtitle-1">Riwayat Proyek</p>
    <hr>

    @foreach ($proyeks as $proyek)
    <a href="{{ route('detail-proyek', $proyek->id) }}">
        <div>
            {{ $proyek->projectName}}
        </div>
    </a>
    @endforeach
</div>




