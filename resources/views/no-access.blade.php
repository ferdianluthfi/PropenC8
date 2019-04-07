@extends('layouts.layout')

@section ('content')
@include('layouts.nav')

<!-- Breadcrumbs (ini buat navigation yaa) -->
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active font-breadcrumb-active" aria-current="page"><a href="{{ url('home') }}">Beranda</a></li>
  </ol>
</nav>

<!-- isinya -->
<div class="container-fluid card card-main">
    <br>
    <div class="text-center font-title">
        <p>Oops!</p>
    </div>
    <br>
    <div class="no-access-image">
        <img src="{{ asset('img/no-access.svg')}}">
    </div>
    <br>
    <br>
    <div class="text-center font-subtitle-4">
        <p>Anda tidak memiliki akses untuk halaman ini.</p>
        <p>Kembali ke <a href="{{ url('home') }}">Beranda</a> </p>
    </div>
</div>

@include('layouts.footer')