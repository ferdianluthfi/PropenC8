<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 10px;
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
        <td rowspan="2">NO.</td>
        <td rowspan="2">URAIAN PEKERJAAN</td>
        <td>ALOKASI BIAYA</td>
        <td>BOBOT</td>
        <td>BIAYA DIKELUARKAN</td>
        <td>REALISASI BULAN LALU</td>
        <td>REALISASI BULAN INI</td>
        <td>REALISASI SAMPAI BULAN INI</td>
    </tr>
    <tr>
        <td>Rp</td>
        <td>(%)</td>
        <td>Rp</td>
        <td>(%)</td>
        <td>(%)</td>
        <td>(%)</td>
    </tr>
    <tr>
        <td style="padding: 5px;">1</td>
        <td style="padding: 5px;">2</td>
        <td style="padding: 5px;">3</td>
        <td style="padding: 5px;">4</td>
        <td style="padding: 5px;">5</td>
        <td style="padding: 5px;">6</td>
        <td style="padding: 5px;">7</td>
        <td style="padding: 5px;">8</td>
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

    @foreach($listPekerjaan as $pekerjaan)
        <tr>
            <td> 1 </td>
            <td> {{ $pekerjaan->name }} </td>
            <td> {{ number_format($pekerjaan->workTotalValue, 2) }} </td>
            <td> {{$pekerjaan->weightPercentage}} % </td>
            @foreach($biayaKeluar as $biaya)
                @if($pekerjaan->id == $biaya->pekerjaan_id)
                    @if($biaya->sum == 0)
                    @else
                        @if($realisasiLebih == null)
                            <td> {{number_format($biaya->sum, 2)}} </td>
                            <td> 0 % </td>
                            <td> {{(($biaya->sum) / ($pekerjaan->workTotalValue)*100)}} % </td>
                            <td> {{(($biaya->sum) / ($pekerjaan->workTotalValue)*100)}} % </td>
                        @else
                            @foreach($realisasiLebih as $realisasi)
                                @if($realisasi->pekerjaan_id == $pekerjaan->id)
                                    <td> {{number_format($biaya->sum, 2)}} </td>
                                    <td> {{(($realisasi->sum) / ($pekerjaan->workTotalValue)*100)}} % </td>
                                    <td> {{(($biaya->sum) / ($pekerjaan->workTotalValue)*100)}} % </td>
                                    <td> {{(($realisasi->sum) / ($pekerjaan->workTotalValue)*100) + (($biaya->sum) / ($pekerjaan->workTotalValue)*100)}} % </td>
                                @endif
                            @endforeach
                        @endif
                    @endif
                @else
                    @if($realisasiLebih == null)
                    @else
                        @foreach($realisasiLebih as $realisasi)
                            @if($realisasi->pekerjaan_id == $pekerjaan->id)
                                <td> {{number_format(0, 2)}} </td>
                                <td> {{(($realisasi->sum) / ($pekerjaan->workTotalValue)*100)}} % </td>
                                <td> 0 % </td>
                                <td> {{(($realisasi->sum) / ($pekerjaan->workTotalValue)*100) + 0 }} % </td>
                            @endif
                        @endforeach
                    @endif
                @endif
            @endforeach
        </tr>
    @endforeach
</table>

</body>
</html>