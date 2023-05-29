<div class="alert alert-warning alert-dismissible p-1 m-0 text-center" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
    <strong style="color:black">Oferta!!</strong> <span style="color:black;">Aprovecha nuestros precios de
        apertura!!</span>
</div>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: {{ $color_principal }}">
    {{-- <nav class="navbar navbar-home navbar-expand-lg navbar-dark" style="background-color: transparent;"> --}}
    <div style="flex:.4;">
        <a href="{{ url('/') }}" onmouseover="this.style.opacity= '1';"><img class="mr-2"
                src="{{ asset($logo) }}" width="150" alt=""></a>
    </div>
    {{-- <a class="navbar-brand mr-4" href="{{ url('/') }}">{{ $sitio }}</a> --}}

    <button class="navbar-toggler text-dark bg-dark" type="button" data-toggle="collapse"
        data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav d-flex justify-content-between mr-2" style="width:100%;">
            <div class="d-flex flex-wrap align-items-center" style="flex: 2;">
                <li class="nav-item" style="width:100%;">
                    <div class="search-bar">
                        <form action="{{ url('/searchproduct') }}" method="POST">
                            @csrf
                            <div class="input-group" style="display:flex;">
                                <button onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                    type="submit" class="input-group-text search search-submit"
                                    style="color: {{ $boton_principal_busqueda }}; background-color:transparent;"
                                    id="search-bar"><i class="fa fa-search" aria-hidden="true"></i></button>

                                <input type="search"
                                    style="border-bottom:1.5px solid black; background-color: {{ $color_barra_busqueda }}"
                                    onfocus="this.style.borderBottom='1.5px solid black';"
                                    onfocus="this.style.boxShadow = 'none'; this.style.outline = 'none';"
                                    name="nameProduct" id="search_product"
                                    class="form-control d-flex align-items-center" placeholder="Busca un producto">
                            </div>
                        </form>
                    </div>
                </li>
            </div>
            <div class="d-flex flex-wrap align-items-center">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a type="button" class="nav-link text-dark iniciar show-modal mr-2" data-toggle="modal"
                                data-target="#myModal">
                                {{ __('Login') }}
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a type="button" class="nav-link text-dark registrar show-modal mr-2" data-toggle="modal"
                                data-target="#myModalRegister">
                                {{ __('Register') }}
                            </a>
                        </li>
                    @endif
                </div>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user    "></i> {{ Auth::user()->name }}
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
                    </div>
                </li>
            @endguest
            @if (Auth::check() || session()->has('guest_id'))
                <li class="nav-item">
                    <a class="nav-link text-dark mr-2" href="{{ url('carrito') }}"><i
                            class="fas fa-shopping-bag    "></i>
                        <span class="badge badge-pill text-dark cart-count" style="background: #cf4647">0</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark mr-2" href="{{ url('wishlist') }}"><i class="fas fa-heart    "></i>
                        <span class="badge badge-pill text-dark wish-count" style="background: #a7c5bd">0</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>

</nav>

<div class="modal fade" style="width: 95%" id="myModal" tabindex="-1" role="dialog"
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

{{-- <nav class="navbar navbar-home navbar-expand-lg navbar-dark" style="background-color: transparent;"> --}}
<nav class="navbar navbar-expand-lg navbar-dark"
    style="background-color: {{ $color_principal }}; margin-botom: 0 !important;">
    {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> --}}

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <div style="flex:.4;">

        </div>
        <ul class="navbar-nav d-flex justify-content-start" style="flex:2">
            <li class="nav-item active">
                <a class="nav-link text-dark mr-4" href="{{ url('/') }}"><i class="fa fa-home"
                        aria-hidden="true"></i> Inicio <span class="sr-only">(current)</span></a>
            </li>
            @if ($productosFront)
                <li class="nav-item">
                    <a class="nav-link text-dark mr-4" href="{{ url('todo-productos') }}"><i
                            class="fas fa-box    "></i> Productos</a>
                </li>
            @endif
            @if ($categoriasFront)
                <li class="nav-item">
                    <a class="nav-link text-dark mr-4" href="{{ url('todo-categorias') }}"><i
                            class="fas fa-bookmark    "></i> Categorías</a>
                </li>
            @endif
            @if ($categoriasFront)
                <li class="nav-item">
                    <a class="nav-link text-dark mr-4" href="{{ url('todo-categorias') }}"><i
                            class="fas fa-people-carry    "></i> Nosotros</a>
                </li>
            @endif
            @if ($categoriasFront)
                <li class="nav-item">
                    <a class="nav-link text-dark mr-4" href="{{ url('todo-categorias') }}"><i
                            class="fas fa-phone    "></i> Contacto</a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav d-flex justify-content-start">
            <li class="nav-item">
                <a class="nav-link mr-4" href="tel:+569-1234-5678"
                    style="color:{{ $boton_principal_busqueda }}; font-size:20px"><i
                        class="fas fa-phone-volume mr-2"></i>9
                    12345678</a>
            </li>
        </ul>
    </div>

</nav>

<div class="contener">
    <div class="group">
        <p class="text d-flex justify-content-between" style="width: 100%;"> <i
                class="fas fa-gem    "></i><span>Sales</span><i class="fas fa-gem    "></i>
            <span>Gourmet</span><i class="fas fa-gem    "></i><span>Sabores</span><i
                class="fas fa-gem    "></i><span>Natural</span><i class="fas fa-gem    "></i><span>Sacos</span>
        </p>
    </div>
</div>


@section('after_scripts')
    <script>
        let style = document.createElement('style');
        let position = 'right';
        style.innerHTML = `
            @keyframes move-text{
                0%{${position}: -${document.querySelector('.text').offsetWidth + 10}px;}
                100%{${position}: 100%;}
            }`;
        document.head.append(style);
    </script>
@endsection
