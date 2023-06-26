@extends('layouts.app')

@section('content')
<div class="container">
    <div class = "design">
        <div class="pill-1 rotate-45"></div>
        <div class="pill-2 rotate-45"></div>
        <div class="pill-3 rotate-45"></div>
        <div class="pill-4 rotate-45"></div>
    </div>
    <div class="login">
        <h3 class="title">{{ __('Reset Password') }}</h3>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @else
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            @error('email')
                <span class="is-invalid text-input" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="text-input">
                <i class="fa-solid fa-envelope"></i>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electronico">

            </div>
            <button type="submit" class="login-btn">
                {{ __('Send Password Reset Link') }}
            </button>
        </form>
        @endif
    </div>
</div>
@endsection
