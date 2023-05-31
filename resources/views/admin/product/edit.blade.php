@extends('layouts.admin')
@section('title')
    Productos | {{ $sitio }}
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%; flex-wrap:wrap">
                <h2>Productos</h2>

                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a href="{{ url('dashboard') }}" class="mr-2">Inicio</a> /
                    <a href="{{ url('productos') }}" class="mx-2">Productos</a> /
                    <a href="#" class="ml-2">Editar producto</a>
                </h6>
            </div>
            <form action="{{ url('update-prod/' . $producto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Categoría</label>
                            <select name="categoria" class="form-control"id="">
                                <option value="">Selecciona la categoría.</option>
                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $cat->id === $producto->cate_id ? 'selected' : '' }}>{{ $cat->name }}</option>
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
                            <input type="text" name="name" value="{{ $producto->name }}" class="form-control"
                                placeholder="Poleras">
                            @if ($errors->has('name'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Slug</label>
                            <input type="text" name="slug" value="{{ $producto->slug }}" class="form-control"
                                placeholder="Poleras">
                            @if ($errors->has('slug'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('slug') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug">Descripción pequeña</label>
                            <input type="text" name="small_description" value="{{ $producto->small_description }}"
                                class="form-control" placeholder="Poleras">
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
                                placeholder="Categoría dedicada solo a peloras de ...">{{ $producto->description }}</textarea>
                            @if ($errors->has('description'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Precio</label>
                            <input type="number" name="price" value="{{ $producto->original_price }}"
                                class="form-control">
                            @if ($errors->has('price'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Precio en oferta</label>
                            <input type="number" name="selling_price" value="{{ $producto->selling_price }}"
                                class="form-control">
                            @if ($errors->has('selling_price'))
                                <span class="error text-danger"
                                    for="input-name">{{ $errors->first('selling_price') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Cantidad</label>
                            <input type="number" name="qty" value="{{ $producto->qty }}" class="form-control">
                            @if ($errors->has('qty'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('qty') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="medida">Medida</label>
                            <select name="medida" class="form-control">
                                <option value="gr" {{ old('medida') == 'gramos' ? 'selected' : '' }}>Gramos</option>
                                <option value="kg" {{ old('medida') == 'kilogramos' ? 'selected' : '' }}>Kilogramos
                                </option>
                            </select>
                            @if ($errors->has('medida'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('medida') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="">Imagen</label>
                        <input type="file" id="image" name="image" class="form-control">
                        @if ($errors->has('image'))
                            <span class="error text-danger" for="input-name">{{ $errors->first('image') }}</span>
                        @endif
                        <img id="preview" width="200" height="200"
                            src="{{ Storage::url('uploads/productos/' . $producto->image) }}" alt=" ">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="checkbox" name="status" {{ $producto->status == 1 ? 'checked' : '' }}
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Popular</label>
                            <input type="checkbox" name="trending" {{ $producto->trending == 1 ? 'checked' : '' }}
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        @foreach ($productoIngredientes as $index => $prodIng)
                            <div class="form-group d-flex align-items-end">
                                <div class="col-md-3">
                                    <label>Ingrediente</label>
                                    <select class="form-control" name="ingrediente{{ $index + 1 }}">
                                        @foreach ($ingredientes as $ingrediente)
                                            <option value="{{ $ingrediente->id }}"
                                                @if ($prodIng->id_ingrediente == $ingrediente->id) selected @endif>{{ $ingrediente->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Cantidad</label>
                                    <input class="form-control" type="number" name="cantidad{{ $index + 1 }}"
                                        value="{{ $prodIng->cantidad / $producto->qty }}">
                                </div>
                                <div class="col-md-3 d-flex align-items-bottom">
                                    <button type="button"
                                        class="btn btn-danger btn-eliminar-ingrediente">Eliminar</button>
                                </div>
                            </div>
                        @endforeach

                        <div id="ingredientes-extra"></div>

                    </div>
                    <button type="button" class="btn btn-dark" id="agregar-ingrediente">Agregar ingrediente</button>


                </div>


                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Editar</button>
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

        input.addEventListener('change', () => {
            const file = input.files[0];
            const reader = new FileReader();

            reader.addEventListener('load', () => {
                preview.setAttribute('src', reader.result);
            });

            reader.readAsDataURL(file);
        });

        let ingredienteCount =
            {{ $productoIngredientes->count() }}; // Inicializa con la cantidad de registros existentes en la tabla Registros + 1
        document.getElementById('agregar-ingrediente').addEventListener('click', function() {
            ingredienteCount++;
            const div = document.createElement('div');
            div.innerHTML = `
        <div class="form-group d-flex">
            <div class="col-md-3">
                <label for="ingrediente${ingredienteCount}">Ingrediente ${ingredienteCount}</label>
                <select class="form-control" name="ingrediente${ingredienteCount}" id="ingrediente${ingredienteCount}">
                    @foreach ($ingredientes as $ingrediente)
                        <option value="{{ $ingrediente->id }}">{{ $ingrediente->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="ingrediente${ingredienteCount}">Cantidad </label>
                <input class="form-control" type="number" name="cantidad${ingredienteCount}" id="cantidad${ingredienteCount}" value="1">
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

        const btnEliminarIngredientes = document.querySelectorAll('.btn-eliminar-ingrediente');
        btnEliminarIngredientes.forEach(function(btnEliminar) {
            btnEliminar.addEventListener('click', function() {
                const div = btnEliminar.closest('.form-group');
                if (div) {
                    div.remove();
                }
            });
        });
    </script>
@endsection
