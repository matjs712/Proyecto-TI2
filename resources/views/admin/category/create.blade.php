@extends('layouts.admin')
@section('title')
Categorias | {{ $sitio }}
@endsection

@section('content')

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
                      <input type="text" name="name" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="slug">Slug</label>
                      <input type="text" name="slug" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="descripcion">Descripción</label>
                      <textarea type="text" rows="5" style="resize:none;" name="description" class="form-control" placeholder="Categoría dedicada solo a peloras de ..."></textarea>
                    </div>
                </div>
                {{-- <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="">Meta titulo</label>
                      <input type="text" name="meta_title" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="">Meta Palabras claves</label>
                      <input type="text" name="meta_keywords" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <label for="">Meta Descripción</label>
                      <input type="text" name="meta_description" class="form-control">
                    </div>
                </div> --}}
                
                <div class="col-md-12 mb-4">
                  <label for="">Imagen</label>
                    <input type="file" id="image" name="image" class="form-control">
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
                    <label for="popular">Popular</label>
                    <input type="checkbox" name="popular" class="form-control">
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