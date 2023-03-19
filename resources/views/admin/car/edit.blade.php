@extends('layouts.admin')
@section('title', 'Autos')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Editar Auto</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('update-auto/'.$cars->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nombre Auto</label>
                      <input type="text" name="name" value="{{ $cars->name }}" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="model">Modelo</label>
                      <input type="text" name="model" value="{{ $cars->model }}" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="brand">Marca</label>
                      <input type="text" name="brand" value="{{ $cars->brand }}" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="descripcion">Descripción</label>
                      <textarea type="text" rows="5" style="resize:none;" name="description" class="form-control" placeholder="">{{ $cars->description }}</textarea>
                    </div>
                </div>
                
                @if ($cars->image)
                    <img src="{{ asset('assets/uploads/cars/'.$cars->image) }}" width="300" alt="imagen-car">
                @endif
                <div class="col-md-12 mt-2 mb-4">
                    <label for="image">Imagen</label>
                    <input type="file" name="image" class="form-control">
                </div>
                
                
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection