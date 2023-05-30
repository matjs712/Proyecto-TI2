<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset($logo) }}">
    <title>@yield('title')</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" />
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('admin/dist/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/sidebar.css') }}">

    <style>
        .hide2 {
            opacity: 0;
            filter: blur(3px);
            transition: all .6s;
        }

        .sho {
            opacity: 1;
            filter: blur(0);
            transform: translateX(0);
        }

        /* .modal .modal-dialog {
            overflow-y: auto !important;
            max-height: 90vh;
        } */

        .custom-swal-bg {
            background-color: #dc3545 !important;
            color: white !important;
        }

        .custom-swal-success {
            background-color: #07c443 !important;
            color: white !important;
        }
    </style>
    @yield('css_before')


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('layouts.inc.adminNav')
        @include('layouts.inc.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: {{ $color_fondo_admin }}">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        @include('layouts.inc.adminFooter')

    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js">
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"
        integrity="sha512-bCsBoYoW6zE0aja5xcIyoCDPfT27+cGr7AOCqelttLVRGay6EKGQbR6wm6SUcUGOMGXJpj+jrIpMS6i80+kZPw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"
        integrity="sha512-pUhApVQtLbnpLtJn6DuzDD5o2xtmLJnJ7oBoMsBnzOkVkpqofGLGPaBJ6ayD2zQe3lCgCibhJBi4cj5wAxwVKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/dist/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('admin/js/idioma.js') }}"></script>
    <script src="{{ asset('admin/js/myChart.js') }}"></script>
    <script src="https://kit.fontawesome.com/d75291e766.js" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    @yield('after_scripts')
    <script>
        $('body').addClass('layout-fixed');
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
                customClass: {
                    popup: 'custom-swal-success'
                }
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                timer: 3000,
                timerProgressBar: true,
                icon: 'warning',
                title: "{{ session('error') }}",
                background: 'danger',
                showConfirmButton: false,
                customClass: {
                    popup: 'custom-swal-bg'
                }
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            // Detectar cambios en el estado del sidebar
            $('.sidebar').on('collapsed.lte.treeview expanded.lte.treeview', function() {
                toggleSidebarFooter();
            });

            // Función para ocultar o mostrar el sidebar-footer
            function toggleSidebarFooter() {
                var sidebarFooter = $('.sidebar-footer');
                if ($('.sidebar').hasClass('sidebar-collapse')) {
                    sidebarFooter.hide();
                } else {
                    sidebarFooter.show();
                }
            }

            // Inicialmente ocultar o mostrar el sidebar-footer según el estado del sidebar
            toggleSidebarFooter();
        });
    </script>
</body>

</html>
