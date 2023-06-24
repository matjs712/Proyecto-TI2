@extends('layouts.app')

@section('content')

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
                <div @if ($errors->has('name')) class="is-invalid" @endif class="text-input">
                    <i class="fa-solid fa-user"></i>
                    <input  id="name" type="text" name="name" placeholder="Nombre" value="{{ old('name') }}">

                </div>
                <div @if ($errors->has('lname')) class="is-invalid" @endif class="text-input">
                    <i class="fa-solid fa-user"></i>
                    <input  id="lname" type="text" name="lname" placeholder="Apellido" value="{{ old('lname') }}">

                </div>
                <div @if ($errors->has('email')) class="is-invalid" @endif class="text-input">
                    <i class="fa-solid fa-envelope"></i>
                    <input  id="email" type="email" name="email" placeholder="Correo electronico" value="{{ old('email') }}">
                </div>
                <div class="text-input">
                    <i class="fa-solid fa-phone"></i>
                    <input id="tel" type="tel" name="phone" placeholder="9XXXXXXXX" pattern="9[0-9]{8}$" maxlength="9">
                </div>
                <div @if ($errors->has('password')) class="is-invalid" @endif class="text-input">
                    <i class="fa-solid fa-lock"></i>
                    <input id="password" type="password" name="password" placeholder="Contraseña">

                </div>
                <div @if ($errors->has('password_confirmation')) class="is-invalid" @endif class="text-input">
                    <i class="fa-solid fa-lock"></i>
                    <input id="password-confirm" type="password" name="password_confirmation"
                        placeholder="Confirmar contraseña" required autocomplete="new-password">
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
