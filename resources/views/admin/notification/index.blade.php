@extends('layouts.admin')
@section('title')
    Notificaciones | {{ $sitio }}
@endsection
@section('css_before')
    <style>
        @media (max-width: 768px) {
            .notificacion-title {
                width: 100% !important;
                text-align: center !important;
                margin-bottom: 1.5rem;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="card hide2">
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-4 d-flex flex-wrap" id="myTab" role="tablist">
                            <h4 class="mr-4 notificacion-title">Notificaciones</h4>
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Nuevas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false">Historial</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="d-flex aling-items-center flex-wrap">

                                    {{-- @can('add ingredientes') --}}
                                    <?php $urlUpdateNotificacion = url('/actualizar-notificaciones'); ?>
                                    {{-- @endcan --}}

                                </div>
                                <table class="table table-bordered table-hover" id="tablaNotificaciones"
                                    style="width: 100%">
                                    <thead style="background-color:#343a40; color:white;">
                                        <tr>
                                            <th><input type="checkbox" id="checkAll"></th> <!-- columna para selección -->
                                            <th>Detalle</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            {{-- <th>Opciones</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notifications->sortByDesc('created_at') as $item)
                                            @php
                                                $color = '';
                                                if ($item->tipo == 0) {
                                                    $color = 'black';
                                                } elseif ($item->tipo == 1) {
                                                    $color = 'orange';
                                                } else {
                                                    $color = 'red';
                                                }
                                            @endphp
                                            <tr style="color: {{ $color }};">
                                                <td>
                                                    <input type="checkbox" name="notification_id[]"
                                                        value="{{ $item->id }}">
                                                </td>
                                                <td>{{ $item->detalle }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                <td>{{ date('H:i', strtotime($item->created_at)) }}</td>
                                                {{-- <td>
                                                    <form action="{{ url('update-notification/' . $item->id) }}"
                                                        class="d-flex align-items-center justify-content-center"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button onmouseover="this.style.opacity='0.9'"
                                                            onmouseout="this.style.opacity='1'"
                                                            style="background-color: {{ $boton_editar }}; color:white; margin: 0!important;"
                                                            type="submit" class="btn mt-3"><i
                                                                class="fas fa-check"></i></button>

                                                    </form>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table-bordered table-hover" id="tablaNotificacionesOld" style="width: 100%">
                                    <thead style="background-color:#343a40; color:white;">
                                        <tr>
                                            <th>Detalle</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notificationsOld as $item)
                                            @php
                                                $color = '';
                                                if ($item->tipo == 0) {
                                                    $color = 'black';
                                                } elseif ($item->tipo == 1) {
                                                    $color = 'orange';
                                                } else {
                                                    $color = 'red';
                                                }
                                            @endphp
                                            <tr style="color: {{ $color }};">
                                                <td>{{ $item->detalle }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                <td>{{ date('H:i', strtotime($item->created_at)) }}</td>
                                                <td>
                                                    <form action="{{ url('update-notification/' . $item->id) }}"
                                                        class="d-flex align-items-center justify-content-center"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button onmouseover="this.style.opacity='0.9'"
                                                            onmouseout="this.style.opacity='1'"
                                                            style="background-color: {{ $boton_editar }}; color:white; margin: 0!important;"
                                                            type="submit" class="btn mt-3"><i
                                                                class="fa-solid fa-x"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script>
        $(document).ready(function() {
            $('#tablaNotificacionesOld').DataTable({
                responsive: true,
                "language": spanishLanguage,
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#tablaNotificaciones').DataTable({
                responsive: true,
                "language": spanishLanguage,
                "order": [
                    [3, "desc"]
                ],
                initComplete: function() {
                    @if (isset($urlUpdateNotificacion))
                        $('<button id="buttonUpdate" onclick="actualizarSeleccionados()" class="btn btn-primary ml-4">Actualizar</button>')
                            .appendTo('.dataTables_length');
                    @endif
                }
            });
        })
        $(document).ready(function() {
            $('#tablaNotificacionesOld_length').find('#buttonUpdate').closest('button').css('display', 'none');
        });
    </script>
    <script>
        function actualizarSeleccionados() {
            var ids = [];
            $('input[name="notification_id[]"]:checked').each(function() {
                ids.push($(this).val());
            });

            if (ids.length > 0) {
                $.ajax({
                    url: "{{ url('actualizar-notificaciones') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        ids: ids
                    },
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            timer: 2000,
                            timerProgressBar: true,
                            icon: 'success',
                            title: "Notificaciones actualizadas exitosamente,",
                            showConfirmButton: false,
                            customClass: {
                                popup: 'custom-swal-success'
                            }
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {

                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    timer: 2000,
                    timerProgressBar: true,
                    icon: 'warning',
                    title: "Seleccione al menos una notificación.",
                    background: 'danger',
                    showConfirmButton: false,
                    customClass: {
                        popup: 'custom-swal-bg'
                    }
                });
            }
        }
        $('#checkAll').click(function() {
            $('input[name="notification_id[]"]').prop('checked', this.checked);
        });
    </script>
@endsection
