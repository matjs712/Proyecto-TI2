@extends('layouts.admin')
@section('title')
Categorias | {{ $sitio }}
@endsection

@section('content')

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
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="slug">Slug</label>
                      <input type="text" name="slug" value="{{ $categoria->slug }}" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="descripcion">Descripción</label>
                      <textarea type="text" rows="5" style="resize:none;" name="description" class="form-control" placeholder="Categoría dedicada solo a peloras de ...">{{ $categoria->description }}</textarea>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="">Meta titulo</label>
                      <input type="text" value="{{ $categoria->meta_title }}" name="meta_title" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="">Meta Palabras claves</label>
                      <input type="text" name="meta_keywords" value="{{ $categoria->meta_keywords }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="">Meta Descripción</label>
                      <input type="text" name="meta_description" value="{{ $categoria->meta_description }}" class="form-control">
                    </div>
                </div>
                @if ($categoria->image)
                    <img src="{{ asset('assets/uploads/categorias/'.$categoria->image) }}" width="300" alt="imagen-categoria">
                @endif
                <div class="col-md-12 mt-2 mb-4">
                    <label for="image">Imagen</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="popular">Popular</label>
                    <input type="checkbox" name="popular" {{ $categoria->popular == 1 ? "checked":"" }} class="form-control">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="checkbox" name="status" {{ $categoria->status == 1 ? "checked":"" }} class="form-control">
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