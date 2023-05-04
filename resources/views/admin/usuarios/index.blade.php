@extends('layouts.admin')
@section('title')
Usuarios | {{ $sitio }}
@endsection
@section('content')

<div class="py-3 mb-1 border-bottom border-top">
    <div class="container ml-3">
        <h6 class="mb-0">
            <a href="{{ url('dashboard') }}">Inicio</a> / 
            <a href="{{ url('usuarios') }}">Usuarios</a>
        </h6>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex aling-items-center flex-wrap">
        <h4>Usuarios registrados</h4>
        @can('add usuarios')
            <a class="btn btn-warning ml-4" href="{{ url('/add-usuario') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
        @endcan
    </div>
    <div class="card-body">
        <table style="width: 100%;" class="table table-bordered" id="tablaUsuarios">
            <thead style="background-color:#343a40; color:white;">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $user)
                <tr class="text-center"> 
                    <td scope="row">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telefono }}</td>
                    <td>
                        <div class="dropdown text-center">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="d-flex pl-2 flex-column align-items-start justify-content-center">
                                    @can('ver info usuarios')
                                        <a href="{{ url('ver-usuario/'.$user->id) }}" class="btn mb-1 btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Ver usuario</a>
                                    @endcan
                                    @can('edit usuarios')
                                        <a href="{{ route('usuarios.edit', $user) }}" class="btn mb-1 btn-success text-white"><i class="fas fa-edit"></i> Editar</a>
                                    @endcan
                                    @can('destroy usuarios')
                                    <a href="{{ url('delete-usuario/'.$user->id) }}" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
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


@endsection

@section('after_scripts')
	
<script>	
    
    $(document).ready(function(){
        $('#tablaUsuarios').DataTable({
            responsive: true,
            "language": spanishLanguage,
        });
    })
</script>

@endsection