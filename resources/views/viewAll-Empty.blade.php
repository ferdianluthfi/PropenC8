@extends('layouts.layout')

@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa) -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="{{ url('home') }}">Beranda</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="{{ url('kemajuanProyek') }}">Kemajuan Proyek</a></li>
  </ol>
</nav>

<div class="container-fluid card card-main">
    <div class="text-center font-title">
      <br>
        <strong> <h3>Kemajuan Proyek</h3> </strong>
        <br>
    </div>
    <hr>
    <br><br><br><br><br><br><br><br><br><br>
    <div class="text-center font-title">
        <h3>Tidak ada proyek yang sedang berjalan.</h3>
        <a href="/home" style="color:darklateblue">kembali<a>
    </div>




@endsection