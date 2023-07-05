@extends('layouts.app')

@section('content')
    <div id="login-container" class="container">
        <div class="design">
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
                <div @if ($errors->has('email')) class="is-invalid" @endif class="text-input">
                    <i class="fa-solid fa-user"></i>
                    <input id="email" type="email" name="email" placeholder="Correo electronico"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                </div>
                <div @if ($errors->has('email')) class="is-invalid" @endif class="text-input">
                    <i class="fa-solid fa-lock"></i>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="Contraseña">
                </div>
                <button type="submit" class="login-btn">Iniciar Sesion</button>

            </form>
            <a href="{{ route('password.request') }}" class="forgot">¿Olvidaste tu contraseña?</a>
            <div class="create">
                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                <i class="fa-solid fa-arrow-right"></i>
            </div>
        </div>
    </div>
@endsection
