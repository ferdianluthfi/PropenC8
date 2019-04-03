<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <style>
    #myProgress {
    width: 100%;
    background-color: #ddd;
    }
    #myProgressDetail {
    width: 100%;
    background-color: #ddd;
    }
    #myBar {
    width: 10%;
    height: 30px;
    background-color: #4CAF50;
    text-align: center;
    line-height: 30px;
    color: white;
    }
    .messageType{
        cursor:pointer;
    }
    </style>

  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    
</head>
<body>
    <ul>
        @foreach ($proyekDetail as $proyek)
            <li>{{$proyek['projectName']}}
            </li>

            <div id="myProgressDetail" style="display:none;"> 
                <div id="myProgress">
                    <div id="myBar" style="width: <?php echo ($proyek['totalGaji']/ $proyek['maxValue'])*100 ?>%">
                        {{($proyek['totalGaji']/ $proyek['maxValue'])*100}}%
                    </div>
                </div>
                <div id="myProgress">
                    <div id="myBar" style="width: <?php echo ($proyek['totalBelanja']/ $proyek['maxValue'])*100 ?>%">
                        {{($proyek['totalBelanja']/ $proyek['maxValue'])*100}}%
                    </div>
                </div>
                <div id="myProgress">
                    <div id="myBar" style="width: <?php echo ($proyek['totalAdministrasi']/ $proyek['maxValue'])*100 ?>%">
                        {{($proyek['totalAdministrasi']/ $proyek['maxValue'])*100}}%
                    </div>
                </div>
            </div>
            
            <div id="myProgress">
                <div id="myBar" style="width: <?php echo ($proyek['totalKeseluruhan']/ $proyek['maxValue'])*100 ?>%">
                    {{($proyek['totalKeseluruhan']/ $proyek['maxValue'])*100}}%
                </div>
            </div>
            <button id="messageType" onclick="showAll($proyek['projectName'])" >Tampilkan Lebih Banyak</button>
            
        @endforeach
    </ul>

    <script>
        function showAll(data) {
            
            if(document.getElementById("myProgressDetail").style.display == 'none'){
                $('#myProgressDetail').show();
                document.getElementById("myProgress").style.display = "none";
                document.getElementById("messageType").innerHTML = "Tampilkan Lebih Sedikit";
            }
            else{
                $('#myProgressDetail').hide()
                $("#messageType").prop('value', 'Tampilkan Lebih Banyak');
                document.getElementById("myProgress").style.display = "show";
                document.getElementById("messageType").innerHTML = "Tampilkan Lebih Banyak";
            }
        }
    </script>
</body>
</html>