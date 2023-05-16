@extends('layouts.admin')
@section('title')
Categorias | {{ $sitio }}
@endsection

@section('content')
<div class="py-3 mb-1 border-bottom border-top">
    <div class="container ml-3">
        <h6 class="mb-0">
            <a href="{{ url('dashboard') }}">Inicio</a> / 
            <a href="{{ url('categorias') }}">Categorias</a> /
            <a href="{{ url('crear-categoria') }}">Añadir categoria</a>
        </h6>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4>Añadir Categoría</h4>
    </div>
    <div class="card-body">
      <form action="{{ url('insert-category') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Nombre Categoría</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Poleras" value="{{ old('name') }}">
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="poleras" value="{{ old('slug') }}">
              @error('slug')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <textarea type="text" rows="5" style="resize:none;" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Categoría dedicada solo a peloras de ...">{{ old('description') }}</textarea>
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
              <input type="checkbox" name="status" class="form-control @error('status') is-invalid @enderror" {{ old('status') ? 'checked' : '' }}>
              @error('status')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="popular">Popular</label>
              <input type="checkbox" name="popular" class="form-control @error('popular') is-invalid @enderror" {{ old('popular') ? 'checked' : '' }}>
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