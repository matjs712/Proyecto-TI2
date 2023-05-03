@extends('layouts.admin')
@section('title')
Ingredientes | {{ $sitio }}
@endsection
@section('content')

<div class="py-3 mb-1 border-bottom border-top">
    <div class="container ml-3">
        <h6 class="mb-0">
            <a href="{{ url('dashboard') }}">Inicio</a> / 
            <a href="{{ url('ingredientes') }}">Ingredientes</a> /
            <a href="{{ url('crear-ingrediente') }}">Crear ingredientes</a>
        </h6>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4>Añadir Ingrediente</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-ingrediente') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" name="name" class="form-control" placeholder="Poleras">
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