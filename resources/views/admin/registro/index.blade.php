@extends('layouts.admin')
@section('title')
    Registros | {{ $sitio }}
@endsection
@section('content')
    <div class="card hide2">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%">
                <h2>Registros</h2>
                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a href="{{ url('dashboard') }}" class="mr-2">Inicio</a> /
                    <a href="{{ url('registros') }}" class="ml-2">Registros</a>
                </h6>
            </div>
            <div class="d-flex aling-items-center flex-wrap">
                @can('add registros')
                    <?php $urlCrearRegistro = url('/crear-registro'); ?>
                @endcan

            </div>
            <table style="width: 100%;" class="table table-bordered table-hover" id="tablaRegistros">
                <thead style="background-color:#343a40; color:white;">
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Ingrediente</th>
                        <th>Cantidad</th>
                        <th>Medida</th>
                        <th>Factura</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $item)
                        <tr class="text-center">
                            <td scope="row">{{ $item->id }}</td>
                            <td>{{ $item->fecha }}</td>
                            <td>{{ $item->proveedor->name }}</td>
                            <td>{{ $item->ingrediente->name }}</td>
                            <td><span class="badge badge-primary">{{ $item->cantidad }}</span></td>
                            <td>{{ $item->medida }}</td>
                            <td>
                                @if (pathinfo($item->factura, PATHINFO_EXTENSION) == 'pdf')
                                    <i class="fa-solid fa-file-pdf"></i>
                                @else
                                    <i class="fa-solid fa-image"></i>
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
                                                style="background-color: {{ $boton_vermas }}; color:white;" class="btn mb-1"
                                                data-toggle="modal" data-target="#modalRegistro"
                                                data-registros-id="{{ $item->id }}">Ver más</a>

                                            @can('edit registros')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_editar }}; color:white;"
                                                    href="{{ url('edit-reg/' . $item->id) }}" class="btn mb-1"><i
                                                        class="fas fa-edit"></i>Editar</a>
                                            @endcan
                                            @can('destroy registros')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_eliminar }}; color:white;"
                                                    href="{{ url('delete-reg/' . $item->id) }}" class="btn"><i
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
                    <h5 class="modal-title" id="modalLabel">Detalles del registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí se agregará el contenido del registro mediante AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btn-descargar" class="btn btn-primary">Descargar
                        Factura</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="agregarRegistroModal" tabindex="-1" role="dialog"
        aria-labelledby="agregarRegistroModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarRegistroModalLabel">Agregar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de agregar registro -->
                    <form action="{{ url('insert-registro') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Fecha</label>
                                    <input type="date" name="fecha" class="form-control"
                                        value="{{ old('fecha') }}">
                                    @if ($errors->has('fecha'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('fecha') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Proveedor</label>
                                    <select name="id_proveedor" class="form-control"id="">
                                        <option value="">Selecciona el proveedor.</option>
                                        @foreach ($proveedores as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_proveedor'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('id_proveedor') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Ingredientes</label>
                                    <select name="id_ingrediente" class="form-control"id="">
                                        <option value="">Selecciona el ingrediente.</option>
                                        @foreach ($ingredientes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_ingrediente'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('id_ingrediente') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Cantidad</label>
                                    <input type="number" name="cantidad" class="form-control"
                                        value="{{ old('cantidad') }}">
                                    @if ($errors->has('cantidad'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('cantidad') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="medida">Medida</label>
                                    <select name="medida" class="form-control">
                                        <option value="gr" {{ old('medida') == 'gramos' ? 'selected' : '' }}>Gramos
                                        </option>
                                        <option value="kg" {{ old('medida') == 'kilogramos' ? 'selected' : '' }}>
                                            Kilogramos</option>
                                    </select>
                                    @if ($errors->has('medida'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('medida') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="">Facturas</label>
                                <input type="file" id="image" name="factura" class="form-control">
                                @if ($errors->has('factura'))
                                    <span class="error text-danger"
                                        for="input-name">{{ $errors->first('factura') }}</span>
                                @endif
                                <img id="preview" width="200" height="200" src="" alt="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Crear</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>
        const input = document.querySelector('#image');
        const preview = document.querySelector('#preview');
        input.addEventListener('change', () => {
            const file = input.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', () => {
                preview.setAttribute('src', reader.result);
            });
            reader.readAsDataURL(file);
        });

        $(document).ready(function() {
            $('#tablaRegistros').DataTable({
                responsive: true,
                "language": spanishLanguage,
                initComplete: function() {
                    @if (isset($urlCrearRegistro))
                        $('<button onmouseover="this.style.opacity=\'0.9\'" onmouseout="this.style.opacity=\'1\'" style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarRegistroModal"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Agregar Registro</button>')
                            .appendTo('.dataTables_length');
                    @endif
                }
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
                    error: function(data) {
                        // Muestra un mensaje de error si la petición AJAX falla

                        alert('Ocurrió un error al cargar el registro.');
                    }
                });
            });
        })


        $(document).ready(function() {
            $('#btn-descargar').click(function() {
                var imagenUrl = $('#imagen-cargada').attr('src');
                console.log(imagenUrl);

                if (imagenUrl.replace('/storage/uploads/facturas/', '').length != 0) {
                    var a = document.createElement('a');
                    a.href = imagenUrl;
                    a.download = '';
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                }

            });
        });
    </script>
@endsection
