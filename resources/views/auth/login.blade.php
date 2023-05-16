@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

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

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
        <div class = "design">
            <div class="pill-1 rotate-45"></div>
            <div class="pill-2 rotate-45"></div>
            <div class="pill-3 rotate-45"></div>
            <div class="pill-4 rotate-45"></div>
        </div>
        <div class="login">
            <form class="" action="{{ route('login') }}" method="post">
                @csrf
                <h3 class="title">Iniciar sesion</h3>
                {{-- @error('email', 'password') --}}
                @error('email')
                <div class="text-input is-invalid">
                    <p>Correo o contraseña incorrecto. La contraseña debe tener al menos 8 carácteres</p>
                </div>
                @enderror
                <div class="text-input">
                    <i class="fa-solid fa-user"></i>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Correo electronico" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    
                    {{-- @error('email')
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
                </div>
                <div class="text-input @error('password') is-invalid @enderror">
                    <i class="fa-solid fa-lock" @error('password') style="color:red"@enderror></i>
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Contraseña">
                    @error('password') <i class="fa-sharp fa-solid fa-circle-exclamation" style="color:red"></i>@enderror
                </div>
                <button type="submit" class="login-btn">Iniciar Sesion</button>
                
            </form>    
            <a href="{{route('password.request')}}" class="forgot">¿Olvidaste tu contraseña?</a>
            <div class="create">
                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                <i class="fa-solid fa-arrow-right"></i>
            </div>
        </div>
    </div>  
@endsection
