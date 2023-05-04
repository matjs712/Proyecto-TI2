@extends('layouts.admin')
@section('title')
Roles | {{ $sitio }}
@endsection
@section('content')


<div class="card">
    <div class="card-header d-flex aling-items-center flex-wrap">
        <h4>Roles & Permisos</h4>
        <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'" style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4" href="{{ url('/add-roles') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
    <div class="card-body">
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
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="d-flex pl-2 flex-column align-items-start justify-content-center">
                                    {{-- <a href="{{ route('roles.show',$rol) }}" class="btn mb-1 btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Ver rol</a> --}}
                                    <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'" style="background-color: {{ $boton_editar }}; color:white;" href="{{ route('roles.edit', $rol) }}" class="btn mb-1"><i class="fas fa-edit"></i> Permisos</a>
                                    <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'" style="background-color: {{ $boton_eliminar }}; color:white;" href="{{ url('delete-rol/'.$rol->id) }}" class="btn"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
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
        $('#tablaRoles').DataTable({
            responsive: true,
            "language": spanishLanguage,
        });
    })
</script>

@endsection