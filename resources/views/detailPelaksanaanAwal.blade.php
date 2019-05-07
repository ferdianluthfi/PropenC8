@extends('layouts.layout')
<body>

@section ('content')
@include('layouts.nav')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="">Daftar Proyek</a></li>  
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="">Detail LAPJUSIK</a></li>
  </ol>
</nav>

<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Detail LAPJUSIK Bulan {{$pelaksanaan->bulan}}</p>
    <hr>

    @foreach($listPekerjaan as $pekerjaan)
    <div class="container-fluid card card-kontrak"><br>
        <div class="row" style="margin-left: -30px;">
            <div class="col-sm-12">
                <div class="col-sm-4 font-desc-bold">
                    <ul>
                        <li><p>Uraian Pekerjaan</p></li>
                        <li><p>Alokasi Biaya</p></li>
                        <li><p>Bobot</p></li>
                        <li><p>Pengeluaran Bulan Ini</p></li>
                        <li><p>Realisasi Bulan Lalu</p></li>
                        <li><p>Realisasi Bulan Ini</p></li>
                        <li><p>Realisasi Sampai Bulan Ini</p></li>             
                    </ul>
                </div>

                <div class="col-sm-8 font-desc">
                    <ul>
                        <li><p>{{ $pekerjaan->name }}</li> 
                        <li><p style="color:#00C48C">Rp {{ number_format($pekerjaan->workTotalValue, 2) }}<p></li>
                        <li><p>{{$pekerjaan->workTotalValue / $valueProyek * 100 }}%<p></li>

                        @foreach($biayaKeluar as $biaya)
                            @if($pekerjaan->id == $biaya->pekerjaan_id)
                                @if($biaya->sum == 0)
                                @else
                                    @if($realisasiLalu == 0)
                                        <li><p style="color:#FF647C">Rp {{number_format($biaya->sum, 2)}}<p></li>
                                        <li><p> 0 % <p></li>
                                        <li><p style="color:#00C48C"> {{(($biaya->sum) / ($pekerjaan->workTotalValue)*100)}} % <p></li>
                                        <li><p style="color:#3378D3"> {{(($biaya->sum) / ($pekerjaan->workTotalValue)*100)}} % <p></li>
                                    @endif
                                @endif
                            @endif
                        @endforeach

                        @if ($listFoto != null)
                            @foreach ($listFoto as $foto)
                                @if($listIdPekerjaan!=null)
                                    @foreach($listIdPekerjaan as $idKemajuan)
                                        @if($pekerjaan->id == $idKemajuan->pekerjaan_id)
                                        <br>
                                        <div class="responsive">
                                            <div class="gallery">
                                                <a target="_blank">
                                                    <img src="{{asset($foto->path)}}" width="300" height="300">
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            <div class="clearfix"></div>
                        @endif

                    </ul>
                </div>
            </div>
            <div>
                <br>
                <br>
                <div  class="row ketengahin" style="margin-right: 58px; margin-bottom: 30px">
                    <div class="col-sm-5">
                        <div class="card card-tombol" style="margin-right: 40px">
                            <div class="row judul">
                                <div class="font-subtitle-4">Ubah Status LAPJUSIK</div>
                            </div>
                            <div style="margin: 30px; height: 60px; position: center">
                                <div class="col-sm-2"> 
                                    <form action="/proyek/setujuiProyek/tolak/{{ $proyek->id }}" method="POST" id="reject">
                                        @csrf
                                        <button id="tolak" class="button-disapprove font-approval">TOLAK</button>
                                    </form> 
                                </div>
                                <div class="col-sm-2"> 
                                    <form action="/proyek/setujuiProyek/setuju/{{ $proyek->id }}" method="POST" id="save">
                                        @csrf
                                        <button id="simpan" class="button-approve font-approval">SETUJUI</button>
                                    </form>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div><br>
    @endforeach
</div>
</body>
@endsection