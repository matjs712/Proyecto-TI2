@extends('layouts.admin')
@section('title')
    Registros | {{ $sitio }}
@endsection
@section('content')
    <div class="py-3 mb-1 border-bottom border-top">
        <div class="container ml-3">
            <h6 class="mb-0">
                <a href="{{ url('dashboard') }}">Inicio</a> /
                <a href="{{ url('registros') }}">Registros</a>
            </h6>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex aling-items-center flex-wrap">
            <h4>Registros</h4>
            @can('add registros')
                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                    style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4"
                    href="{{ url('/crear-registro') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
            @endcan
        </div>
        <div class="card-body">
            <table style="width: 100%;" class="table table-bordered" id="tablaRegistros">
                <thead style="background-color:#343a40; color:white;">
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Ingrediente</th>
                        <th>Cantidad</th>
                        <th>Factura</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $registros)
                        <tr class="text-center">
                            <td scope="row">{{ $registros->id }}</td>
                            <td>{{ $registros->fecha }}</td>
                            <td>{{ $registros->proveedor->name }}</td>
                            <td>{{ $registros->ingrediente->name }}</td>
                            <td><span class="badge badge-primary">{{ $registros->cantidad }}</span></td>
                            <td>
                                @if ($registros->factura)
                                    <img width="100" src="{{ Storage::url('uploads/facturas/' . $registros->factura) }}"
                                        alt="factura-registro">
                                @endif
                            </td>
                            <td>
                                <div class="dropdown text-center">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="d-flex pl-2 flex-column align-items-start justify-content-center">
                                            <a href="#" onmouseover="this.style.opacity='0.9'"
                                                onmouseout="this.style.opacity='1'"
                                                style="background-color: {{ $boton_vermas }}; color:white;"
                                                class="btn mb-1" data-toggle="modal" data-target="#modalRegistro"
                                                data-registros-id="{{ $registros->id }}">Ver más</a>
                                            @can('edit registros')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_editar }}; color:white;"
                                                    href="{{ url('edit-reg/' . $registros->id) }}" class="btn mb-1"><i
                                                        class="fas fa-edit"></i>Editar</a>
                                            @endcan
                                            @can('destroy registros')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_eliminar }}; color:white;"
                                                    href="{{ url('delete-reg/' . $registros->id) }}" class="btn"><i
                                                        class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Detalles del Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí se agregará el contenido del registro mediante AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>
        $(document).ready(function() {
            $('#tablaRegistros').DataTable({
                responsive: true,
                "language": spanishLanguage,
            });

            $('#modalRegistro').on('show.bs.modal', function(event) {
                // Obtén el botón que abrió el modal
                var button = $(event.relatedTarget);

                // Obtén el ID del registro que se está editando
                var registroId = button.data('registros-id');

                // Realiza una petición AJAX para obtener el contenido del registro
                $.ajax({
                    url: '/modal-registros/' + registroId,
                    type: 'GET',
                    success: function(data) {
                        // Actualiza el contenido del modal con el contenido del registro
                        $('#modalRegistro .modal-body').html(data);
                    },
                    error: function() {
                        // Muestra un mensaje de error si la petición AJAX falla
                        alert('Ocurrió un error al cargar el registro.');
                    }
                });
            });
        })
    </script>
@endsection
