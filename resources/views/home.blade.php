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
                    @if (session('status'))
                        <h3 class="title" role="alert">
                            {{ session('status') }}
                        </h3>
                    @endif

                    <h3 class="title">{{ __('You are logged in!') }}</h3>
                    <button class="login-btn" onclick="window.location.href = '{{ route('frontend.index') }}'">Ir al inicio!</button>
            </div>
</div>
@endsection
