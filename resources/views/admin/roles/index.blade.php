@extends('layouts.admin')
@section('title')
    Roles | {{ $sitio }}
@endsection
@section('css_before')
    <style>
        .columnas {
            column-count: 3;
            /* Número de columnas deseado */
            column-gap: 20px;
            /* Espacio entre columnas */
        }
    </style>
@endsection
@section('content')
    <div class="card hide2">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%">
                <h2 style="flex:1">Roles & Permisos</h2>
                <div class="container" style="flex:1">
                    <h6 class="mb-0 d-flex align-items-center justify-content-end">
                        <a href="{{ url('dashboard') }}" class="mr-2">Inicio</a> /
                        <a href="{{ url('productos') }}" class="ml-2">Roles & Permisos</a>
                    </h6>
                </div>
            </div>
            <div class="d-flex aling-items-center flex-wrap">
                {{-- @can('add productos')
                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                    style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4"
                    href="{{ url('/crear-producto') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
            @endcan --}}
                @can('add roles')
                    <?php $urlCrearRol = url('/add-roles'); ?>
                @endcan

            </div>
            <table style="width: 100%;" class="table table-bordered" id="tablaRoles">
                <thead style="background-color:#343a40; color:white;">
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr class="text-center">
                            <td scope="row">{{ $rol->id }}</td>
                            <td>{{ $rol->name }}</td>
                            <td>
                                <div class="dropdown text-center">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="d-flex pl-2 flex-column align-items-start justify-content-center">
                                            {{-- <a href="{{ route('roles.show',$rol) }}" class="btn mb-1 btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Ver rol</a> --}}
                                            <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                style="background-color: {{ $boton_editar }}; color:white;"
                                                href="{{ route('roles.edit', $rol) }}" class="btn mb-1"><i
                                                    class="fas fa-edit"></i> Permisos</a>
                                            <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                style="background-color: {{ $boton_eliminar }}; color:white;"
                                                href="{{ url('delete-rol/' . $rol->id) }}" class="btn"><i
                                                    class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
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
    <div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel">Crear Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'roles.store']) !!}
                    @include('admin.roles.partials.form')
                    <div class="modal-footer">
                        {!! Form::submit('Crear Rol', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('after_scripts')
    <script>
        $(document).ready(function() {
            $('#tablaRoles').DataTable({
                responsive: true,
                "language": spanishLanguage,
                initComplete: function() {
                    @if (isset($urlCrearRol))
                        $('<button onmouseover="this.style.opacity=\'0.9\'" onmouseout="this.style.opacity=\'1\'" style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#createRoleModal"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Agregar rol</button>')
                            .appendTo('.dataTables_length');
                    @endif
                }
            });
        })
    </script>
@endsection
