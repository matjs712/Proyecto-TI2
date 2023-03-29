@extends('layouts.admin')
@section('title', 'Proveedores')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Editar Proveedor</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('update-prov/'.$proveedor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" name="name" value="{{ $proveedor->name }}" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Teléfono</label>
                      <input type="text" name="telefono" value="{{ $proveedor->telefono }}" class="form-control" placeholder="9 12345678">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Email</label>
                      <input type="text" name="email" value="{{ $proveedor->email }}" class="form-control" placeholder="proveedor@gmail.com">
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