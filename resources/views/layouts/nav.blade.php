<nav class="navbar navbar-light navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <img class="navbar-brand"src="{{ asset('img/logoTrayek.svg')}}"><a class="navbar-brand font-nav-logo" href="{{ url('home') }}">TRAYEK</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="{{ url('home') }}" class="font-nav">Beranda</a></li>
      <li><a href="{{ url('proyek') }}" class="font-nav">Proyek</a></li>
      <li><a href="#" class="font-nav">Kemajuan Proyek</a></li>
      <li class="dropdown font-nav"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">username as Direksi</a></li>
          <li><a href="#">Keluar</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>