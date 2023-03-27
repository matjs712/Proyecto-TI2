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

        <li class="nav-header">PRODUCTOS</li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Productos
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/productos') }}" class="nav-link {{ (Request::is('productos')  ) ? 'active': '' }}">
                <i class="far fa-circle nav-icon"></i><p>Ver todos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/crear-producto') }}" class="nav-link {{ (Request::is('crear-producto')|| Request::is('edit-prod/*') ) ? 'active': ''}} ">
                <i class="far fa-circle nav-icon"></i><p>Ingresar</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">CATEGORÍAS</li>

        <li class="nav-item">
          <a href="{{ url('/categorias') }}" class="nav-link {{ (Request::is('categorias') || Request::is('crear-categoria') || Request::is('edit-cat/*') ) ? 'active': '' }}">
            <i class="fa fa-circle" aria-hidden="true"></i>
            <p>
              Categorías
            </p>
          </a>
        </li>

        <li class="nav-header">INGREDIENTES</li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Ingredientes
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/ingredientes') }}" class="nav-link {{ (Request::is('ingredientes') ) ? 'active': '' }}">
                <i class="far fa-circle nav-icon"></i><p>Ver todos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/crear-ingrediente') }}" class="nav-link {{ (Request::is('crear-ingrediente') || Request::is('edit-ing/*') ) ? 'active': ''}} ">
                <i class="far fa-circle nav-icon"></i><p>Ingresar</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">PROOVEDORES</li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Proveedores
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/proveedores') }}" class="nav-link {{ (Request::is('proveedores')  ) ? 'active': '' }}">
                <i class="far fa-circle nav-icon"></i><p>Ver todos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/crear-proveedor') }}" class="nav-link {{ (Request::is('crear-proveedor')|| Request::is('edit-prov/*') ) ? 'active': ''}} ">
                <i class="far fa-circle nav-icon"></i><p>Ingresar</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Registro
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/registro') }}" class="nav-link {{ (Request::is('registro')  ) ? 'active': '' }}">
                <i class="far fa-circle nav-icon"></i><p>Ver todos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/crear-registro') }}" class="nav-link {{ (Request::is('crear-registro')|| Request::is('edit-reg/*') ) ? 'active': ''}} ">
                <i class="far fa-circle nav-icon"></i><p>Ingresar</p>
              </a>
            </li>
          </ul>
        </li>

        
        <li class="nav-header">ORDENES</li>
        
        <li class="nav-item">
          <a href="{{ url('ordenes') }}" class="nav-link {{ Request::is('ordenes') ? 'active': '' }}">
            <i class="fas fa-star"></i>
            <p>
              Ordenes
            </p>
          </a>
        </li>

        <li class="nav-header">USUARIOS & CONFIGURACIÓN</li>

        <li class="nav-item">
          <a href="{{ url('usuarios') }}" class="nav-link {{ Request::is('usuarios') ? 'active': '' }}">
            <i class="fas fa-star"></i>
            <p>
              Usuarios
            </p>
          </a>
        </li>
        <li class="nav-item mt-3">
          <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
              {{ __('Salir') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>