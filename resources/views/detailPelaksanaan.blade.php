@extends('layouts.layout')
<body><!-- Bootstrap CSS CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
     <!-- Our Custom CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="/proyek">Daftar Proyek</a></li>  
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-inactive" href="/pelaksanaan/{{$pelaksanaan->proyek_id}}">LAPJUSIK Proyek {{$namaProyek}}</a></li>
    <li class="breadcrumb-item" aria-current="page"><a class="font-breadcrumb-active" href="">Detail LAPJUSIK</a></li>
  </ol>
</nav>

<div class="container-fluid row" style="margin-left:100px;">

<div class="container-fluid card card-detail-lapjusik col-sm-6">
  <div class="row">
    <br>
    <div class="col-sm-8"> 
            <p class="font-title" style="text-align: center">Detail LAPJUSIK Bulan {{$pelaksanaan->bulan}}</p>
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
                        <li><p>{{ $pekerjaan->name }}</p></li> 
                        <li><p>Rp {{ number_format($pekerjaan->workTotalValue, 2) }}</p></li>
                        <li><p>{{$pekerjaan->workTotalValue / $valueProyek * 100 }}%</p></li>
                        <li>
                          @foreach($biayaKeluar as $biaya)
                            @if($pekerjaan->id == $biaya->pekerjaan_id)
                                @if($biaya->sum == 0)
                                @else
                                    @if($realisasiLebih == null)
                                    @else
                                        @foreach($realisasiLebih as $realisasi)
                                            @if($realisasi->pekerjaan_id == $pekerjaan->id)
                                                <p> Rp {{number_format($biaya->sum, 2)}} </p>
                                                <?php 
                                                
                                                $realisasiBulanLalu = (($realisasi->sum) / ($pekerjaan->workTotalValue)*100);
                                                $realisasiBulanIni = (($biaya->sum) / ($pekerjaan->workTotalValue)*100);
                                                $realisasiSampaiBulanIni = (($realisasi->sum) / ($pekerjaan->workTotalValue)*100) + (($biaya->sum) / ($pekerjaan->workTotalValue)*100);
                                                ?>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                              @endif
                          @endforeach
                        </li>
                      
                      <li><p>{{$realisasiBulanLalu}} %</p></li>
                      <li><p>{{$realisasiBulanIni}} %</p></li>
                      <li><p>{{$realisasiSampaiBulanIni}} %</p></li>
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
@if(Auth::user()->role == 4)
@if($pelaksanaan->approvalStatus == 0)
<div class="card card-review col-sm-3" style="margin-left: 30px;">
      <br>
      <p class="font-subtitle-5">Ubah Status LAPJUSIK</p>
      <hr>
      <div class="container-fluid row" style="margin-top:-5px; margin-bottom:5px;margin-left:-40px;">
        <div class="col-sm-5" style="margin:10px;">
          <form action="/lapjusik/setujuiLapjusik/tolak/{{ $pelaksanaan->id }}" method="POST" id="reject">
            @csrf
            <button id="tolak" class="button-disapprove font-approval" style="padding: 8px 8px;">TOLAK</button>
          </form> 
        </div>
        <div class="col-sm-5"  style="margin: 10px;"> 
          <form action="/lapjusik/setujuiLapjusik/setuju/{{ $pelaksanaan->id }}" method="POST" id="save">
            @csrf
            <button id="simpan3" class="button-approve font-approval" style="padding: 8px 8px;">SETUJUI</button>
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
@else
<div class="card card-review col-sm-3" style="margin-left: 30px;">
      <br>
      <p class="font-subtitle-5">Review Klien</p>
      <hr>
<div class="container-fluid" style="padding-left:10px; padding-top:5px; padding-right:10px; padding-bottom:5px; border-radius:5px; border:0.5px solid #ECE9F1; width:250px; min-height:60px;">
          <p class="font-desc">
          {{ $displayText }} 
          </p>
      </div>
</div>
@endif
@else
<!-- Review -->
<div class="card card-review col-sm-3" style="margin-left: 30px;">
      <br>
      <p class="font-subtitle-5">Review Klien</p>
      <hr>
  @if($review==null)
  <br>
  <div class="container-fluid" style="padding-left:10px; padding-top:5px; padding-right:10px; padding-bottom:5px; border-radius:5px; border:0.5px solid #ECE9F1; width:250px; min-height:60px;">
          <p class="font-desc">
          {{ $displayText }} 
          </p>
      </div>
      <br>

  @if(Auth::user()->role == 8 && $pelaksanaan->approvalStatus == 1)
      <div class="text-center">
      <button data-toggle="modal" data-target="#add-review" class="button-review font-approval">TAMBAH REVIEW</button>
    </div>
    <div class="modal fade" id="add-review" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" style="height:800px;" role="document">
    <div class="modal-content modal-content-a">
      <div class="modal-header">
        <h5 class="modal-title" style="text-align:center;" id="add-review">Buat Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="/pelaksanaan/detail/{{ $pelaksanaan->id }}/review/add" method="post">
      <input type="hidden" name="idPelaksanaan" value="{{ $pelaksanaan->id }}">
      <div class="modal-body">
          <div class="form-group">
            <label for="rating" style="font-subtitle-2" class="form-control-label">Rating</label>
            <div id="rating-error"></div>
            <div id="stars" class="starrr"></div>
            <input type="hidden" name="rating-star" id="rating-star">
          </div>
          <div class="form-group">
            <label for="komentar" style="font-subtitle-2" class="form-control-label">Komentar</label>
            <div id="komentar-error"></div>
            <textarea class="form-control" name="komentar" id="komentar" placeholder="Masukkan komentar"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-3">
        <button type="button" class="modal-button-disapprove font-approval" style="margin-right:-25px;" data-dismiss="modal">KEMBALI</button>
        </div>
        <div class="col-sm-3">
            @csrf
            <button id="simpan" class="modal-button-approve font-approval">SIMPAN</button>
        </form>   
        </div>
        </div>
      </div>
    </div>
  </div>
  @endif
    @else
      <div class="container-fluid row" style="margin-top:-5px; margin-bottom:5px;">
        <div class="col-sm-6">
          @for ($i=0; $i < $review->rating; $i++)
            <span class="glyphicon glyphicon-star"></span>
          @endfor
          @for ($i=0; $i < (5 - $review->rating); $i++)
            <span class="glyphicon glyphicon-star-empty"></span>
          @endfor
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-3"style="margin-left:-20px;">
          <p class="font-desc text-right">{{ $review->updated_at->format("d/m/Y") }}</p>
        </div>
      </div>
      <div class="container-fluid" style="padding-left:10px; padding-top:5px; padding-right:10px; padding-bottom:5px; border-radius:5px; border:0.5px solid #ECE9F1; width:250px; min-height:60px;">
          <p class="font-desc">
          {{ $displayText }} 
          </p>
      </div>
      @if(Auth::user()->role == 8)
      @if($interval)
      <div class="text-center">
          <input type="hidden" name="id" value="{{ $review->id }}"> <br/>
          <button data-toggle="modal" data-target="#edit-review" class="button-review font-approval">EDIT REVIEW</button>
      </div>
    <div class="modal fade" id="edit-review" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" style="height:800px;" role="document">
    <div class="modal-content modal-content-a">
      <div class="modal-header">
        <h5 style="text-align:center;" id="edit-review">Ubah Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="/pelaksanaan/detail/{{ $pelaksanaan->id }}/review/edit" method="get">
      <input type="hidden" name="idReview" value="{{ $review->id }}">
      <div class="modal-body">
          <div class="form-group">
            <label for="rating" style="font-subtitle-2" class="form-control-label">Rating</label>
            <div id="stars" class="starrr"></div>
            <div id="rating-error"></div>
            <input type="hidden" name="rating-star" id="rating-star">
          </div>
          <div class="form-group">
            <label for="komentar" style="font-subtitle-2" class="form-control-label">Komentar</label>
            <div id="komentar-error"></div>
            <textarea class="form-control" name="komentar" id="komentar"> {{ $displayText }}</textarea>
          </div>
      </div>
      <div class="modal-footer">
        <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-3">
        <button type="button" class="modal-button-disapprove font-approval" style="margin-right:-25px;" data-dismiss="modal">KEMBALI</button>
        </div>
        <div class="col-sm-3">
            @csrf
            <button id="simpan2" class="modal-button-approve font-approval">SIMPAN</button>
        </form>   
        </div>
        </div>
      </div>
    </div>
  </div>
      @endif
      @endif
      @endif
      @endif
   </div>
</div>
</body>
@endsection

@section('scripts')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script>
    var __slice = [].slice;
(function($, window) {
  var Starrr;
  Starrr = (function() {
    Starrr.prototype.defaults = {
      rating: void 0,
      numStars: 5,
      change: function(e, value) {}
    };
    function Starrr($el, options) {
      var i, _, _ref,
        _this = this;
      this.options = $.extend({}, this.defaults, options);
      this.$el = $el;
      _ref = this.defaults;
      for (i in _ref) {
        _ = _ref[i];
        if (this.$el.data(i) != null) {
          this.options[i] = this.$el.data(i);
        }
      }
      this.createStars();
      this.syncRating();
      this.$el.on('mouseover.starrr', 'span', function(e) {
        return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('mouseout.starrr', function() {
        return _this.syncRating();
      });
      this.$el.on('click.starrr', 'span', function(e) {
        return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('starrr:change', this.options.change);
    }
    Starrr.prototype.createStars = function() {
      var _i, _ref, _results;
      _results = [];
      for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
        _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
      }
      return _results;
    };
    Starrr.prototype.setRating = function(rating) {
      if (this.options.rating === rating) {
        rating = void 0;
      }
      this.options.rating = rating;
      this.syncRating();
      return this.$el.trigger('starrr:change', rating);
    };
    Starrr.prototype.syncRating = function(rating) {
      var i, _i, _j, _ref;
      rating || (rating = this.options.rating);
      if (rating) {
        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
        }
      }
      if (rating && rating < 5) {
        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
        }
      }
      if (!rating) {
        return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
      }
    };
    return Starrr;
  })();
  return $.fn.extend({
    starrr: function() {
      var args, option;
      option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      return this.each(function() {
        var data;
        data = $(this).data('star-rating');
        if (!data) {
          $(this).data('star-rating', (data = new Starrr($(this), option)));
        }
        if (typeof option === 'string') {
          return data[option].apply(data, args);
        }
      });
    }
  });
})(window.jQuery, window);
$(function() {
  return $(".starrr").starrr();
});
  $( document ).ready(function() {
        $('#stars').on('starrr:change', function(e, value){
            $('#rating-star').val(value);
        });
        
        $('#stars-existing').on('starrr:change', function(e, value){
            $('#count-existing').html(value);
        });
        $("#add-review").click(function(e){
        });
        $('.your-class').slick({
            infinite: true,       
            lazyLoad: 'ondemand',
            slidesToShow: 2,
            slidesToScroll: 2,
            dots: true
        });
        $("#simpan3").click(function(e){
          e.preventDefault();
          //checks if it's valid
        //horray it's valid
          $("#myMod").modal("show");
          
        });
    @if($review==null)    
    $("#simpan").click(function(e){
      e.preventDefault();
            var data = {
                'rating_star': $('#rating-star').val(),
                'komentar': $('#komentar').val(),
                'pelaksanaan_id': parseInt('{{$pelaksanaan->id}}'),
                '_token': "{{ csrf_token() }}"
            }
            var rating_star = $("#rating-star").val()
            var komentar = $("#komentar").val()
            if (rating_star != "" && komentar != "") {
              $.ajax({
                url:'/pelaksanaan/detail/{{ $pelaksanaan->id }}/review/add',
                method: "POST",
                data: data,
                success: function(result){
                    location.href = '/pelaksanaan/detail/{{ $pelaksanaan->id }}';
                },
                error: function(error){
                    console.log(error);
                }
                })
            } else {
              $("#rating-error").append('<div><p class="font-error-modal">Rating harus diisi.</p></div>');
              $("#komentar-error").append('<div><p class="font-error-modal">Komentar harus diisi.</p></div>');
              $("#enterenter").append('<div><br><br></div>');
              // kirimpesan error
            }
    
      
    });
    @else
    $("#simpan2").click(function(e){
      e.preventDefault();
            var data = {
                'rating_star': $('#rating-star').val(),
                'komentar': $('#komentar').val(),
                'idReview': parseInt('{{$review->id}}'),
                '_token': "{{ csrf_token() }}"
            }
      $.ajax({
                url:'/pelaksanaan/detail/{{ $pelaksanaan->id }}/review/edit',
                method: "POST",
                data: data,
                success: function(result){
                    location.href = '/pelaksanaan/detail/{{ $pelaksanaan->id }}';
                },
                error: function(error){
                    console.log(error);
                }
                })
      
    });
    $('#bintang').starrr({
      rating: parseInt('{{ $review->rating }}'), 
      readOnly: true 
    });
    @endif
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
