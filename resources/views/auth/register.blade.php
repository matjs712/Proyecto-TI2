@extends('layouts.app')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
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
</div> --}}

    <div class="container">
        <div class="design">
            <div class="pill-1 rotate-45"></div>
            <div class="pill-2 rotate-45"></div>
            <div class="pill-3 rotate-45"></div>
            <div class="pill-4 rotate-45"></div>
        </div>
        <div class="login">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <h3 class="title">{{ __('Register') }}</h3>
                {{-- @error('password', 'email') --}}
                {{-- @error('password')
                <div class="text-input is-invalid">
                    <p>Ingrese un correo valido.<br><br> Ambas contraseñas deben coincidir.</p>
                </div>
            @enderror --}}
                <div class="text-input">
                    <i class="fa-solid fa-user"></i>
                    <input id="name" type="text" name="name" placeholder="Nombre" value="{{ old('name') }}">

                </div>
                <div>
                    @if ($errors->has('name'))
                        <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="text-input">
                    <i class="fa-solid fa-envelope"></i>
                    <input id="email" type="email" name="email" placeholder="Correo electronico"
                        value="{{ old('email') }}">
                </div>
                <div>
                    @if ($errors->has('email'))
                        <span class="error text-danger" for="input-name">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="text-input">
                    <i class="fa-solid fa-lock"></i>
                    <input id="password" type="password" name="password" placeholder="Contraseña">

                </div>
                <div>
                    @if ($errors->has('password'))
                        <span class="error text-danger" for="input-name">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="text-input">
                    <input id="password-confirm" type="password" name="password_confirmation"
                        placeholder="Confirmar contraseña" required autocomplete="new-password">
                </div>
                <div>
                    @if ($errors->has('password_confirmation'))
                        <span class="error text-danger"
                            for="input-name">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <button type="submit" class="login-btn">{{ __('Register') }}</button>
            </form>
            <div class="create">
                <a href={{ route('login') }}>{{ __('Login') }}</a>
                <i class="fa-solid fa-arrow-right"></i>
            </div>
        </div>
    </div>
@endsection
