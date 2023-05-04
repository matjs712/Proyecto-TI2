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
            <a href="{{ url('edit-cat/'.$categoria->id) }}">Editar categoria</a>
        </h6>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4>Editar Categoría</h4>
    </div>
    <div class="card-body">
      <form action="{{ url('update-cat/'.$categoria->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Nombre Categoría</label>
              <input type="text" name="name" value="{{ $categoria->name }}" class="form-control" placeholder="Poleras">
              @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" name="slug" value="{{ $categoria->slug }}" class="form-control" placeholder="Poleras">
              @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <textarea type="text" rows="5" style="resize:none;" name="description" class="form-control" placeholder="Categoría dedicada solo a peloras de ...">{{ $categoria->description }}</textarea>
              @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-md-8 mt-2 mb-4">
            @if ($categoria->image)
              <div class="d-flex align-items-center flex-wrap">
                <img src="{{ Storage::url('uploads/categorias/'.$categoria->image) }}" width="300" alt="imagen-categoria">
              </div>
            @endif
            <label for="image">Imagen</label>
            <input type="file" id="image" name="image" class="form-control">
            <img id="preview" width="200" height="200" src="" alt=" ">
            @error('image')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="popular">Popular</label>
              <input type="checkbox" name="popular" {{ $categoria->popular == 1 ? "checked":"" }} class="form-control">
              @error('popular')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="estado">Estado</label>
              <input type="checkbox" name="status" {{ $categoria->status == 1 ? "checked":"" }} class="form-control">
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

  input.addEventListener('change', () => {
    const file = input.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', () => {
      preview.setAttribute('src', reader.result);
    });

    reader.readAsDataURL(file);
  });
</script>

@endsection