<aside class="main-sidebar  elevation-4" style="background-color: {{ $color_barra_lateral }}">
    <!-- Brand Logo -->
    <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
        onmouseout="this.style.backgroundColor='transparent'" style="color: {{ $color_a_tag_sidebar }}"
        href="{{ url('/') }}" class="brand-link d-flex align-items-center justify-content-center    ">
        <img src="{{ asset($logo) }}" alt="Logo" class="brand-image elevation-3" style="opacity: .8">
        {{-- <span class="brand-text font-weight-light">{{ $sitio }}</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="position: relative">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center" style="padding-bottom:0!important">
            @if (Auth::user()->imagen)
                <div class="image">
                    <img src="{{ Storage::url('users/' . Auth::user()->imagen) }}" class="user-img elevation-2"
                        style="width: 70px !important; border-radius:10px" alt="User">
                </div>
            @endif
            <?php
            $nombreUsuario = Auth::user()->name;
            $palabras = explode(' ', $nombreUsuario);
            $primerNombre = $palabras[0];
            if (isset($palabras[1])) {
                $segundoNombre = $palabras[1];
            }
            $roles = Auth::user()->getRoleNames();
            $roleName = $roles->first();
            ?>
            <div class="info">
                <span style="color: {{ $color_a_tag_sidebar }}" class="d-block">{{ $primerNombre }}
                    @if (isset($segundoNombre))
                        <strong>{{ $segundoNombre }}</strong>
                    @endif
                </span>
                <span style="color: {{ $color_a_tag_sidebar }}" class="d-block">{{ $roleName }}</span>
                <span style="color: {{ $color_a_tag_sidebar }}" class="d-flex align-items-center">
                    <div style="width:5px;height:5px;border-radius:50%;background-color:greenyellow;" class="mr-2">
                    </div>Online
                </span>

            </div>
        </div>
        <hr class="bg-white">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

                @can('ver notificaciones')
                    <li class="nav-item">
                        <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                            onmouseout="this.style.backgroundColor='transparent'"
                            style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('notificaciones') ? $color_a_tag_hover : '' }};"
                            href="{{ url('/notificaciones') }}" class="nav-link">
                            <i class="fa-solid fa-bell"></i>
                            <p>
                                Notificaciones
                            </p>
                        </a>
                    </li>
                @endcan
                @if (auth()->user()->hasPermissionTo('ver productos') ||
                        auth()->user()->hasPermissionTo('ver recetas') ||
                        auth()->user()->hasPermissionTo('ver categorias') ||
                        auth()->user()->hasPermissionTo('ver ingredientes'))
                    <li class="nav-header" style="color: {{ $color_a_tag_sidebar }}">
                        PRODUCTOS & INGREDIENTES
                    </li>
                @endif


                @can('ver productos')
                    @if ($productos)
                        <li class="nav-item has-treeview">
                            <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                onmouseout="this.style.backgroundColor='transparent'"
                                style="color: {{ $color_a_tag_sidebar }}" href="{{ url('/productos') }}" class="nav-link">
                                <i class="fa-solid fa-cart-flatbed"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                    @endif
                @endcan

                @can('ver recetas')
                    @if ($recetas)
                        <li class="nav-item has-treeview">
                            <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                onmouseout="this.style.backgroundColor='transparent'"
                                style="color: {{ $color_a_tag_sidebar }}" href="{{ url('/recetas') }}" class="nav-link">
                                <i class="fa-regular fa-rectangle-list"></i>
                                <p>Recetas</p>
                            </a>
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
                                <p>Categorías</p>
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
                                    Ingredientes
                                </p>
                            </a>
                        </li>
                    @endif
                @endcan
                @if (auth()->user()->hasPermissionTo('ver proveedores') ||
                        auth()->user()->hasPermissionTo('ver registros') ||
                        auth()->user()->hasPermissionTo('ver ordenes'))
                    <li class="nav-header" style="color: {{ $color_a_tag_sidebar }}">PROVEEDORES & ORDENES</li>
                @endif
                @can('ver proveedores')
                    @if ($proveedores)
                        <li class="nav-item has-treeview">
                            <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                onmouseout="this.style.backgroundColor='transparent'"
                                style="color: {{ $color_a_tag_sidebar }}" href="{{ url('/proveedores') }}"
                                class="nav-link">
                                <i class="fa-solid fa-user-tie"></i>
                                <p>
                                    Proveedores
                                </p>
                            </a>
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
                                    Registro
                                </p>
                            </a>
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
                                    Ordenes
                                </p>
                            </a>
                        </li>
                    @endif
                @endcan
                @if (auth()->user()->hasPermissionTo('ver usuarios') ||
                        auth()->user()->hasPermissionTo('ver configuracion') ||
                        auth()->user()->hasPermissionTo('ver roles'))
                    <li class="nav-header" style="color: {{ $color_a_tag_sidebar }}">USUARIOS & CONFIGURACIÓN</li>
                @endif
                @can('ver usuarios')
                    @if ($usuarios)
                        <li class="nav-item">
                            <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                onmouseout="this.style.backgroundColor='transparent'"
                                style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('usuarios') ? $color_a_tag_hover : '' }}"
                                href="{{ url('/usuarios') }}" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>
                                    Usuarios
                                </p>
                            </a>
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
                                Configuración
                            </p>
                        </a>
                    </li>
                @endcan
                @can('ver roles')
                    @if ($roles_permisos)
                        <li class="nav-item">
                            <a onmouseover="this.style.backgroundColor='{{ $color_a_tag_hover }}'"
                                onmouseout="this.style.backgroundColor='transparent'"
                                style="color: {{ $color_a_tag_sidebar }}; background-color:{{ Request::is('roles') ? $color_a_tag_hover : '' }}"
                                href="{{ url('roles') }}" class="nav-link">
                                <i class="fa-solid fa-user-lock"></i>
                                <p>
                                    Roles & Permisos
                                </p>
                            </a>
                        </li>
                    @endif
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
                {{-- <li class="nav-item mt-3">
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
                </li> --}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
    <div class="slimScrollBar" style="background: grey; opacity: 0.4; border-radius: 7px;">
    </div>
    <div class="slimScrollRail" style=" border-radius: 7px; background: blue; opacity: 0.2; ">
    </div>
</aside>
