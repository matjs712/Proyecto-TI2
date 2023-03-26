@extends('layouts.admin')
@section('title', 'Categorias')

@section('content')


<div class="card">
    <div class="card-header d-flex aling-items-center flex-wrap">
        <h4>Categorias</h4>
        <a class="btn btn-warning ml-4" href="{{ url('/crear-categoria') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
    <div class="card-body">
        <table style="width: 100%;" class="table table-bordered" id="tablaCategorias">
            <thead style="background-color:#343a40; color:white;">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Popular</th>
                    <th>Imagen</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                <tr class="text-center"> 
                    <td scope="row">{{ $categoria->id }}</td>
                    <td>{{ $categoria->name }}</td>
                    <td>{{ $categoria->slug }}</td>
                    <td>{{ $categoria->description }}</td>
                    <td>{!! ($categoria->status == 1)? '<span class="badge badge-success">Visible</span>' : '<span class="badge badge-danger">No visible</span>' !!}</td>
                    <td>{!! ($categoria->popular == 1)? '<span class="badge badge-success">Si</span>':'<span class="badge badge-danger">No</span>'  !!}</td>
                    <td>
                        <img width="100" src="{{ asset('assets/uploads/categorias/'.$categoria->image) }}" alt="categoria-name">
                    </td>
                    <td>
                        <div class="dropdown text-center">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="d-flex pl-2 flex-column align-items-start justify-content-center">
                                    <button class="btn mb-1 btn-success"><i class="fas fa-edit"></i>Ver más</button>
                                    <a href="{{ url('edit-cat/'.$categoria->id) }}" class="btn mb-1 btn-primary"><i class="fas fa-edit"></i>Editar</a>
                                    <a href="{{ url('delete-cat/'.$categoria->id) }}" class="btn btn-danger text-white"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
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
        $('#tablaCategorias').DataTable({
            responsive: true,
            "language": spanishLanguage,
        });
    })
</script>

@endsection