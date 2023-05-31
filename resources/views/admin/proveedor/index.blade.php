@extends('layouts.admin')
@section('title')
    Proveedores | {{ $sitio }}
@endsection
@section('content')
    <div class="card hide2">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%">
                <h2>Proveedores</h2>
                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a href="{{ url('dashboard') }}" class="mr-2">Inicio</a> /
                    <a href="{{ url('proveedores') }}" class="ml-2">Proveedores</a>
                </h6>
            </div>
            <div class="d-flex aling-items-center flex-wrap">
                {{-- @can('add productos')
                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                    style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4"
                    href="{{ url('/crear-producto') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
            @endcan --}}
                @can('add proveedores')
                    <?php $urlCrearProveedor = url('/crear-proveedor'); ?>
                @endcan

            </div>
            <table style="width: 100%;" class="table table-bordered table-hover" id="tablaProveedores">
                <thead style="background-color:#343a40; color:white;">
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $item)
                        <tr class="text-center">
                            <td scope="row">{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td><span class="badge badge-primary">{{ $item->telefono }}</span></td>
                            <td><span class="badge badge-success">{{ $item->email }}</span></td>
                            <td>
                                <div class="dropdown text-center">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="d-flex pl-2 flex-column align-items-start justify-content-center">

                                            @can('edit proveedores')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_editar }}; color:white;"
                                                    href="{{ url('edit-prov/' . $item->id) }}" class="btn mb-1"><i
                                                        class="fas fa-edit"></i>Editar</a>
                                            @endcan
                                            @can('destroy proveedores')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_eliminar }}; color:white;"
                                                    href="{{ url('delete-prov/' . $item->id) }}" class="btn"><i
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
    <div class="modal fade" id="agregarProveedorModal" tabindex="-1" role="dialog"
        aria-labelledby="agregarProveedorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarProveedorModalLabel">Agregar Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de agregar proveedor -->
                    <form action="{{ url('insert-proveedor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" name="name" class="form-control" placeholder="Poleras"
                                        value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" name="telefono" class="form-control" placeholder="9 12345678"
                                        value="{{ old('telefono') }}">
                                    @if ($errors->has('telefono'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('telefono') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control"
                                        placeholder="proveedor@gmail.com" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('email') }}</span>
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
            $('#tablaProveedores').DataTable({
                responsive: true,
                language: spanishLanguage,
                initComplete: function() {
                    @if (isset($urlCrearProveedor))
                        $('<button onmouseover="this.style.opacity=\'0.9\'" onmouseout="this.style.opacity=\'1\'" style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarProveedorModal"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Agregar proveedor</button>')
                            .appendTo('.dataTables_length');
                    @endif
                }
            });
        })
    </script>
@endsection
