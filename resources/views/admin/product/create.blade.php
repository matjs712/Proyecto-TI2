@extends('layouts.admin')
@section('title')
    Productos | {{ $sitio }}
@endsection
@section('content')
    <div class="py-3 mb-1 border-bottom border-top">
        <div class="container ml-3">
            <h6 class="mb-0">
                <a href="{{ url('dashboard') }}">Inicio</a> /
                <a href="{{ url('productos') }}">Productos</a> /
                <a href="{{ url('crear-producto') }}">Añadir producto</a>
            </h6>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Añadir Producto</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('insert-producto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Categoría</label>
                            <select name="categoria" class="form-control"id="">
                                <option value="">Selecciona la categoría.</option>
                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('categoria'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('categoria') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre Producto</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="sal de mar"value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Slug</label>
                            <input type="text" name="slug" class="form-control" placeholder="sal mar"
                                value="{{ old('slug') }}">
                            @if ($errors->has('slug'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('slug') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug">Descripción pequeña</label>
                            <input type="text" name="small_description" class="form-control" placeholder="Sal de mar"
                                value="{{ old('small_description') }}">
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
                                placeholder="Exquisita sal de mar..."value="{{ old('description') }}">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Precio</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                            @if ($errors->has('price'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('price') }}</span>
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
                            <input type="number" name="qty" class="form-control" value="{{ old('qty') }}">
                            @if ($errors->has('qty'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('qty') }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- <div class="col-md-6">
                  <div class="form-group">
                    <label for="popular">Tax</label>
                    <input type="number" name="tax" class="form-control">
                  </div>
              </div> --}}
                    <div class="col-md-12 mb-4">
                        <label for="">Imagen</label>
                        {{-- <input type="file" name="image" class="form-control"> --}}
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
                    {{--
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="estado">Meta titulo</label>
                    <input type="text" name="meta_title" class="form-control">
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group">
                    <label for="estado">Meta descripción</label>
                    <input type="text" name="meta_description" class="form-control">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="estado">Meta palabras claves</label>
                    <input type="text" name="meta_keywords" class="form-control">
                  </div>
              </div>
                 --}}
                    <div class="col-md-12">
                        {{-- <div class="form-group d-flex">
                            <div class="col-md-3">
                                <label for="ingrediente1">Ingrediente 1</label>
                                <select class="form-control" name="ingrediente1" id="ingrediente1">
                                    <option value="">Seleccione un ingrediente</option>
                                    @foreach ($ingredientes as $ingrediente)
                                        <option value="{{ $ingrediente->id }}">{{ $ingrediente->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Cantidad </label>
                                <input class="form-control" type="number" name="cantidad1" id="cantidad1"
                                    value="0">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="medida">Medida</label>
                                    <select name="medida" class="form-control">
                                        <option value="gr" {{ old('medida') == 'gramos' ? 'selected' : '' }}>Gramos</option>
                                        <option value="kg" {{ old('medida') == 'kilogramos' ? 'selected' : '' }}>Kilogramos</option>
                                    </select>
                                    @if ($errors->has('medida'))
                                        <span class="error text-danger" for="input-name">{{ $errors->first('medida') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div> --}}
                        <div id="ingredientes-extra"></div>
                    </div>
                    <button type="button" class="btn btn-dark" id="agregar-ingrediente">Agregar ingrediente</button>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script>
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
                preview.setAttribute('src', ''); // establecer el atributo src en vacío para ocultar la vista previa
                preview.style.display = 'none'; // ocultar la vista previa
            }
        });

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
@endsection
