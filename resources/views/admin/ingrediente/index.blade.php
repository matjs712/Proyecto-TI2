@extends('layouts.admin')
@section('title')
    Ingredientes | {{ $sitio }}
@endsection
@section('content')
    <div class="card hide2">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%; flex-wrap:wrap">
                <h2>Ingredientes</h2>

                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a href="{{ url('dashboard') }}" class="mr-2">Inicio</a> /
                    <a href="{{ url('ingredientes') }}" class="ml-2">Ingredientes</a>
                </h6>
            </div>
            <div class="d-flex aling-items-center flex-wrap">

                @can('add ingredientes')
                    <?php $urlCrearIngrediente = url('/crear-ingrediente'); ?>
                @endcan

            </div>
            <table style="width: 100%;" class="table table-bordered table-hover" id="tablaIngredientes">
                <thead style="background-color:#343a40; color:white;">
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Medida</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredientes as $item)
                        <tr class="text-center">
                            <td scope="row">{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td><span class="badge badge-primary">{{ $item->cantidad }}</span></td>
                            <td>{{ $item->medida }}</td>
                            <td>
                                <div class="dropdown text-center">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="d-flex pl-2 flex-column align-items-start justify-content-center">
                                            @can('edit ingredientes')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_editar }}; color:white;"
                                                    href="{{ url('edit-ing/' . $item->id) }}" class="btn mb-1"><i
                                                        class="fas fa-edit"></i>Editar</a>
                                            @endcan
                                            @can('destroy ingredientes')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_eliminar }}; color:white;"
                                                    href="{{ url('delete-ing/' . $item->id) }}" class="btn"><i
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

    <!-- Modal -->
    <div class="modal fade" id="agregarIngredienteModal" tabindex="-1" role="dialog"
        aria-labelledby="agregarIngredienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarIngredienteModalLabel">Agregar Ingrediente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de agregar ingrediente -->
                    <form action="{{ url('insert-ingrediente') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" name="name" class="form-control" placeholder="Sal"
                                        value="{{ old('name') }}" autofocus>
                                    @if ($errors->has('name'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input name="cantidad" class="form-control" placeholder="100"
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
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
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
            $('#tablaIngredientes').DataTable({
                responsive: true,
                language: spanishLanguage,
                initComplete: function() {
                    @if (isset($urlCrearIngrediente))
                        $('<button onmouseover="this.style.opacity=\'0.9\'" onmouseout="this.style.opacity=\'1\'" style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarIngredienteModal"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Agregar ingrediente</button>')
                            .appendTo('.dataTables_length');
                        // $('<a onmouseover="this.style.opacity=\'0.9\'" onmouseout="this.style.opacity=\'1\'" style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4" href="{{ $urlCrearIngrediente }}"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Agregar ingrediente</a>')
                        //     .appendTo('.dataTables_length');
                    @endif
                }
            });
        })
    </script>
@endsection
