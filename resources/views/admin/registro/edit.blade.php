@extends('layouts.admin')
@section('title')
Registros | {{ $sitio }}
@endsection
@section('content')

<div class="py-3 mb-1 border-bottom border-top">
    <div class="container ml-3">
        <h6 class="mb-0">
            <a href="{{ url('dashboard') }}">Inicio</a> / 
            <a href="{{ url('registros') }}">Registros</a> /
            <a href="{{ url('edit-reg/'.$registro->id) }}">Editar registro</a>
        </h6>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4>Editar Registros</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('update-reg/'.$registro->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Fecha</label>
                      <input type="date" name="fecha" value="{{ $registro->fecha }}" class="form-control">
                    </div>
                  </div>
                  
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Proveedor</label>
                      <select name="id_proveedor" class="form-control"id="">
                        <option value="">Selecciona el proveedor.</option>
                        @foreach ($proveedores as $prov)
                            <option value="{{ $prov->id }}" {{ ($prov->id == $registro->id_proveedor) ? 'selected':'' }} >{{ $prov->name }}</option>                            
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
                            <option value="{{ $item->id }}" {{ ($item->id == $registro->id_ingrediente) ? 'selected':'' }}>{{ $item->name }}</option>                            
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Cantidad</label>
                      <input type="number" name="cantidad" value="{{ $registro->cantidad }}" class="form-control">
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