<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('/') }}" class="brand-link">
    <img src="{{ asset('images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Tienda ONline</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('images/default.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        
        <li class="nav-item">
          <a href="{{ url('/dashboard') }}" class="nav-link  {{ Request::is('dashboard') ? 'active': ''}}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Inicio
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('/categorias') }}" class="nav-link {{ (Request::is('categorias') || Request::is('crear-categoria') || Request::is('edit-cat/*') ) ? 'active': '' }}">
            <i class="fa fa-circle" aria-hidden="true"></i>
            <p>
              Categorías
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('/productos') }}" class="nav-link {{ (Request::is('productos') ||Request::is('crear-producto') || Request::is('edit-prod/*')  ) ? 'active': '' }}">
            <i class="fas fa-star    "></i>
            <p>
              Productos
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('ordenes') }}" class="nav-link {{ Request::is('ordenes') ? 'active': '' }}">
            <i class="fas fa-star"></i>
            <p>
              Ordenes
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ url('usuarios') }}" class="nav-link {{ Request::is('usuarios') ? 'active': '' }}">
            <i class="fas fa-star"></i>
            <p>
              Usuarios
            </p>
          </a>
        </li>
       
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>