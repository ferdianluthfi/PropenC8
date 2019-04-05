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
        <p>Kemajuan Proyek</p>
    </div>
<ul>
    
    @foreach ($proyekDetail as $proyek)
    <div class="container-fluid card card-info" style= "margin-bottom:10px;">
        <h3 style="text-align:center;">
            {{$proyek['projectName']}}
        </h3>
        <p style="text-align:center;">
            {{$proyek['projectKlien']}}
</p>
        <hr style="background-color:black;"/>

        <div id="myProgressDetail" style="display:none;" > 
            <div id="myProgress">
                <div id="myBar" style="width: <?php echo ($proyek['totalGaji']/ $proyek['maxValue'])*100 ?>%; margin-bottom:10px;">
                    {{($proyek['totalGaji']/ $proyek['maxValue'])*100}}%
                </div>
            </div>
            <br>
            <div id="myProgress" >
                <div id="myBar" style="width: <?php echo ($proyek['totalBelanja']/ $proyek['maxValue'])*100 ?>%; margin-bottom:10px;">
                    {{($proyek['totalBelanja']/ $proyek['maxValue'])*100}}%
                </div>
            </div>
            <br>
            <div id="myProgress">
                <div id="myBar" style="width: <?php echo ($proyek['totalAdministrasi']/ $proyek['maxValue'])*100 ?>%; margin-bottom:10px;">
                    {{($proyek['totalAdministrasi']/ $proyek['maxValue'])*100}}%
                </div>
            </div>
        </div>
        <div id="myProgress">
            <div id="myBar" style="width: <?php echo ($proyek['totalKeseluruhan']/ $proyek['maxValue'])*100 ?>%">
                {{($proyek['totalKeseluruhan']/ $proyek['maxValue'])*100}}%
            </div>
        </div>
        <button id="messageType" onclick="showAll()" >Tampilkan Lebih Banyak</button>
        
    </div>
    @endforeach

</ul>
</div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
        function showAll() {
            if(document.getElementById("myProgressDetail").style.display == 'none'){
                $('#myProgressDetail').show();
                document.getElementById("myProgress").style.display = "none";
                document.getElementById("messageType").innerHTML = "Tampilkan Lebih Sedikit";
            }
            else{
                $('#myProgressDetail').hide()
                $("#messageType").prop('value', 'Tampilkan Lebih Banyak');
                document.getElementById("myProgress").style.display = "show";
                document.getElementById("messageType").innerHTML = "Tampilkan Lebih Banyak";
            }
        }
    </script>
@endsection