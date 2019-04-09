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
    <div class="text-center font-subtitle-3">
        <br>
        <br>
        <h3>Selamat Datang di Trayek,</h3>
    </div>
    <div class="text-center font-title">
        <h4>Juanita!</h4>
    </div>
    <br>
    <br>
    <div class="landing-image-direksi">
        <img src="{{ asset('img/landingDireksi.svg')}}">
    </div>
</div>




<!-- 
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10 card card-main ">
            <div class="text-center font-subtitle-1">
               <br>
               <br>
                <p>Selamat Datang di Trayek,</p>
            </div>
            <div class="text-center font-title">
                <p>Nama!</p>
            </div>
        </div>
        <div class="col-sm-1"></div>
</div>
</div> -->







