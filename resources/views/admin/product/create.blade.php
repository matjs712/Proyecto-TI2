@extends('layouts.admin')
@section('title', 'Productos')

@section('content')

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
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nombre Producto</label>
                      <input type="text" name="name" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Slug</label>
                      <input type="text" name="slug" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="slug">Descripción pequeña</label>
                      <input type="text" name="small_description" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="descripcion">Descripción</label>
                      <textarea type="text" rows="5" style="resize:none;" name="description" class="form-control" placeholder="Categoría dedicada solo a peloras de ..."></textarea>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Precio</label>
                      <input type="number" name="price" class="form-control">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Precio en oferta</label>
                      <input type="number" name="selling_price" class="form-control">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Cantidad</label>
                      <input type="number" name="qty" class="form-control">
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
                    <input type="file" name="image" class="form-control">
                </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="estado">Estado</label>
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
                  <div class="form-group d-flex">
                    <div class="col-md-3">
                      <label for="ingrediente1">Ingrediente 1</label>
                      <select class="form-control" name="ingrediente1" id="ingrediente1">
                        <option value="">Seleccione un ingrediente</option>
                        @foreach($ingredientes as $ingrediente)
                        <option value="{{ $ingrediente->id }}">{{ $ingrediente->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="">Cantidad </label>
                      <input class="form-control" type="number" name="cantidad1" id="cantidad1" value="0">
                    </div>
                  </div>

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
  let ingredienteCount = 1;
  document.getElementById('agregar-ingrediente').addEventListener('click', function() {
      ingredienteCount++;
      const div = document.createElement('div');
      div.innerHTML = `
          <div class="form-group d-flex">
            <div class="col-md-3">
              <label for="ingrediente${ingredienteCount}">Ingrediente ${ingredienteCount}</label>
                <select class="form-control" name="ingrediente${ingredienteCount}" id="ingrediente${ingredienteCount}">
                  <option value="">Seleccione un ingrediente</option>
                    @foreach($ingredientes as $ingrediente)
                        <option value="{{ $ingrediente->id }}">{{ $ingrediente->name }}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label for="ingrediente${ingredienteCount}">Cantidad </label>
                <input class="form-control" type="number" name="cantidad${ingredienteCount}" id="cantidad${ingredienteCount}" value="0">
              </div>
          </div>
      `;
      document.getElementById('ingredientes-extra').appendChild(div);

  });
</script>
@endsection
