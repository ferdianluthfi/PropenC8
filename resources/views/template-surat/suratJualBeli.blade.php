<!DOCTYPE html>
<html>
<head>
	<title>Surat Kontrak Jual Beli</title>
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
                    <td style="text-align:center;">KONTRAK JUAL BELI</td>
                </tr>
                <tr class="col-sm-3">
                    <td>Nomor</td>
                    <td>:</td>
                </tr>
                <tr class="col-sm-3">
                    <td>Tentang</td>
                    <td>: {{ $projectName }}</td>
                </tr>
            </table>
        </div>

    </div>

    <div>
        <p>
            <b>Dasar :</b>
            <br><br>
            1.  &nbsp;&nbsp;&nbsp;&nbsp; Surat Perintah Pelaksanaan Program Nomor 
            <br><br>
            &nbsp;&nbsp;&nbsp;&nbsp; Pada tanggal {{ $tanggal }}, telah terjadi suatu Kontrak Jual Beli
        </p>
    </div>
    <div class="col-sm-7">

    <div class="row">
        <div class="col-sm-6">
        <center>ANTARA <center><br>
        PT Nuansa Karisma Djaya <br>
        <p> &nbsp;&nbsp;&nbsp;&nbsp; Dalam hal ini diwakili oleh : </p>

            <table>
                <tr class="col-sm-3">
                    <td>Nama</td>
                    <td>: Surjanto Kuswandi</td>
                </tr>
                <tr class="col-sm-3">
                    <td>Alamat</td>
                    <td>: Jakarta</td>
                </tr>
            </table>

            <p> &nbsp;&nbsp;&nbsp;&nbsp; Selanjutnya disebut sebagai Pihak Pembeli atau <b>PIHAK KESATU</b>. </p>
            <center>DENGAN <center><br>

            <table>
                <tr class="col-sm-3">
                    <td>Nama</td>
                    <td>:  {{ $contactPerson }} </td>
                </tr>
                <tr class="col-sm-3">
                    <td>Perusahaan</td>
                    <td>:  {{ $namaPerusahaan }}</td>
                </tr>
                <tr class="col-sm-3">
                    <td>Alamat</td>
                    <td>:  Jkt</td>
                </tr>
            </table>

            <br>
            <p> &nbsp;&nbsp;&nbsp;&nbsp; Yang dalam hal ini bertindak untuk dan atas nama <b>{{$namaPerusahaan}}</b>, Selanjutnya disebut Pihak Penjual atau <b>PIHAK KEDUA</b>.
    </div>

    <div class="row">
        <div class="col-sm-6">
            <table>
                <tr class="col-sm-3">
                    <td>Paraf Pihak I</td>
                    <td> :</td>
                </tr>
                <tr class="col-sm-3">
                    <td>Paraf Pihak II</td>
                    <td> :</td>
                </tr>
            </table>
        </div>
    </div>

    

</body>
</html>
