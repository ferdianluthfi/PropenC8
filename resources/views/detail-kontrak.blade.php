@extends('layouts.layout')

@section('content')
@include('layouts.nav')

<p> {{ $statusHuruf }} </p>
<a> tunjukkan dirimu </a>



@if ($status == '0')
    <form action="/updateProyek" method="POST">
    <a href=""" class="btn btn-primary">Setujui</a>
    <a href="" class="btn btn-primary">Tolak</a>
@endif

