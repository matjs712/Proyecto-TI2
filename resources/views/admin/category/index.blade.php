@extends('layouts.admin')
@section('title')
    Categorias | {{ $sitio }}
@endsection
@section('content')
    <div class="card hide2">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%; flex-wrap:wrap">
                <h2>Categorías</h2>

                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a href="{{ url('dashboard') }}" class="mr-2">Inicio</a> /
                    <a href="{{ url('categorias') }}" class="ml-2">Categorías</a>
                </h6>

            </div>
            <div class="d-flex aling-items-center flex-wrap">
                @can('add categorias')
                    <?php $urlCrearCategoria = url('/crear-categoria'); ?>
                @endcan

            </div>
            <table style="width: 100%;" class="table table-bordered table-hover" id="tablaCategorias">
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
                            <td>{{ Str::substr($categoria->description, 0, 80) }}...</td>
                            <td>{!! $categoria->status == 1
                                ? '<span class="badge badge-success">Visible</span>'
                                : '<span class="badge badge-danger">No visible</span>' !!}</td>
                            <td>{!! $categoria->popular == 1
                                ? '<span class="badge badge-success">Si</span>'
                                : '<span class="badge badge-danger">No</span>' !!}</td>
                            <td>
                                <img width="100" src="{{ Storage::url('uploads/categorias/' . $categoria->image) }}"
                                    alt="categoria-name">
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
                                                data-toggle="modal" data-target="#modalCategoria"
                                                data-category-id="{{ $categoria->id }}">Ver más</a>
                                            @can('edit categorias')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_editar }}; color:white;"
                                                    href="{{ url('edit-cat/' . $categoria->id) }}" class="btn mb-1"><i
                                                        class="fas fa-edit"></i>Editar</a>
                                            @endcan
                                            @can('destroy categorias')
                                                <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                                    style="background-color: {{ $boton_eliminar }}; color:white;"
                                                    href="{{ url('delete-cat/' . $categoria->id) }}" class="btn"><i
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


    <div class="modal fade" id="modalCategoria" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Detalles de la categoría</h5>
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
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Crear Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('insert-category') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre Categoría</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Sales"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug"
                                        class="form-control @error('slug') is-invalid @enderror" placeholder="sales"
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea type="text" rows="5" style="resize:none;" name="description"
                                        class="form-control @error('description') is-invalid @enderror" placeholder="Sales de mar...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="">Imagen</label>
                                <input type="file" id="image" name="image" class="form-control">
                                <img id="preview" width="200" height="200" src="" alt=" ">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado">Visibilidad</label>
                                    <input type="checkbox" name="status"
                                        class="form-control @error('status') is-invalid @enderror"
                                        {{ old('status') ? 'checked' : '' }}>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="popular">Popular</label>
                                    <input type="checkbox" name="popular"
                                        class="form-control @error('popular') is-invalid @enderror"
                                        {{ old('popular') ? 'checked' : '' }}>
                                    @error('popular')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
            $('#tablaCategorias').DataTable({
                responsive: true,
                language: spanishLanguage,
                initComplete: function() {
                    @if (isset($urlCrearCategoria))
                        $('<button onmouseover="this.style.opacity=\'0.9\'" onmouseout="this.style.opacity=\'1\'" style="background-color: {{ $boton_nuevo }}; color:white;" class="btn ml-4"  type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryModal"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Agregar categoría</button>')
                            .appendTo('.dataTables_length');
                    @endif
                }
            });

            $('#modalCategoria').on('show.bs.modal', function(event) {
                // Obtén el botón que abrió el modal
                var button = $(event.relatedTarget);

                // Obtén el ID del registro que se está editando
                var registroId = button.data('category-id');

                // Realiza una petición AJAX para obtener el contenido del registro
                $.ajax({
                    url: '/modal-categorias/' + registroId,
                    type: 'GET',
                    success: function(data) {
                        // Actualiza el contenido del modal con el contenido del registro
                        $('#modalCategoria .modal-body').html(data);
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
