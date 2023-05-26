<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light" style="background-color:{{ $color_barra_horizontal }}">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>


        <li class="nav-item d-none d-sm-inline-block">
            <a style="background-color:{{ Request::is('dashboard') }}" href="{{ url('/dashboard') }}"
                class="nav-link d-flex align-items-center mb-0">
                <i class="fa-solid fa-house mr-2"></i>
                <p style="margin-bottom:0">Inicio</p>
            </a>
            {{-- <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                onmouseout="this.style.backgroundColor='transparent'"
                style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('dashboard') ? $color_a_tag_hover : '' }}"
                href="{{ url('/dashboard') }}" class="nav-link">
                <i class="fa-solid fa-house"></i>
                <p>
                    Inicio
                </p>
            </a> --}}
        </li>
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
          <a class="btn btn-outline-primary" href="{{ url('/venta-presencial') }}">Venta Presencial</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link qty-button" style="font-size: 1.3rem;" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-danger navbar-badge qty-count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right qty-item" style="max-width: fit-content">
            </div>

            {{-- <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
      </div> --}}
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                {{ __('Salir') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        <!-- Notifications Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> 4 new messages
          <span class="float-right text-muted text-sm">3 mins</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> 8 friend requests
          <span class="float-right text-muted text-sm">12 hours</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> 3 new reports
          <span class="float-right text-muted text-sm">2 days</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li> --}}
        {{-- <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fas fa-th-large"></i>
      </a>
    </li> --}}
        {{-- <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}"
      onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
          {{ __('Salir') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </li> --}}
    </ul>
</nav>
<!-- /.navbar -->
