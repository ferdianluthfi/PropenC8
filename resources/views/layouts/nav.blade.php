
<nav class="navbar navbar-light navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <img class="navbar-brand"src="{{ asset('img/logoTrayek.svg')}}"><a class="navbar-brand font-nav-logo" href="{{ url('home') }}">TRAYEK</a>
    </div>
    @if(Auth::check()) <!-- nanti kalo misalkan ada perubahan role diganti lagi -->
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::user()->role == 7)
        <li><a href="/assignedproyek" class="font-nav">Daftar Proyek</a></li>
        @elseif(Auth::user()->role != 1)
        <li><a href="{{ url('proyek') }}" class="font-nav">Daftar Proyek</a></li>
        @elseif(Auth::user()->role == 1)
        <li><a href="/register" class="font-nav">Tambah Akun</a></li>
        @endif

        @if(Auth::user()->role == 2)
        <li><a href="/kemajuanProyek" class="font-nav">Kemajuan Proyek</a></li>
        @endif

        <li class="dropdown font-nav"><a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
            
            @switch(Auth::user()->role)
              @case(1)
                  <a href="#">{{Auth::user()->name}} as Manajer Akun</a>
                  @break
              @case(2)
                  <a href="#">{{Auth::user()->name}} as Direksi</a>
                  @break
              @case(3)
                  <a href="#">{{Auth::user()->name}} as Staf Marketing</a>
                  @break
              @case(4)
                  <a href="#">{{Auth::user()->name}} as Manajer Marketing</a>
                  @break
              @case(5)
                  <a href="#">{{Auth::user()->name}} as Program Manajer</a>
                  @break
              @case(6)
                  <a href="#">{{Auth::user()->name}} as Manajer Pelaksana</a>
                  @break
              @case(7)
                  <a href="#">{{Auth::user()->name}} as PM</a>
                  @break
              @case(8)
                  <a href="#">{{Auth::user()->name}} as Klien</a>
                  @break
            @endswitch
          </li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>
          </ul>
        </li>
        @endif
    </ul>
  </div>
</nav>