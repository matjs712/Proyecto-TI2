<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="{{ asset($logo) }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:wght@200&family=Roboto+Condensed:wght@300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/login.css') }}">

    <style>
        body {
            overflow-x: hidden;
            font-family: 'Overpass', 'Sans serif';
        }
    </style>

    @yield('css_after')
</head>

<body class="hold-transition sidebar-mini">
    <div id="preloader"></div>
    @include('layouts.inc.frontNavbar')
    <div class="wrapper">
        @include('layouts.inc.slider')
        @yield('trending')
        @yield('trending_script')
        @yield('trending_cat')
        @yield('trending_cat_script')
        @include('layouts.inc.footer')
        @yield('footer_script')
    </div>

    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Zf4gKd+sTJzlc2+V8ymwqUrlypFtZlPxMWJppW8tcvzg49pkVmJHZMnOMjF48MnC" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        var availableTags = [];

        $.ajax({
            method: "GET",
            url: "/product-list/",
            success: function(response) {
                // console.log(response);
                autoComplete(response);
            }
        });

        function autoComplete(availableTags) {
            $("#search_product").autocomplete({
                source: availableTags
            });
        }
    </script>
    @yield('after_scripts')

    @if (session('status'))
        <script>
            swal("{{ session('status') }}")
        </script>
    @endif
    <script>
        var loader = document.getElementById('preloader');
        window.addEventListener("load", function() {
            loader.style.display = "none";
        })
    </script>

    @if (session('status'))
        <script>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                timer: 2000,
                timerProgressBar: true,
                icon: 'success',
                title: "{{ session('status') }}",
                showConfirmButton: false,
            })
        </script>
    @endif
    <script>
        var loader = document.getElementById('preloader');
        window.addEventListener("load", function() {
                loader.style.display = "none";
            })

            <
            /body>

            <
            /html>
