<!DOCTYPE html>
<html>
<head>
    <title>Kemajuan seluruh proyek</title>
    <style>
    #myProgress {
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
</head>
<body>
    
    <div id="myProgress">           
        <div id="myBar"></div>
    </div>

    <script>
        function(){
            $.ajax({
                url: "http://localhost:8000/kemajuanProyek",
                method: "GET",
                success: function(data){
                    console.log(data);
                },
                error: function(data){
                    console.log(data);
                }               
            });
        });
    </script>
</body>
</html>