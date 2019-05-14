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
    <div >
        <p class="text-center font-title">Oops!</p>
    </div>
    <div class="error-404-image">
        <img src="{{ asset('img/error404.svg')}}">
    </div>
    <br>
    
    <div class="text-center font-subtitle-4">
        <p>Halaman tidak ditemukan.</p>
        <p>Kembali ke <a href="{{ url('home') }}">Beranda</a> </p>
    </div>
</div>

@include('layouts.footer')