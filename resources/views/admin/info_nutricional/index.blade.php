@extends('layouts.admin')
@section('title')
    Informacion Nutricional | {{ $sitio }}
@endsection
@section('content')
    <div class="card hide2">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%; flex-wrap:wrap">
                <h2>Informacion Nutricional</h2>
                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a href="{{ url('dashboard') }}" class="mr-2">Inicio</a> /
                    <a href="{{ url('nutricionales') }}" class="ml-2">Informacion Nutricional</a>
                </h6>
            </div>
            <div class="d-flex aling-items-center flex-wrap">

                @can('add nutricionales')
                    <?php $urlCrearNutricional = url('/crear-nutricional'); ?>
                @endcan

            </div>
            <table style="width: 100%;" class="table table-bordered table-hover" id="tablaProductos">
                <thead style="background-color:#33393f; color:white">
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Producto</th>
                        <th>Valor Energetico</th>
                        <th>Grasa Saturada
                        </th>
                        <th>Grasa total</th>
                        <th>Sal</th>
                        <th>Yodo</th>
                        <th>Azucar</th>
                        <th>proteina</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nutricionales as $nutricional)
                        <tr class="text-center">
                            <td scope="row">{{ $nutricional->id }}</td>
                            <td>{{ $nutricional->product->name }}</td>
                            <td>{{ $nutricional->valor_energetico }}</td>
                            <td>{{ $nutricional->grasa_saturada }}</td>
                            <td>{{ $nutricional->grasa_total }}</td>
                            <td>{{ $nutricional->sal }}</td>
                            <td>{{ $nutricional->yodo }}</td>
                            <td>{{ $nutricional->azucar }}</td>
                            <td>{{ $nutricional->proteina }}</td>



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
                                                class="btn mb-1" data-toggle="modal" data-target="#modalNutricional"
                                                data-nutricional-id="{{ $nutricional->id }}">Ver más</a>
                                            @can('edit nutricionales')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_editar }}; color:white;"
                                                    href="{{ url('edit-nutricional/' . $nutricional->id) }}"
                                                    class="btn mb-1"><i class="fas fa-edit"></i>Editar</a>
                                            @endcan
                                            @can('destroy nutricionales')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_eliminar }}; color:white;"
                                                    href="{{ url('delete-nutricional/' . $nutricional->id) }}"
                                                    class="btn"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
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

    <div class="modal fade" id="modalNutricional" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Detalles de la informacion nutricional</h5>
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

    <!-- Modal -->
    <div class="modal fade" id="modalCrearNutricional" tabindex="-1" role="dialog"
        aria-labelledby="modalCrearNutricionalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearNutricionalLabel">Crear Informacion Nutricional</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('insert-nutricional') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Producto</label>
                                    <select name="id_producto" class="form-control" id="">
                                        <option value="">Selecciona producto.</option>
                                        @foreach ($productos as $nutricional)
                                            <option value="{{ $nutricional->id }}">{{ $nutricional->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_producto'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('id_producto') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Valor Energetico</label>
                                    <input type="number" name="valor_energetico" class="form-control" placeholder="10"
                                        value="{{ old('valor_energetico') }}">
                                    @if ($errors->has('valor_energetico'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('valor_energetico') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Grasa Saturada</label>
                                    <input type="number" name="grasa_saturada" class="form-control" placeholder="10"
                                        value="{{ old('grasa_saturada') }}">
                                    @if ($errors->has('grasa_saturada'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('grasa_saturada') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Grasa Total</label>
                                    <input type="number" name="grasa_total" class="form-control" placeholder="10"
                                        value="{{ old('grasa_total') }}">
                                    @if ($errors->has('grasa_total'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('grasa_total') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Sal</label>
                                    <input type="number" name="sal" class="form-control" placeholder="10"
                                        value="{{ old('sal') }}">
                                    @if ($errors->has('sal'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('sal') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Yodo</label>
                                    <input type="number" name="yodo" class="form-control" placeholder="10"
                                        value="{{ old('yodo') }}">
                                    @if ($errors->has('yodo'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('yodo') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Azucar</label>
                                    <input type="number" name="azucar" class="form-control" placeholder="10"
                                        value="{{ old('azucar') }}">
                                    @if ($errors->has('azucar'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('azucar') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Proteina</label>
                                    <input type="number" name="proteina" class="form-control" placeholder="10"
                                        value="{{ old('proteina') }}">
                                    @if ($errors->has('proteina'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('proteina') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>
        $(document).ready(function() {
            $('#tablaProductos').DataTable({
                responsive: true,
                "language": spanishLanguage,
                dom: '<"toolbar">lBfrtip',
                "buttons": [
                    {
                        extend: 'collection',
                        text: 'Exportar',
                        buttons: [
                            {
                                extend: 'excel',
                                exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6 , 7, 8]
                                }
                            },
                            {
                                extend: 'csv',
                                exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6 , 7, 8]
                                }
                            },
                            {
                                extend: 'pdf',
                                exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6 , 7, 8]
                                },
                                customize: function(doc) {
                                // Estilos CSS para centrar el contenido
                                doc.defaultStyle.alignment = 'center'; // Alineación centrada para todo el documento
                                doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split(''); // Ancho automático de las columnas

                                // Ajustar estilos de las celdas
                                doc.styles.tableBodyEven.alignment = 'center';
                                doc.styles.tableBodyOdd.alignment = 'center';
                                },
                            },
                            {
                                extend: 'print',
                                text: 'Imprimir',
                                exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6 , 7, 8]
                                }
                            },
                        ]
                    }
                ],
                initComplete: function() {
                    @if (isset($urlCrearNutricional))
                        $('<button onmouseover="this.style.opacity=\'0.9\'" onmouseout="this.style.opacity=\'1\'" style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearNutricional"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Agregar Informacion Nutricional</button>')
                            .appendTo('.dataTables_length');
                    @endif
                }
            });
        });

        $('#modalNutricional').on('show.bs.modal', function(event) {
            // Obtén el botón que abrió el modal
            var button = $(event.relatedTarget);
            // Obtén el ID del registro que se está editando
            var registroId = button.data('nutricional-id');
            // Realiza una petición AJAX para obtener el contenido del registro
            $.ajax({
                url: '/modal-nutricionales/' + registroId,
                type: 'GET',
                success: function(data) {
                    // Actualiza el contenido del modal con el contenido del registro
                    $('#modalNutricional .modal-body').html(data);
                },
                error: function() {
                    // Muestra un mensaje de error si la petición AJAX falla
                    alert('Ocurrió un error al cargar el registro.');
                }
            });
        });
    </script>
@endsection
