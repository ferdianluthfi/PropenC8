<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAYEK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
.wrapper {
    display: flex;
    align-items: stretch;
}
nav {
    border-top: 1px solid white;
    border-bottom: 1px solid black;
} 
nav:after {
    content: "";
    display: block;
    clear: both;
}
#contentBody {
    
    background-color: #F5F8F9;
    height: 100vh;
}
#content {
    width: 100vw;
    background: #F5F8F9;
}

#sidebar {
    min-width: 250px;
    max-width: 250px;
}

#sidebar.active {
    margin-left: -250px;
}
#sidebar {
    min-width: 250px;
    max-width: 250px;
    min-height: 100vh;
}
a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}
@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
}
/*
    ADDITIONAL DEMO STYLE, NOT IMPORTANT TO MAKE THINGS WORK BUT TO MAKE IT A BIT NICER :)
*/
@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";



body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}

a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

#sidebar {
    /* don't forget to add all the previously mentioned styles here too */
    background: #e4e5e6;
    color: #000;
    transition: all 0.3s;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #0000;
}

#sidebar ul.components {
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: rgb(0, 0, 0);
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}
#sidebar ul li a:hover {
    color: #7386D5;
    background: #fff;
}

#sidebar ul li.active > a, a[aria-expanded="true"] {
    color: rgb(0, 0, 0);
    background: #e4e5e6;
}
ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #e4e5e6;
}

    </style>
    

    
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <center><h3>Luthfi Ferdian</h3></center>
        </div>
        <ul class="list-unstyled components">
            <center>
            <img src="https://i.stack.imgur.com/12F8N.png" style="width:100px;height:100px;"/>
            <h6> atta.harlilintar </h6>
            <h6> >>>ASHIAP<<< </h6>
            </center>
            <li class="active">
                <a href="/">Beranda</a>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Proyek</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Lihat Proyek</a>
                    </li>
                    <li>
                        <a href="#">Tambah Proyek</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="list-unstyled CTAs">
                <li>
                    <h6>Tentang Kami</h6>
                    <h6>Hubungi Kami</h6>
                    <h6>Kritik dan saran</h6>
                    <h6>Tentang Kami</h6>
                </li>
            </ul>
    </nav>

    <!-- Kontennyaaa -->
    <div id="content">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark navbar-fixed-top">
        <a class="navbar-brand" href="/luthfi">CLICK ME</a>
        <ul class="navbar-nav">
            <button type="button" id="sidebarCollapse" >
                <a> toogle collapse </a>
            </button>
            
            
        </ul>

        </nav>
        <div id="contentBody">
        <center>
        <img src="https://i.stack.imgur.com/12F8N.png" style="width:250px;height:250px;"/>
        <h2> Selamat Datang di Trayek, Toeloes!</h2>
        </center>
        </div>
        </nav>
        
        
    </div> <!--Konten berakhir-->
    
</div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    <script>
    function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}
    </script>

</body>
</html>