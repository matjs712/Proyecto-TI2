@extends('layouts.admin')
@section('title')
Registros | {{ $sitio }}
@endsection
@section('content')


<div class="card">
    <div class="card-header d-flex aling-items-center flex-wrap">
        <h4>Registros</h4>
        @can('add registros')
            <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'" style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4" href="{{ url('/crear-registro') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                    <td>
                        <div class="dropdown text-center">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="d-flex pl-2 flex-column align-items-start justify-content-center">
                                    <button onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'" style="background-color: {{ $boton_vermas }}; color:white;" class="btn mb-1"><i class="fas fa-edit"></i>Ver más</button>
                                    @can('edit registros')
                                        <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'" style="background-color: {{ $boton_editar }}; color:white;" href="{{ url('edit-reg/'.$item->id) }}" class="btn mb-1"><i class="fas fa-edit"></i>Editar</a>             
                                    @endcan
                                    @can('destroy registros')
                                        <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'" style="background-color: {{ $boton_eliminar }}; color:white;" href="{{ url('delete-reg/'.$item->id) }}" class="btn"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
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
        $('#tablaRegistros').DataTable({
            responsive: true,
            "language": spanishLanguage,
        });
    })
</script>

@endsection