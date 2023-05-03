@extends('layouts.admin')
@section('title')
Proveedores | {{ $sitio }}
@endsection
@section('content')

<div class="py-3 mb-1 border-bottom border-top">
    <div class="container ml-3">
        <h6 class="mb-0">
            <a href="{{ url('dashboard') }}">Inicio</a> / 
            <a href="{{ url('proveedores') }}">Proveedores</a>
        </h6>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex aling-items-center flex-wrap">
        <h4>Proveedores</h4>
        @can('add proveedores')
            <a class="btn btn-warning ml-4" href="{{ url('/crear-proveedor') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
        @endcan
    </div>
    <div class="card-body">
        <table style="width: 100%;" class="table table-bordered" id="tablaProveedores">
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
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="d-flex pl-2 flex-column align-items-start justify-content-center">
                                    {{-- <button class="btn mb-1 btn-success"><i class="fas fa-edit"></i>Ver más</button> --}}
                                    @can('edit proveedores')
                                        <a href="{{ url('edit-prov/'.$item->id) }}" class="btn mb-1 btn-primary"><i class="fas fa-edit"></i>Editar</a>
                                    @endcan
                                    @can('destroy proveedores')
                                        <a href="{{ url('delete-prov/'.$item->id) }}" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
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
        $('#tablaProveedores').DataTable({
            responsive: true,
            "language": spanishLanguage,
        });
    })
</script>

@endsection