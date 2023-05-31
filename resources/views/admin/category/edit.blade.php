@extends('layouts.admin')
@section('title')
    Categorias | {{ $sitio }}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%; flex-wrap:wrap">
                <h2>Categorías</h2>
                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a href="{{ url('dashboard') }}" class="mr-1">Inicio</a> /
                    <a href="{{ url('categorias') }}" class="mx-1">Categorías</a> /
                    <a href="#" class="ml-2">Editar categoría</a>
                </h6>
            </div>
            <form action="{{ url('update-cat/' . $categoria->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre Categoría</label>
                            <input type="text" name="name" value="{{ $categoria->name }}" class="form-control"
                                placeholder="Poleras">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ $categoria->slug }}" class="form-control"
                                placeholder="Poleras">
                            @error('slug')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea type="text" rows="5" style="resize:none;" name="description" class="form-control"
                                placeholder="Categoría dedicada solo a peloras de ...">{{ $categoria->description }}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8 mt-2 mb-4">
                        <label for="image">Imagen</label>
                        <input type="file" id="image" name="image" class="form-control">
                        <img id="preview" width="200" height="200"
                            src="{{ Storage::url('uploads/categorias/' . $categoria->image) }}" alt=" ">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="popular">Popular</label>
                            <input type="checkbox" name="popular" {{ $categoria->popular == 1 ? 'checked' : '' }}
                                class="form-control">
                            @error('popular')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="checkbox" name="status" {{ $categoria->status == 1 ? 'checked' : '' }}
                                class="form-control">
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
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
    </script>
@endsection
