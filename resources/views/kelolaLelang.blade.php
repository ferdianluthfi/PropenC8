@extends('layouts.layout')

@section ('content')
@include('layouts.nav')
<html>
<body>
<!-- isinya -->
<div class="container-fluid card card-detail-proyek">
    <br>
    <p class="font-subtitle-1">Rincian Berkas Lelang</p>
    <hr>
    <div>
        <p class="font-subtitle-2">Detail Proyek {{ $proyek->projectName }}</p>
        <br>
    </div>
    <div class="row ketengahin">
        <div class="col-sm-7">
            <div class="card card-info">
                <div class="row judul">
                    <div class="col-sm-9 font-subtitle-4">Informasi Umum</div>
                    <div class="col-sm-1 font-status-approval">DISETUJUI</div>
                </div>
                <div class="row">
                    <div class="col-sm-5 font-desc-bold">
                        <ul>
                            <li><p>Nama Staf Marketing</p></li>
                            <li><p>Nama Proyek</p></li>
                            <li><p>Nama Perusahaan</p></li>
                            <li><p>Estimasi Waktu Pengerjaan</p></li>
                            <li><p>Alamat Proyek</p></li>
                            <li><p>Deskripsi Proyek</p></li>
                            <li><p>Nilai Proyek</p></li>
                        </ul>
                    </div>
                    <div class="col-sm-7 font-desc">
                        <ul>
                            <li><p>:   {{ $proyek->name}}<p></li>
                            <li><p>:   {{ $proyek->projectName}}<p></li>
                            <li><p>:   {{ $proyek->companyName}}<p></li>
                            <li><p>:   {{ $proyek->estimatedTime}}<p></li>
                            <li><p>:   {{ $proyek->projectAddress}}<p></li>
                            <li><p>:   {{ $proyek->description}}<p></li>
                            <li><p>:   {{ $proyek->projectValue}}<p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="card card-pm">
                <br>
                <p class="font-subtitle-5">Project Manager</p>
            </div>
        </div>
    </div>
<!--    <div class="container" style="padding:5%;">-->
<!--        <div class="row bigCard">-->
<!--            <h3 class="col-md-12" style="text-align:center;">Kelola Berkas Lelang</h3>-->
<!--        </div>-->
<!--        <table>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    Nama Proyek-->
<!--                </td>-->
<!--                <td>-->
<!--                    :   {{ $proyek->projectName }}-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    Alamat Proyek-->
<!--                </td>-->
<!--                <td>-->
<!--                    :   {{ $proyek->projectAddress }}-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    Nama User apa ini-->
<!--                </td>-->
<!--                <td>-->
<!--                    :   {{ $proyek->name }}-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    Nama Perusahaan-->
<!--                </td>-->
<!--                <td>-->
<!--                    :   {{ $proyek->companyName }}-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    Alamat Proyek-->
<!--                </td>-->
<!--                <td>-->
<!--                    :   {{ $proyek->projectAddress }}-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    Deskripsi-->
<!--                </td>-->
<!--                <td>-->
<!--                    :   {{ $proyek->description }}-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    Nilai Proyek-->
<!--                </td>-->
<!--                <td>-->
<!--                    :   {{ $proyek->projectValue }}-->
<!--                </td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    Perkiraan waktu pengerjaan proyek-->
<!--                </td>-->
<!--                <td>-->
<!--                    :   {{ $proyek->estimatedTime }}-->
<!--                </td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--        </table>-->
<!--    </div>-->

    <div class="col-sm-9 ketengahin">
        <table class="table table-bordered table-hover">
            <caption>Kelola Berkas Lelang</caption>
            <thead>
            <tr style="text-align: center">
                <th>Id</th>
                <th>Title</th>
                <th>File Name</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($berkass as $object)
            <tr>
                <td>
                    {{ $object->id }}
                </td>
                <td>
                    {{ $object->title }}
                </td>
                <td>
                    {{ $object->filename }}
                </td>
                <td>
                    {{ $object->created_at->diffForHumans()}}
                </td>
                <td style="text-align: center">
                    <a href="{{ Storage::url($object->path) }}" title="View file {{ $object->title }}">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <a href="{{ route('file.response', $object->id) }}" title="Show or download file {{ $object->title }}">
                        <span class="glyphicon glyphicon-save"></span>
                    </a>
<!--                    <a href="{{ route('file.download', $object->id) }}" title="Download file {{ $object->title }}">-->
<!--                        <i class="fa fa-download fa-fw"></i>-->
<!--                    </a>-->
                    <a href="/file/{{ $object->id }}/delete" title="Delete file {{ $object->title }}">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-sm-2 ketengahin">
        <br>
        <br>
        <div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
<!--        </div>-->
<!--        <p>Tambah Berkas</p>-->
        <p>Surat Penawaran Rekanan
            <a href="/generate-pdf/{{ $proyek->id }}" class="btn btn-primary">Buat Surat</a>
        </p>
        <p>Surat Permohonan Jaminan Bank
            <a href="/generate-pdf2/{{ $proyek->id }}" class="btn btn-primary">Buat Surat</a>
        </p>
        <p>Upload Surat ke Sistem
            <a href="/file/upload/{{ $proyek->id }}" class="btn btn-primary">Upload File</a>
        </p>
    </div>
</div>


            <!-- <tr>
                <th>
                    <input type="hidden" value="{{ $proyek->id }}">
                    <select>
                        <option disabled selected value> -- Pilih Berkas Lelang -- </option>
                        @foreach ($templates as $template)
                        <option name ="template_id" value="{{ $template->id }}">{{ $template->nama_surat }}</option>
                        @endforeach
                    </select>
                    <input type="file" name="fileBerkas">
                </th>
                <th>

                </th>
            </tr>
            <tr>
                <th>
                    <button>Tambah Berkas</button>
                </th>
            </tr> -->

</body>
</html>
