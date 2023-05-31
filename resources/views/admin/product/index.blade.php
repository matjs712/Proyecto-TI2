@extends('layouts.admin')
@section('title')
    Productos | {{ $sitio }}
@endsection
@section('content')
    <div class="card hide2">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%; flex-wrap:wrap">
                <h2>Productos</h2>
                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a href="{{ url('dashboard') }}" class="mr-2">Inicio</a> /
                    <a href="{{ url('productos') }}" class="ml-2">Productos</a>
                </h6>
            </div>
            <div class="d-flex aling-items-center flex-wrap">
                {{-- @can('add productos')
                    <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                        style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4"
                        href="{{ url('/crear-producto') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                @endcan --}}
                @can('add productos')
                    <?php $urlCrearProducto = url('/crear-producto'); ?>
                @endcan

            </div>
            <table style="width: 100%;" class="table table-bordered table-hover" id="tablaProductos">
                <thead style="background-color:#33393f; color:white">
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Categoria</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $product)
                        <tr class="text-center">
                            <td scope="row">{{ $product->id }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->qty }}</td>
                            <td><span class="badge badge-primary">{{ $product->original_price }}</span></td>
                            <td>{!! $product->status == 0
                                ? '<span class="badge badge-danger">No visible</span>'
                                : '<span class="badge badge-success">Visible</span>' !!}</td>
                            <td>
                                {{-- @if (Storage::exists('uploads/productos/' . $product->image)) --}}
                                <img src="{{ Storage::url('uploads/productos/' . $product->image) }}" width="100"
                                    alt="">
                                {{-- @else
                                    <i class="fas fa-image" style="font-size: 30px;"></i>
                                @endif --}}

                            </td>
                            <td>
                                <div class="dropdown text-center">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="d-flex pl-2 flex-column align-items-start justify-content-center">
                                            <a href="#" onmouseover="this.style.opacity='0.9'"
                                                onmouseout="this.style.opacity='1'"
                                                style="background-color: {{ $boton_vermas }}; color:white;" class="btn mb-1"
                                                data-toggle="modal" data-target="#modal"
                                                data-product-id="{{ $product->id }}">Ver más</a>
                                            @can('edit productos')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_editar }}; color:white;"
                                                    href="{{ url('edit-prod/' . $product->id) }}" class="btn mb-1"><i
                                                        class="fas fa-edit"></i>Editar</a>
                                            @endcan
                                            @can('destroy productos')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_eliminar }}; color:white;"
                                                    href="{{ url('delete-prod/' . $product->id) }}" class="btn"><i
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

    <!-- Modal -->
    <div class="modal fade" id="modalCrearProducto" tabindex="-1" role="dialog" aria-labelledby="modalCrearProductoLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearProductoLabel">Crear Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('insert-producto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Categoría</label>
                                    <select name="categoria" class="form-control" id="">
                                        <option value="">Selecciona la categoría.</option>
                                        @foreach ($categorias as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('categoria'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('categoria') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre Producto</label>
                                    <input type="text" name="name" class="form-control" placeholder="sal de mar"
                                        value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Slug</label>
                                    <input type="text" name="slug" class="form-control" placeholder="sal mar"
                                        value="{{ old('slug') }}">
                                    @if ($errors->has('slug'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('slug') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">Descripción pequeña</label>
                                    <input type="text" name="small_description" class="form-control"
                                        placeholder="Sal de mar" value="{{ old('small_description') }}">
                                    @if ($errors->has('small_description'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('small_description') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea type="text" rows="5" style="resize:none;" name="description" class="form-control"
                                        placeholder="Exquisita sal de mar..." value="{{ old('description') }}">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Precio</label>
                                    <input type="number" name="price" class="form-control"
                                        value="{{ old('price') }}">
                                    @if ($errors->has('price'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Precio en oferta</label>
                                    <input type="number" name="selling_price" class="form-control"
                                        value="{{ old('selling_price') }}">
                                    @if ($errors->has('selling_price'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('selling_price') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="">Cantidad</label>
                                    <input type="number" name="qty" class="form-control"
                                        value="{{ old('qty') }}">
                                    @if ($errors->has('qty'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('qty') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="">Imagen</label>
                                <input type="file" id="image" name="image" class="form-control">
                                @if ($errors->has('image'))
                                    <span class="error text-danger" for="input-name">{{ $errors->first('image') }}</span>
                                @endif
                                <img id="preview" width="200" height="200" src="" alt=" ">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado">Visibilidad</label>
                                    <input type="checkbox" name="status" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado">Popular</label>
                                    <input type="checkbox" name="trending" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="ingredientes-extra"></div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-dark" id="agregar-ingrediente">Agregar ingrediente</button>
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-primary">Crear</button>
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
            $('#tablaProductos').DataTable({
                responsive: true,
                language: spanishLanguage,
                initComplete: function() {
                    @if (isset($urlCrearProducto))
                        $('<button onmouseover="this.style.opacity=\'0.9\'" onmouseout="this.style.opacity=\'1\'" style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCrearProducto"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Agregar producto</button>')
                            .appendTo('.dataTables_length');
                    @endif
                }
            });
        });

        $(document).ready(function() {
            const input = document.querySelector('#image');
            const preview = document.querySelector('#preview');

            // ocultar la imagen de vista previa al cargar la página
            preview.setAttribute('src', '');
            preview.style.display = 'none';

            input.addEventListener('change', () => {
                if (input.files && input.files[0]) { // comprobar si se ha seleccionado un archivo
                    const file = input.files[0];
                    const reader = new FileReader();

                    reader.addEventListener('load', () => {
                        preview.setAttribute('src', reader.result);
                    });
                    reader.readAsDataURL(file);
                    preview.style.display = 'block'; // mostrar la vista previa
                } else {
                    preview.setAttribute('src',
                        ''); // establecer el atributo src en vacío para ocultar la vista previa
                    preview.style.display = 'none'; // ocultar la vista previa
                }
            });

            $('#modal').on('show.bs.modal', function(event) {
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
        let ingredienteCount = 0;
        document.getElementById('agregar-ingrediente').addEventListener('click', function() {
            ingredienteCount++;
            const div = document.createElement('div');
            div.innerHTML = `
        <div class="form-group d-flex align-items-end">
          <div class="col-md-3">
            <label for="ingrediente${ingredienteCount}">Ingrediente ${ingredienteCount}</label>
              <select class="form-control" name="ingrediente${ingredienteCount}" id="ingrediente${ingredienteCount}">
                <option value="">Seleccione un ingrediente</option>
                  @foreach ($ingredientes as $ingrediente)
                      <option value="{{ $ingrediente->id }}">{{ $ingrediente->name }}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label for="ingrediente${ingredienteCount}">Cantidad </label>
              <input class="form-control" type="number" name="cantidad${ingredienteCount}" id="cantidad${ingredienteCount}" value="0">
            </div>
            <div class="col-md-3">
              <label for="ingrediente${ingredienteCount}">Medida </label>
              <select name="medida" class="form-control">
                    <option value="gr" {{ old('medida') == 'gramos' ? 'selected' : '' }}>Gramos</option>
                    <option value="kg" {{ old('medida') == 'kilogramos' ? 'selected' : '' }}>Kilogramos</option>
              </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-eliminar-ingrediente">Eliminar</button>
            </div>
        </div>
    `;
            document.getElementById('ingredientes-extra').appendChild(div);
            const btnEliminar = div.querySelector('.btn-eliminar-ingrediente');
            btnEliminar.addEventListener('click', function() {
                div.remove();
            });

        });
    </script>

    </script>
@endsection
