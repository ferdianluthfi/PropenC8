<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<<<<<<< HEAD
    <title>TRAYEK - COBA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <ul>
        @foreach ($tasks as $task)
            <li>{{$task -> body}}</li>
        @endforeach
    </ul>
=======
    <title>TRAYEJ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>

    <!--belom bisa ngestyle dari beda file:( -->
    <style src="/public/css"></style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item active">
               <a class="nav-link" href="/">TRAYEK/a>
            </li>
        </ul>
    </nav>
>>>>>>> master
</body>
</html>