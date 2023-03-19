@extends('layouts.admin')
@section('title', 'Autos')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Añadir Auto</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-auto') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nombre Auto</label>
                      <input type="text" name="name" class="form-control" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="model">Modelo</label>
                      <input type="text" name="model" class="form-control" placeholder="Modelo">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="brand">Marca</label>
                      <input type="text" name="brand" class="form-control" placeholder="Marca">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="descripcion">Descripción</label>
                      <textarea type="text" rows="5" style="resize:none;" name="description" class="form-control" placeholder="Estado o detalles del vehiculo"></textarea>
                    </div>
                </div>
                
                <div class="col-md-12 mb-4">
                  <label for="">Imagen</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection