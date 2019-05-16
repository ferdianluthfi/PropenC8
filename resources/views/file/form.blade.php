@extends('layouts.layout')

@section ('content')
@include('layouts.nav')
<html>
    <body>
        <div class="container">
            <div class="row">
                <div class="card card-detail-proyek" style="min-height: 200px; width: 500px">
                    <br>
                    <div class="font-title" style="text-align: center">Upload New File for Proyek {{ $proyek->projectName }}</div>
                    <hr>
                    <div class="panel-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('file.upload') }}" method="post" id="uploadBerkas" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            <input type="hidden" name="proyekId" value="{{ $proyek->id }}">
                            <div class="row">
                                <div class="col-sm-6 form-group {{ !$errors->has('title') ?: 'has-error' }}">
                                    <label>Title</label><br><br>
                                    <!--                                    <input type="text" name="title" class="form-control">-->
                                    <select name="title">
                                        <option disabled selected value> -- select an option -- </option>
                                        <option value="Surat Undangan">Surat Undangan</option>
                                        <option value="RAB">RAB</option>
                                        <option value="Data Perusahaan Pemenang">Data Perusahaan Pemenang</option>
                                        <option value="Berita Acara Penjelasan Pekerjaan">Berita Acara Penjelasan Pekerjaan</option>
                                    </select>
                                    <span class="help-block text-danger">{{ $errors->first('title') }}</span>
                                </div>
                                <div class="col-sm-6 form-group {{ !$errors->has('file') ?: 'has-error' }}">
                                    <label style="margin-left: 20px">File</label>
                                    <input type="file" name="file" class="turncate">
                                    <span class="help-block text-danger">{{ $errors->first('file') }}</span>
                                </div>
                            </div>

<!--                                <div class="container-btn">-->
<!--                                    <button class="container-form-btn">-->
<!--                                        <span>Upload</span>-->
<!--                                    </button>-->
<!--                                </div>-->
                            <br>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-8" style="margin-left: 10px">
                                    <button id="tolak" class="button-disapprove" data-toggle="modal" data-target="#myModd" style="width: 100px; height: 30px; border-radius: 5px">BATAL</button>
                                    <button class="button-approve" id="simpan" aria-hidden="true" style="width: 100px; height: 30px; border-radius: 5px; margin-left: 10px">SIMPAN</button>
                                </div>
                                <div class="col"></div>
                            </div>
                        </form>
<!--                            <div  class="container-btn">-->
<!--                                <button class="container-form-btn" onclick="window.location.href='/kelolaLelang/{{ $proyek->id }}'">-->
<!--                                    <span>Kembali</span>-->
<!--                                </button>-->
<!--                            </div>-->
                    </div>
                    <div class="modal fade" id="myModd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" style="text-align:center;">Batalkan Proses?</h4>
                                </div>
                                <div class="modal-body" style="text-align:center;">
                                    <p>Jika proses dibatalkan, perubahan tidak akan disimpan.</p>
                                </div>
                                <div class="modal-footer">
                                    <!--                GANTI JADI BALIK KE DETAIL PROYEK-->
                                    <a href="/kelolaLelang/{{ $proyek->id }}" class="btn btn-default" style="color:red;">Iya</a>
                                    <a href="/file/upload/{{ $proyek->id }}" class="btn btn-primary">Tidak</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" style="text-align:center;">Sukses!</h4>
                                </div>
                                <div class="modal-body text-center">
                                    <p class="text-center">Berkas berhasil diunggah</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="/kelolaLelang/{{ $proyek->id }}" class="btn btn-success">OK</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js" integrity="sha256-+h0g0j7qusP72OZaLPCSZ5wjZLnoUUicoxbvrl14WxM=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/umd/util.js"></script>

    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
            $("#simpan").click(function(e){
                //checks if it's valid
                //horray it's valid
                $("#myMod").modal("show");
            });
            $("#OK").click(function(e){
                $('#uploadBerkas').submit();
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
</html>
