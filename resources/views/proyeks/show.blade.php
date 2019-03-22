<!DOCTYthE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading"> Detail {{ $proyek->name}}</div>
                <div class="panel-body">
                    <div class="row">
                            <div class="col-sm-4">
                            <table class="table table-striped">
                            <thead>
                            <tr>
                            <th>{{ $proyek->name}}</th>
                            <th>{{ $proyek->startDate}}</th>
                            <th>{{ $proyek->endDate}}</th>
                            <th>{{ $proyek->description}}</th> 
                            <th>{{ $proyek->projectValue}}</th>
                            <th>{{ $proyek->estimatedTime}}</th>
                            <th>{{ $proyek->approvalStatus}}</th>
                            <th>{{ $proyek->projectAddress}}</th>
                            <th>{{ $proyek->isLPJExist}}</th>
                            </tr>
                            </thead>
                            </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>