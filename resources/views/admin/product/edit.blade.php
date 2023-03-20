@extends('layouts.admin')
@section('title', 'Productos')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Editar Producto</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('update-prod/'.$producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Categoría</label>
                      <select name="categoria" class="form-control"id="">
                        <option value="">Selecciona la categoría.</option>
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ ($cat->id === $producto->cate_id) ? 'selected':'' }} >{{ $cat->name }}</option>                            
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nombre Producto</label>
                      <input type="text" name="name" value="{{ $producto->name }}" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Slug</label>
                      <input type="text" name="slug" value="{{ $producto->slug }}" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="slug">Descripción pequeña</label>
                      <input type="text" name="small_description" value="{{ $producto->small_description }}" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="descripcion">Descripción</label>
                      <textarea type="text" rows="5" style="resize:none;" name="description" class="form-control" placeholder="Categoría dedicada solo a peloras de ...">{{ $producto->description }}</textarea>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Precio</label>
                      <input type="number" name="price" value="{{ $producto->original_price }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Precio en oferta</label>
                      <input type="number" name="selling_price" value="{{ $producto->selling_price }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Cantidad</label>
                      <input type="number" name="qty" value="{{ $producto->qty }}" class="form-control">
                    </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="popular">Tax</label>
                    <input type="number" name="tax" value="{{ $producto->tax }}" class="form-control">
                  </div>
              </div>
              @if ($producto->image)
                    <img src="{{ asset('assets/uploads/productos/'.$producto->image) }}" width="300" alt="imagen-producto">
                @endif
                <div class="col-md-12 mb-4">
                  <label for="">Imagen</label>
                    <input type="file" name="image"  class="form-control">
                </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="checkbox" name="status" {{ $producto->status == 1 ? "checked":"" }} class="form-control">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="estado">Popular</label>
                    <input type="checkbox" name="trending" {{ $producto->trending == 1 ? "checked":"" }} class="form-control">
                  </div>
              </div>
                
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="estado">Meta titulo</label>
                    <input type="text" name="meta_title" value="{{ $producto->meta_title }}" class="form-control">
                  </div>
              </div>
                
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="estado">Meta descripción</label>
                    <input type="text" name="meta_description" value="{{ $producto->meta_description }}" class="form-control">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="estado">Meta palabras claves</label>
                    <input type="text" name="meta_keywords" value="{{ $producto->meta_keywords }}" class="form-control">
                  </div>
              </div>
                
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection