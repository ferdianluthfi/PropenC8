<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" >
</head>
<body>
    <ul>
        @foreach ($kemajuans as $kemajuan)
        <li>
            {{ $kemajuan->description }}
        </li>
        @endforeach
        
    </ul>
</body>
</html>