@extends('layouts.admin')
@section('title')
Proveedores | {{ $sitio }}
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h4>Añadir Proveedor</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-proveedor') }}" method="POST" enctype="multipart/form-data">
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
                      <label for="">Teléfono</label>
                      <input type="text" name="telefono" class="form-control" placeholder="9 12345678">
                    </div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="text" name="email" class="form-control" placeholder="proveedor@gmail.com">
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