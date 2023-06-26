<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Desabelle') }}</title>
    {{-- titulo --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @php
        $logo = App\Models\Logo::first();
        $path = 'logo/' . $logo->logo;
        $icon = Storage::url($path);
    @endphp
    <link rel="icon" href="{{ asset($icon) }}">
    <!-- Styles -->
    {{-- <link href="{{ asset('frontend/css/bootstrap5.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <script src="https://kit.fontawesome.com/2e28cd0fce.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/css/login-laravel.css') }}">

</head>

<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" defer></script>

</body>

</html>
