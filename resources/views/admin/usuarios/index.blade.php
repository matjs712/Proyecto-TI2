@extends('layouts.admin')
@section('title', 'Usuarios')

@section('content')


<div class="card">
    <div class="card-header d-flex aling-items-center flex-wrap">
        <h4>Usuarios registrados</h4>
        {{-- <a class="btn btn-warning ml-4" href="{{ url('/crear-producto') }}"><i class="fa fa-plus" aria-hidden="true"></i></a> --}}
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
                                    <a href="{{ url('ver-usuario/'.$user->id) }}" class="btn mb-1 btn-primary"><i class="fas fa-edit"></i>Ver usuario</a>
                                    <a href="{{ url('delete-prod/'.$user->id) }}" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
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