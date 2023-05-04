@extends('layouts.admin')
@section('title')
Productos | {{ $sitio }}
@endsection
@section('content')


<div class="card">
    <div class="card-header d-flex aling-items-center flex-wrap">
        <h4>Productos</h4>
        @can('add productos')
            <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'" style="background-color: {{ $boton_nuevo }}; color:white;"  class="btn ml-4" href="{{ url('/crear-producto') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
        @endcan
    </div>
    <div class="card-body">
        <table style="width: 100%;" class="table table-bordered" id="tablaProductos">
            <thead style="background-color:#343a40; color:white;">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Categoria</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Precio de oferta</th>
                    <th>Imagen</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $product)
                <tr class="text-center"> 
                    <td scope="row">{{ $product->id }}</td>
                    <td>{{ $product-> category->name }}</td>
                    <td>{{ $product->name }}</td>
                    <td><span class="badge badge-primary">{{ $product->original_price }}</span></td>
                    <td><span class="badge badge-success">{{ $product->selling_price }}</span></td>
                    {{-- <td>{!! ($product->status == 0)? '<span class="badge badge-success">Visible</span>' : '<span class="badge badge-danger">No visible</span>' !!}</td> --}}
                    <td>
                    @if ($product->image)
                        <img src="{{Storage::url('uploads/productos/'.$product->image)}}" width="150" alt="imagen-producto">
                    @endif
                    </td>
                    <td>
                        <div class="dropdown text-center">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="d-flex pl-2 flex-column align-items-start justify-content-center">
                                    <a href="#" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'" style="background-color: {{ $boton_vermas }}; color:white;"  class="btn mb-1" data-toggle="modal" data-target="#modal" data-product-id="{{ $product->id }}">Ver más</a>
                                    @can('edit productos')
                                        <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'" style="background-color: {{ $boton_editar }}; color:white;" href="{{ url('edit-prod/'.$product->id) }}" class="btn mb-1"><i class="fas fa-edit"></i>Editar</a>
                                    @endcan
                                    @can('destroy productos')
                                        <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'" style="background-color: {{ $boton_eliminar }}; color:white;" href="{{ url('delete-prod/'.$product->id) }}" class="btn"><i class="fa fa-trash" aria-hidden="true"></i>Eliminar</a>
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Detalles del producto</h5>
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


@endsection

@section('after_scripts')
<script>	
    $(document).ready(function(){
        $('#tablaProductos').DataTable({
            responsive: true,
            "language": spanishLanguage,
        });

        $('#modal').on('show.bs.modal', function (event) {
            // Obtén el botón que abrió el modal
            var button = $(event.relatedTarget);
            
            // Obtén el ID del registro que se está editando
            var registroId = button.data('product-id');
            
            // Realiza una petición AJAX para obtener el contenido del registro
            $.ajax({
                url: '/modal-productos/' + registroId,
                type: 'GET',
                success: function(data) {
                    // Actualiza el contenido del modal con el contenido del registro
                    $('#modal .modal-body').html(data);
                },
                error: function() {
                    // Muestra un mensaje de error si la petición AJAX falla
                    alert('Ocurrió un error al cargar el registro.');
                }
            });
        });
    })
</script>

@endsection