<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: {{ $color_principal }}">
    <img src="{{ asset($logo) }}" width="50" alt="">
    <a class="navbar-brand" href="{{ url('/') }}">{{ $sitio }}</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <div class="search-bar">
                    <form action="{{ url('/searchproduct') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="search" style="background-color:{{ $color_barra_busqueda }}"
                                name="nameProduct" id="search_product" class="form-control"
                                placeholder="¿Que estas buscando?">
                            <button onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                type="submit" class="input-group-text search"
                                style="background-color: {{ $boton_principal_busqueda }}; color:white;"><i
                                    class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </li>
            <li class="nav-item active ml-3">
                <a class="nav-link" href="{{ url('/') }}">Inicio <span class="sr-only">(current)</span></a>
            </li>
            @if ($productosFront)
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('todo-productos') }}">Productos</a>
                </li>
            @endif
            @if ($categoriasFront)
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('todo-categorias') }}">Categorías</a>
                </li>
            @endif

            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{ route('login') }}">
              {{ __('Login') }}
            </a> --}}
                        <a type="button" class="nav-link show-modal" data-toggle="modal" data-target="#myModal">
                            {{ __('Login') }}
                        </a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a type="button" class="nav-link show-modal" data-toggle="modal" data-target="#myModalRegister">
                            {{ __('Register') }}
                        </a>
                        {{-- <a class="nav-link" href="{{ route('register') }}">
              {{ __('Register') }}
          </a> --}}
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('carrito') }}">Carrito
                        <span class="badge badge-pill text-white cart-count" style="background: #cf4647">0</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('wishlist') }}">Lista
                        <span class="badge badge-pill text-white wish-count" style="background: #a7c5bd">0</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ url('mis-ordenes') }}">Mis pedidos</a>
                        @if (Auth::check())
                            @php
                                $roles = \Spatie\Permission\Models\Role::all()
                                    ->pluck('id')
                                    ->toArray();
                            @endphp
                            @if (in_array(Auth::user()->role_as, $roles))
                                @can('ver dashboard')
                                    <a class="dropdown-item" href="{{ url('/dashboard') }}">Panel de administración</a>
                                @endcan
                            @endif
                        @endif

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                            {{ __('Salir') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                </li>
            @endguest
        </ul>
    </div>

</nav>
<div class="modal fade" style="width: 95%" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content clearfix">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> --}}
            <div class="modal-content clearfix">
                <div class="modal-body">
                    <div class="modal-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="container">
                        <h3 class="title p-4 text-center">Bienvenido! <span>:)</span></h3>
                        <form method="POST" action="{{ route('login') }}" class="text-start">
                            @csrf

                            <div class="row mb-3 d-flex flex-column">
                                <label for="email"
                                    class="col-md-12 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3  d-flex flex-column">
                                <label for="password"
                                    class="col-md-12 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 d-flex align-items-center flex-wrap">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link"
                            href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" style="width: 95%" id="myModalRegister" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content clearfix">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> --}}
            <div class="modal-content clearfix">
                <div class="modal-body">
                    <div class="modal-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="container">
                        <h3 class="title p-4 text-center">Bienvenido! <span>:)</span></h3>
                        <form method="POST" action="{{ route('register') }}" class="text-start">
                            @csrf

                            <div class="row mb-3 d-flex flex-column">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-12">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 d-flex flex-column">
                                <label for="email"
                                    class="col-md-12 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3  d-flex flex-column">
                                <label for="password"
                                    class="col-md-12 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3  d-flex flex-column">
                                <label for="password-confirm"
                                    class="col-md-12 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4 p-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
