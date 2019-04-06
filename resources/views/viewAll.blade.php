@extends('layouts.layout')

@section ('content')
@include('layouts.nav')
<!-- Breadcrumbs (ini buat navigation yaa) -->
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active font-breadcrumb-active" aria-current="page">
        <a href="{{ url('home') }}">Beranda</a>
    </li>
    <li class="breadcrumb-item active font-breadcrumb-active" aria-current="page">
    <a href="{{ url('kemajuanProyek') }}">Kemajuan Proyek</a>
    </li>
  </ol>
</nav>

<div class="container-fluid card card-main">
    <div class="text-center font-title">
        <strong> <h3>Kemajuan Proyek</h3> </strong>
        </div>
    <ul>
    
    @php
    $id =1;
    @endphp
    @foreach ($proyekDetail as $proyek)

    <div class="container-fluid card card-info" style="margin:10px auto;min-height:100px;float:none; ">
        <h3 style="text-align:center; margin-bottom:5px; margin-top:10px">
            {{$proyek['projectName']}}
        </h3>
        <p style="text-align:center;">
            {{$proyek['projectKlien']}}
</p>
        <hr style="background-color:black; margin-top:10px"/>
        
        <div id= "myProgressDetail-<?php echo $id ?>" class="myProgressDetail" style="display:none;" value="1"> 
            
            <div id="myProgress" style="margin-bottom:3px"> 
                <div id="myBar" style="width: <?php echo ($proyek['totalGaji']/ $proyek['maxValue'])*100 ?>%; margin-bottom:10px;">
                    {{($proyek['totalGaji']/ $proyek['maxValue'])*100}}%
                </div>
            </div>

            <div id="myProgress" style="margin-bottom:3px">
                <div id="myBar" style="width: <?php echo ($proyek['totalBelanja']/ $proyek['maxValue'])*100 ?>%; margin-bottom:10px;">
                    {{($proyek['totalBelanja']/ $proyek['maxValue'])*100}}%
                </div>
            </div>

            <div id="myProgress" style="margin-bottom:3px">
                <div id="myBar" style="width: <?php echo ($proyek['totalAdministrasi']/ $proyek['maxValue'])*100 ?>%; margin-bottom:10px;">
                    {{($proyek['totalAdministrasi']/ $proyek['maxValue'])*100}}%
                </div>
            </div>

        </div>

        <div id="myProgress" style="display:block">
            @if((($proyek['totalKeseluruhan']/ $proyek['maxValue'])*100) > 100 )
                <div id="myBar" style="width: 100%; background-color: #B22222; ">
                 Anggaran Berlebihan!
                </div>
            @else
            <div id="myBar" style="width: <?php echo ($proyek['totalKeseluruhan']/ $proyek['maxValue'])*100 ?>%; margin-bottom:10px;">
            {{($proyek['totalKeseluruhan']/ $proyek['maxValue'])*100}}%
            </div>
            @endif
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
                document.getElementById("messageType-"+$data).innerHTML = "Tampilkan Lebih Sedikit";
            }
            else{
                document.getElementById("myProgressDetail-"+$data).style.display = 'none';
                document.getElementById("messageType-"+$data).innerHTML = "Tampilkan Lebih Banyak";
            }
        }
    </script>
@endsection
