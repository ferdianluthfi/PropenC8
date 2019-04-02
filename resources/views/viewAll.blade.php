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
    </style>

  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    
</head>
<body>
    <ul>
        @foreach ($proyekDetail as $proyek)
            <li>{{$proyek['projectName']}}
            </li>
            <div id="myProgressDetail" stye="display:none;"> 
                <div id="myProgress">
                    <div id="myBar" style="width: <?php echo ($proyek['totalGaji']/ $proyek['maxValue'])*100 ?>%">
                        {{($proyek['totalGaji']/ $proyek['maxValue'])*100}}%
                    </div>
                <div id="myProgress">
                    <div id="myBar" style="width: <?php echo ($proyek['totalBelanja']/ $proyek['maxValue'])*100 ?>%">
                        {{($proyek['totalBelanja']/ $proyek['maxValue'])*100}}%
                </div>
                <div id="myProgress">
                    <div id="myBar" style="width: <?php echo ($proyek['totalAdministrasi']/ $proyek['maxValue'])*100 ?>%">
                        {{($proyek['totalAdministrasi']/ $proyek['maxValue'])*100}}%
                    </div>
            </div>
            <div id="myProgress">
                <div id="myBar" style="width: <?php echo ($proyek['totalKeseluruhan']/ $proyek['maxValue'])*100 ?>%">
                {{($proyek['totalKeseluruhan']/ $proyek['maxValue'])*100}}%
            </div>
            </div>
        @endforeach
    </ul>
</body>
</html>