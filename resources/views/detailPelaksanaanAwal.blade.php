@extends('layouts.layout')
<body>
<link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}"/>		
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>		
<style>		
div.gallery {		
border: 1px solid #ccc;		
}		
div.gallery:hover {		
border: 1px solid #777;		
}		
div.gallery img {		
width: 100%;		
height: auto;		
}		
* {		
box-sizing: border-box;		
}		
.responsive {		
    height: auto;		
    width: 24.99999%;		
}		
@media only screen and (max-width: 700px) {		
.responsive {		
    width: 49.99999%;		
    margin: 6px 0;		
}		
}		
@media only screen and (max-width: 500px) {		
.responsive {		
    width: 100%;		
}		
}		
</style>

@section ('content')
@include('layouts.nav')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb"style="margin-left:120px;">
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="">Daftar Proyek</a></li>  
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="/pelaksanaan/{{$pelaksanaan->proyek_id}}">LAPJUSIK Proyek {{$namaProyek}}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="">Detail LAPJUSIK</a></li>
  </ol>
</nav>

<div class="container-fluid row" style="margin-left:100px;">

<div class="container-fluid card card-detail-lapjusik col-sm-6">
  <div class="row">
    <br>
    <div class="col-sm-8"> 
            <p class="font-subtitle-2" style="text-align: center">Detail LAPJUSIK Bulan {{$pelaksanaan->bulan}}</p>
    </div>
    <div class="col-sm-4">
        @if($status == 'DISETUJUI') <div class="font-status-approval" style="margin:10px; color:blue;">{{$status}}</div>
        @elseif($status == 'MENUNGGU PERSETUJUAN') <div class="font-status-approval" style="margin:5px; color:green;">{{$status}}</div>
        @elseif($status == 'DITOLAK') <div class="font-status-approval" style="margin:10px;color:red;">{{$status}}</div>
        @endif
    </div>
  </div><hr><br>

    @foreach($listPekerjaan as $pekerjaan)
    <div class="container-fluid card card-uraian-kerja"><br>
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
                    </ul>
                </div>
              
                <div class="col-sm-12">
                    <div class="your-class" style ="margin:25px;">
                        @if ($listFoto != null)
                            @if($listIdPekerjaan!=null)
                                @foreach($listIdPekerjaan as $idKemajuan)
                                        @if($pekerjaan->id == $idKemajuan->pekerjaan_id) 
                                        @foreach ($listFoto as $foto)
                                            @if($foto->kemajuan_id == $idKemajuan->id and $foto->kemajuan_id == $idKemajuan->id)
                                            <div class="responsive" style = "margin-right: 10px;">
                                                <div class="gallery">
                                                    <a target="_blank">
                                                        <img src="{{asset($foto->path)}}" style="object-fit:cover;object-position:50% 10%;">
                                                        
                                                    </a>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    @endforeach
</div>

<div class="col-sm-3"></div>
<!-- approval -->
@if(Auth::user()->role == 4 && $pelaksanaan->approvalStatus == 0)
<div class="card card-review col-sm-3" style="margin-left: 30px;">
      <br>
      <p class="font-subtitle-5">Ubah Status LAPJUSIK</p>
      <hr>
      <div class="container-fluid row" style="margin-top:-5px; margin-bottom:5px;">
        <div class="col-sm-5" >
          <form action="/lapjusik/setujuiLapjusik/tolak/{{ $pelaksanaan->id }}" method="POST" id="reject">
            @csrf
            <button id="tolak" class="button-disapprove font-approval" style="padding: 8px 8px;margin:5px;margin-left:-15px;">TOLAK</button>
          </form> 
        </div>
        <div class="col-sm-5" > 
          <form action="/lapjusik/setujuiLapjusik/setuju/{{ $pelaksanaan->id }}" method="POST" id="save">
            @csrf
            <button id="simpan3" class="button-approve font-approval" style="padding: 8px 8px; margin: 5px; margin-right:15px;">SETUJUI</button>
          </form> 
        </div>
      </div>
</div>

<div id="mod" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">				
                <h4 class="modal-title" style="text-align:center;">Tolak LAPJUSIK</h4>	
            </div>
            <div class="modal-body">
                <p class="text-center">LAPJUSIK berhasil ditolak</p>
            </div>
            <div class="modal-footer text-center">
                <button class="btn btn-success btn-block" data-dismiss="modal" id="NO">OK</button>
            </div>
        </div>
    </div>
</div>  
    
<div id="myMod" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">				
                <h4 class="modal-title" style="text-align:center;">Setujui LAPJUSIK</h4>	
            </div>
            <div class="modal-body">
                <p class="text-center">LAPJUSIK berhasil disetujui</p>
            </div>
            <div class="modal-footer text-center">
                <button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
            </div>
        </div>
    </div>
</div>

@endif

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    
    <script>
	$( document ).ready(function() {
        $('.your-class').slick({
            infinite: true,				
            lazyLoad: 'ondemand',
            slidesToShow: 2,
            slidesToScroll: 2,
            dots: true
        });
        $('.alert').alert();
 
		$("#simpan").click(function(e){
			e.preventDefault();
			//checks if it's valid
		//horray it's valid
			$("#myMod").modal("show");
			
		});
		$("#OK").click(function(e){
		   $('#save').submit();
		});
        $("#tolak").click(function(e){
			e.preventDefault();
			//checks if it's valid
		//horray it's valid
			$("#mod").modal("show");
			
		});
		$("#NO").click(function(e){
		   $('#reject').submit();
        });
  	});
	</script>
@endsection 