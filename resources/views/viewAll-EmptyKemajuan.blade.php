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
    <ul>
    
    @php
    $id =1;
    @endphp
    @foreach ($proyeks as $proyek)

    <div class="container-fluid card card-info" style="margin:10px auto;min-height:100px;min-width: -webkit-fill-available;">
        <a href="/assignedproyek/detil/{{$proyek['id']}}">
            <h3 style="text-align:center; margin-bottom:5px; margin-top:10px" >{{$proyek['projectName']}}</h3>
        </a>
        <p style="text-align:center;">
            {{$proyek['projectKlien']}}
        </p>
        <hr style="background-color:black; margin-top:10px"/>
        
        <!-- semuanya -->
        <div id= "myProgressDetail-<?php echo $id ?>" class="myProgressDetail" style="display:none;" value="1"> 
            
            <p style="margin-left:4px">Gaji Karyawan : Rp{{number_format(0, 2, ',','.')}}</p>
            <div id="myProgress" style="margin-bottom:3px"> 
                <div id="myBar" style="width: 0%; margin-bottom:10px;">
                </div>
            </div>

            <p style="margin-left:4px">Belanja : Rp{{number_format(0, 2, ',','.')}}</p>
            <div id="myProgress" style="margin-bottom:3px">
            <div id="myBar" style="width: 0%; margin-bottom:10px;">
                </div>
            </div>

            <p style="margin-left:4px">Administrasi : Rp{{number_format(0, 2, ',','.')}}</p> 
            <div id="myProgress" style="margin-bottom:3px">
            <div id="myBar" style="width: 0%; margin-bottom:10px;">
                </div>
            </div>

        </div>

        <!-- satu doang -->
        <p id="title-<?php echo $id ?>" style="margin-left:4px">Total Penggunaan Dana : Rp{{number_format(0, 2, ',','.')}}</p>
        <div id="myProgress-<?php echo $id ?>" style="display:block; background-color: #fff; border-radius: 25px; border: 1px solid #ddd;height: 30px;">
            <div id="myBar" style="width: 0%; margin-bottom:10px;">
                </div>
        </div>
        <center><button id="messageType-<?php echo $id ?>" onclick="showAll(<?php echo $id ?>)" style="margin:5px;">Tampilkan Lebih Banyak</button></center>
        @php
        $id++;
        @endphp

    </div>
    @endforeach

</ul>
</div>

@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
        function showAll($data) {
            console.log($data);
            console.log(document.getElementById("myProgressDetail-"+$data).style.display)

            if(document.getElementById("myProgressDetail-"+$data).style.display == 'none'){
                document.getElementById("myProgressDetail-"+$data).style.display = 'block';
                document.getElementById("myProgress-"+$data).style.display = 'none';
                document.getElementById("title-"+$data).style.display = 'none';
                document.getElementById("messageType-"+$data).innerHTML = "Tampilkan Lebih Sedikit";
            }
            else{
                document.getElementById("myProgressDetail-"+$data).style.display = 'none';
                document.getElementById("myProgress-"+$data).style.display = 'block';
                document.getElementById("title-"+$data).style.display = 'block';
                document.getElementById("messageType-"+$data).innerHTML = "Tampilkan Lebih Banyak";
            }
        }



    </script>
@endsection
