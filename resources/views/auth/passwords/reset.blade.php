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

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="text-input @error('email') is-invalid @enderror">
                            <i class="fa-solid fa-envelope"></i>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="{{ __('Email Address') }}" autofocus>
                        </div>
                        <div class="text-input @error('password') is-invalid @enderror">
                            <i class="fa-solid fa-lock"></i>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
                        </div>

                        <div class="text-input @error('password') is-invalid @enderror">
                            <i class="fa-solid fa-lock"></i>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                        </div>
                        
                        <button type="submit" class="login-btn">
                            {{ __('Reset Password') }}
                        </button>
                    </form>
            </div>
</div>
@endsection
