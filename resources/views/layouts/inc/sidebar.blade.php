<aside class="main-sidebar  elevation-4" style="background-color: {{ $color_barra_lateral }}">
    <!-- Brand Logo -->
    <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
        onmouseout="this.style.backgroundColor='transparent'" style="color: {{ $color_a_tag_sidebar }}"
        href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset($logo) }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $sitio }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Storage::url('users/' . Auth::user()->imagen) }}" class="img-circle elevation-2"
                    alt="User">
            </div>
            <div class="info">
                <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                    onmouseout="this.style.backgroundColor='transparent'" style="color: {{ $color_a_tag_sidebar }}"
                    href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

                @can('ver dashboard')
                    <li class="nav-item">
                        <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                            onmouseout="this.style.backgroundColor='transparent'"
                            style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('dashboard') ? $color_a_tag_hover : '' }}"
                            href="{{ url('/dashboard') }}" class="nav-link">
                            <i class="fa-solid fa-house"></i>
                            <p>
                                Inicio
                            </p>
                        </a>
                    </li>
                @endcan

                @can(['ver productos', 'ver categorias', 'ver ingredientes'])
                    <li class="nav-header" style="color: {{ $color_a_tag_sidebar }}">PRODUCTOS & INGREDIENTES</li>
                    @can('ver productos')

                        @if ($productos)
                            <li class="nav-item has-treeview">
                                <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                    onmouseout="this.style.backgroundColor='transparent'"
                                    style="color: {{ $color_a_tag_sidebar }}" href="{{ url('/productos') }}" class="nav-link">
                                    <i class="fa-solid fa-cart-flatbed"></i>
                                    <p> &nbsp;Productos</p>
                                </a>
                                {{-- <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                        onmouseout="this.style.backgroundColor='transparent'"
                                        style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('productos') ? $color_a_tag_hover : '' }}"
                                        href="{{ url('/productos') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ver todos</p>
                                    </a>
                                </li>
                                @can('add productos')
                                    <li class="nav-item">
                                        <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                            onmouseout="this.style.backgroundColor='transparent'"
                                            style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('crear-producto') || Request::is('edit-prod/*') ? $color_a_tag_hover : '' }}"
                                            href="{{ url('/crear-producto') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ingresar</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul> --}}
                            </li>
                        @endif
                    @endcan
                    @can('ver categorias')
                        @if ($categorias)
                            <li class="nav-item">
                                <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                    onmouseout="this.style.backgroundColor='transparent'"
                                    style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('categorias') || Request::is('crear-categoria') || Request::is('edit-cat/*') ? $color_a_tag_hover : '' }}"
                                    href="{{ url('/categorias') }}" class="nav-link">
                                    <i class="fa-solid fa-cubes-stacked"></i>
                                    <p>
                                        &nbsp; Categorías
                                    </p>
                                </a>
                            </li>
                        @endif
                    @endcan

                    @can('ver ingredientes')
                        @if ($ingredientes)
                            <li class="nav-item has-treeview">
                                <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                    onmouseout="this.style.backgroundColor='transparent'"
                                    style="color: {{ $color_a_tag_sidebar }}" href="{{ url('/ingredientes') }}"
                                    class="nav-link">
                                    <i class="fa-solid fa-jar"></i>
                                    <p>
                                        &nbsp;Ingredientes
                                    </p>
                                </a>
                                {{-- <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                        onmouseout="this.style.backgroundColor='transparent'"
                                        style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('ingredientes') ? $color_a_tag_hover : '' }}"
                                        href="{{ url('/ingredientes') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ver todos</p>
                                    </a>
                                </li>
                                @can('add ingredientes')
                                    <li class="nav-item">
                                        <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                            onmouseout="this.style.backgroundColor='transparent'"
                                            style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('crear-ingrediente') || Request::is('edit-ing/*') ? $color_a_tag_hover : '' }}"
                                            href="{{ url('/crear-ingrediente') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ingresar</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul> --}}
                            </li>
                        @endif
                    @endcan
                @endcan
                @can(['ver proveedores', 'ver registros', 'ver ordenes'])
                    <li class="nav-header" style="color: {{ $color_a_tag_sidebar }}">PROVEEDORES & ORDENES</li>
                    @can('ver proveedores')
                        @if ($proveedores)
                            <li class="nav-item has-treeview">
                                <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                    onmouseout="this.style.backgroundColor='transparent'"
                                    style="color: {{ $color_a_tag_sidebar }}" href="{{ url('/proveedores') }}"
                                    class="nav-link">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <p>
                                        &nbsp;Proveedores
                                    </p>
                                </a>
                                {{-- <ul class="nav nav-treeview">
                                @can('ver proveedores')
                                    <li class="nav-item">
                                        <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                            onmouseout="this.style.backgroundColor='transparent'"
                                            style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('proveedores') ? $color_a_tag_hover : '' }}"
                                            href="{{ url('/proveedores') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ver todos</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('add proveedores')
                                    <li class="nav-item">
                                        <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                            onmouseout="this.style.backgroundColor='transparent'"
                                            style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('crear-proveedor') || Request::is('edit-prov/*') ? $color_a_tag_hover : '' }}"
                                            href="{{ url('/crear-proveedor') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ingresar</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul> --}}
                            </li>
                        @endif
                    @endcan

                    @can('ver registros')
                        @if ($registros)
                            <li class="nav-item has-treeview">
                                <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                    onmouseout="this.style.backgroundColor='transparent'"
                                    style="color: {{ $color_a_tag_sidebar }}" href="{{ url('/registros') }}" class="nav-link">
                                    <i class="fa-regular fa-clipboard"></i>
                                    <p>
                                        &nbsp;Registro
                                    </p>
                                </a>
                                {{-- <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                        onmouseout="this.style.backgroundColor='transparent'"
                                        style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('registro') ? $color_a_tag_hover : '' }}"
                                        href="{{ url('/registros') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ver todos</p>
                                    </a>
                                </li>
                                @can('add registros')
                                    <li class="nav-item">
                                        <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                            onmouseout="this.style.backgroundColor='transparent'"
                                            style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('crear-registro') || Request::is('edit-reg/*') ? $color_a_tag_hover : '' }}"
                                            href="{{ url('/crear-registro') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ingresar</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul> --}}
                            </li>
                        @endif
                    @endcan


                    @can('ver ordenes')
                        @if ($ordenes)
                            <li class="nav-item">
                                <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                    onmouseout="this.style.backgroundColor='transparent'"
                                    style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('ordenes') ? $color_a_tag_hover : '' }}"
                                    href="{{ url('ordenes') }}" class="nav-link">
                                    <i class="fa-solid fa-calendar-day"></i>
                                    <p>
                                        &nbsp;Ordenes
                                    </p>
                                </a>
                            </li>
                        @endif
                    @endcan
                @endcan
                @can(['ver usuarios', 'ver configuracion', 'ver roles'])
                    <li class="nav-header" style="color: {{ $color_a_tag_sidebar }}">USUARIOS & CONFIGURACIÓN</li>
                    @can('ver usuarios')
                        @if ($usuarios)
                            <li class="nav-item">
                                <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                    onmouseout="this.style.backgroundColor='transparent'"
                                    style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('usuarios') ? $color_a_tag_hover : '' }}"
                                    href="{{ url('/usuarios') }}" class="nav-link">
                                    <i class="fa-solid fa-users"></i>
                                    <p>
                                        &nbsp; Usuarios
                                    </p>
                                </a>
                                {{-- <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                            onmouseout="this.style.backgroundColor='transparent'"
                                            style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('usuarios') ? $color_a_tag_hover : '' }}"
                                            href="{{ url('/usuarios') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ver todos</p>
                                        </a>
                                    </li>
                                    @can('add usuarios')
                                        <li class="nav-item">
                                            <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                                onmouseout="this.style.backgroundColor='transparent'"
                                                style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('add-usuario') || Request::is('edit-reg/*') ? $color_a_tag_hover : '' }}"
                                                href="{{ url('/add-usuario') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Ingresar</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul> --}}
                            </li>
                        @endif
                    @endcan

                    @can('ver configuracion')
                        <li class="nav-item">
                            <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                onmouseout="this.style.backgroundColor='transparent'"
                                style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('configuracion') ? $color_a_tag_hover : '' }}"
                                href="{{ url('configuracion') }}" class="nav-link">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                <p>
                                    &nbsp; Configuración
                                </p>
                            </a>
                        </li>
                        @can('ver roles')
                            @if ($roles_permisos)
                                <li class="nav-item">
                                    <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                        onmouseout="this.style.backgroundColor='transparent'"
                                        style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('roles') ? $color_a_tag_hover : '' }}"
                                        href="{{ url('roles') }}" class="nav-link">
                                        <i class="fa-solid fa-user-lock"></i>
                                        <p>
                                            &nbsp;Roles & Permisos
                                        </p>
                                    </a>
                                </li>
                            @endif
                        @endcan
                    @endcan
                @endcan
                @can('ver perfil')
                    <li class="nav-item">
                        <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                            onmouseout="this.style.backgroundColor='transparent'"
                            style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('perfil') ? $color_a_tag_hover : '' }}"
                            href="{{ url('perfil') }}" class="nav-link">
                            <i class="fas fa-star"></i>
                            <p>
                                Perfil
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item mt-3">
                    <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                        onmouseout="this.style.backgroundColor='transparent'"
                        style="color: {{ $color_a_tag_sidebar }}" class="nav-link" href="{{ route('logout') }}"
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
