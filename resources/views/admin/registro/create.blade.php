@extends('layouts.admin')
@section('title')
Registros | {{ $sitio }}
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h4>Añadir Proveedor</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-registro') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Fecha</label>
                      <input type="date" name="fecha" class="form-control">
                    </div>
                  </div>
                  
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Proveedor</label>
                      <select name="id_proveedor" class="form-control"id="">
                        <option value="">Selecciona el proveedor.</option>
                        @foreach ($proveedores as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>                            
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Ingredientes</label>
                      <select name="id_ingrediente" class="form-control"id="">
                        <option value="">Selecciona el ingrediente.</option>
                        @foreach ($ingredientes as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>                            
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Cantidad</label>
                      <input type="number" name="cantidad" class="form-control">
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