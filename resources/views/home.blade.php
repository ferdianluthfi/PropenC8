@extends('layouts.layout')

@section ('content')
@include('layouts.nav')


<div class="container-fluid card card-main">
    <div class="text-center font-subtitle-3">
            <br>
            <br>
            Selamat Datang di Trayek,
    </div>
    <div class="card-body">
        <!-- Gua masih gatau fungsi if disini buat apaan-->
        @if (session('status'))
            <div class="alert alert-success" role="alert">      
                {{ session('status') }}
            </div>
        @endif
        <div class="text-center font-title">
            {{Auth::user()->name}}!
        </div>
        <br>
        <br>
        <div class="landing-image-direksi">
            <img src="{{ asset('img/landingDireksi.svg')}}">
        </div>
    </div>
</div>

@endsection
