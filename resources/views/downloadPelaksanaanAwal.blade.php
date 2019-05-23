<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

.page-break {
    page-break-after: always;
}

td, th {
  border: 1px solid black;
  text-align: center;
  padding: 10px;
}

.tab{
    margin-left: 50px;
}

.page-break {
    page-break-after: always;
}
</style>
</head>
<body>

<center><h2>LAPORAN KEMAJUAN FISIK</h2></center>

<pre>Pekerjaan : Pembuatan {{$proyek-> projectName}}</pre>
<pre>Lokasi    : {{$proyek-> projectAddress}}</pre>
<pre>Periode   : {{$periodeMulai}} - {{$periodeSelesai}}</pre>
<pre>Bulan Ke  : {{$pelaksanaan-> bulan}}</pre>
<pre>Tahun     : {{$tahunPeriode}}</pre>

<table>
    <tr>
        <td rowspan="2" style="font-weight:bold">NO.</td>
        <td rowspan="2" style="font-weight:bold">URAIAN PEKERJAAN</td>
        <td style="font-weight:bold">ALOKASI BIAYA</td>
        <td style="font-weight:bold">BOBOT</td>
        <td style="font-weight:bold">BIAYA DIKELUARKAN</td>
        <td style="font-weight:bold">REALISASI BULAN LALU</td>
        <td style="font-weight:bold">REALISASI BULAN INI</td>
        <td style="font-weight:bold">REALISASI SAMPAI BULAN INI</td>
    </tr>
    <tr>
        <td style="font-weight:bold">Rp</td>
        <td style="font-weight:bold">(%)</td>
        <td style="font-weight:bold">Rp</td>
        <td style="font-weight:bold">(%)</td>
        <td style="font-weight:bold">(%)</td>
        <td style="font-weight:bold">(%)</td>
    </tr>
   
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <?php $count = 1 ?>
    @foreach($listPekerjaan as $pekerjaan)
        
        <tr>
            <td> {{$count}} </td>
            <td> {{ $pekerjaan->name }} </td> 
            <td> {{ number_format($pekerjaan->workTotalValue, 2) }} </td>
            <td> {{$pekerjaan->weightPercentage }} % </td>
            @foreach($biayaKeluar as $biaya)
                @if($pekerjaan->id == $biaya->pekerjaan_id)
                    @if($biaya->sum == 0)
                    @else
                        @if($realisasiLalu == 0)
                            <td> {{number_format($biaya->sum, 2)}} </td>
                            <td> 0 % </td>
                            <td> {{(($biaya->sum) / ($pekerjaan->workTotalValue)*100)}} % </td>
                            <td> {{(($biaya->sum) / ($pekerjaan->workTotalValue)*100)}} % </td>
                        @endif
                    @endif
                @endif
            @endforeach

        </tr>
        <?php $count++ ?>
    @endforeach
    <tr>
        <td colspan=2 style="font-weight:bold"> TOTAL KESELURUHAN</td>
        <td style="font-weight:bold">{{ number_format($totalAnggaranPekerjaan, 2) }}</td>
        <td></td>
        <td style="font-weight:bold">{{ number_format($totalBiaya, 2) }}</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
<br>
<div class="page-break"></div>
<p style="font-weight:bold;text-align:right">Jakarta, {{$tanggalPelaksanaan}}</p> <br>
<p class="tab" style="font-weight:bold;text-align:center">Disetujui, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dibuat,</p>

<br><br><br>

<p class="tab" style="text-align:center">{{$namaKlien}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$manajerPelaksana}}</p>

</body>
</html>
