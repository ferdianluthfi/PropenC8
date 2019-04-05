@extends('layouts.layout')

@section ('content')
@include('layouts.nav')
<html>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Upload New File for Proyek {{ $proyek->projectName }}</div>
                        <div class="panel-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('file.upload') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('post') }}
                                <input type="hidden" name="proyekId" value="{{ $proyek->id }}">
                                <div class="form-group {{ !$errors->has('title') ?: 'has-error' }}">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control">
                                    <span class="help-block text-danger">{{ $errors->first('title') }}</span>
                                </div>
                                <div class="form-group {{ !$errors->has('file') ?: 'has-error' }}">
                                    <label>File</label>
                                    <input type="file" name="file">
                                    <span class="help-block text-danger">{{ $errors->first('file') }}</span>
                                </div>

                                <div class="container-btn">
                                    <button class="container-form-btn">
                                        <span>Upload</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=""container">
        <div id="myMod" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>
                        <h4 class="modal-title">Awesome!</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Your booking has been confirmed. Check your email for detials.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </body>
</html>
