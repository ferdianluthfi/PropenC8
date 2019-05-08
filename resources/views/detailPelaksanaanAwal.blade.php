@extends('layouts.layout')

@if(Auth::user()->role == 4)
@section ('content')
@include('layouts.nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="">Daftar Proyek</a></li>  
          <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="">Detail LAPJUSIK</a></li>
        </ol>
    </nav>

    
    @if( $pelaksanaan->approvalStatus == 0)
    <div class="row">
            <div class="container-fluid card col-md-6" style="width:829px; height:600px;margin:0 50px;">
                <div class="row">
                    <br>
                    <div class="col-sm-10"> 
                            <p class="font-subtitle-2" style="text-align: center">Detail LAPJUSIK Bulan {{$pelaksanaan->bulan}}</p>
                    </div>
                    <div class="col-sm-2">
                        @if($status == 'DISETUJUI') <div class="font-status-approval" style="margin:10px; color:blue;">{{$status}}</div>
                        @elseif($status == "SEDANG BERJALAN") <div class="font-status-approval" style="margin:5px; color:green;">{{$status}}</div>
                        @elseif($status == 'DITOLAK') <div class="font-status-approval" style="margin:10px;color:red;">{{$status}}</div>
                        @endif
                    </div>
                </div>
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
                    </div>
                </div><br> 
                @endforeach
            </div>
            <div class="container-fluid col-md-6" style="width:354px; height:316px;">   
                <div  class="row card card-tombol">
                    <div class="row judul">
                        <div class="font-subtitle-4" style="text-align: center">Ubah Status LAPJUSIK</div>
                    </div>
                    <hr>
                    <div class="col-sm-5"  style="margin: 10px;"> 
                        <form action="/lapjusik/setujuiLapjusik/tolak/{{ $pelaksanaan->id }}" method="POST" id="reject">
                            @csrf
                            <button id="tolak" class="button-disapprove font-approval" style="padding: 8px 8px;">TOLAK</button>
                        </form> 
                    </div>
                    <div class="col-sm-5"  style="margin: 10px;"> 
                            <form action="/lapjusik/setujuiLapjusik/setuju/{{ $pelaksanaan->id }}" method="POST" id="save">
                                @csrf
                                <button id="simpan" class="button-approve font-approval" style="padding: 8px 8px;">SETUJUI</button>
                            </form> 
                    </div>
                </div>
            </div>
    </div>
    @else
    <div class="container-fluid card" style="width:829px; height:600px;">
            <div class="row">
                <br>
                <div class="col-sm-10"> 
                        <p class="font-subtitle-2" style="text-align: center">Detail LAPJUSIK Bulan {{$pelaksanaan->bulan}}</p>
                </div>
                <div class="col-sm-2">
                    @if($status == 'DISETUJUI') <div class="font-status-approval" style="margin:10px; color:blue;">{{$status}}</div>
                    @elseif($status == "SEDANG BERJALAN") <div class="font-status-approval" style="margin:5px; color:green;">{{$status}}</div>
                    @elseif($status == 'DITOLAK') <div class="font-status-approval" style="margin:10px;color:red;">{{$status}}</div>
                    @endif
                </div>
            </div>
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
                </div>
            </div><br> 
            @endforeach
        </div>
    @endif

    <div id="mod" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">				
                        <h4 class="modal-title" style="text-align:center;">Tolak!</h4>	
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Proyek berhasil ditolak</p>
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
                    <h4 class="modal-title" style="text-align:center;">Setuju!</h4>	
                </div>
                <div class="modal-body">
                    <p class="text-center">Proyek berhasil disetujui</p>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn btn-success btn-block" data-dismiss="modal" id="OK">OK</button>
                </div>
            </div>
        </div>
    </div> 

    <br>
@endsection

@elseif(Auth::user()->role == 6)
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
        <p class="col-sm-6  font-subtitle-1">Detail LAPJUSIK Bulan {{$pelaksanaan->bulan}}</p>
        @if($status == 'DISETUJUI') <div class="col-sm-5 font-status-approval" style="margin-left:15px; color:blue;">{{$status}}</div>
        @elseif($status == "SEDANG BERJALAN") <div class="col-sm-5 font-status-approval" style="margin-left:15px; color:green;">{{$status}}</div>
        @elseif($status == 'DITOLAK') <div class="col-sm-5 font-status-approval" style="margin-left:15px;color:red;">{{$status}}</div>
        @endif
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
            </div>
        </div><br>
    
        @endforeach
    </div>

@endsection

@endif

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
	<script>
	$( document ).ready(function() {
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
