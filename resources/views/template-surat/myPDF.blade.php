<!DOCTYPE html>
<html>
<head>
	<title>Surat Penawaran Rekanan</title>
</head>
<body>


    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="row">
        <div class="col-sm-6">
            <table>
                <tr class="col-sm-3">
                    <td>Nomor</td>
                    <td>:</td>
                </tr>
                <tr class="col-sm-3">
                    <td>Perihal</td>
                    <td>:  Penawaran biaya {{ $projectName }}</td>
                </tr>
            </table>
        </div>

        <br><br>
        <div class="col-sm-6">
            <table>
                <tr class="col-sm-2">
                    <td>Kepada,</td>
                </tr>
                <tr class="col-sm-2">
                    <td>Yth.  {{ $comp }}</td>
                </tr>
                <tr class="col-sm-2">

                    <td>{{ $addr }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div>
        <p>
            Dengan hormat,
            <br><br>
            &nbsp;&nbsp;&nbsp; Sehubungan dengan Surat Pesanan Panitia Pelelangan tentang rencana {{ $projectName }}. Setelah mendapat penjelasan tentang {{ $projectName }}, bersama ini kami mengajukan penawaran biaya pekerjaan tersebut sebesar Rp{{ $val }}.
            <br><br>
            Demikian rincian biaya ini kami sampaikan, atas perhatian dan kerjasama yang baik kami ucapkan terima kasih.
        </p>
    </div>
    <div class="col-sm-7">

    </div>
    <div class="col-sm-5" style="text-align: right">
        Hormat Kami, <br>
        PT Nuansa Karisma Djaya <br><br><br><br><br>




        Surjanto Kuswandi<br>
        Senior Consultant
    </div>


</body>
</html>
