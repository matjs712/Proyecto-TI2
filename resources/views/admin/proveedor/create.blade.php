@extends('layouts.admin')
@section('title')
    Proveedores | {{ $sitio }}
@endsection
@section('content')
    <div class="py-3 mb-1 border-bottom border-top">
        <div class="container ml-3">
            <h6 class="mb-0">
                <a href="{{ url('dashboard') }}">Inicio</a> /
                <a href="{{ url('proveedores') }}">Proveedores</a> /
                <a href="{{ url('crear-proveedor') }}">Crear proveedor</a>
            </h6>
        </div>
    </div>

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
                            <input type="text" name="name" class="form-control" placeholder="Poleras"
                                value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="9 12345678"
                                value="{{ old('telefono') }}">
                            @if ($errors->has('telefono'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('telefono') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="proveedor@gmail.com"
                                value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('email') }}</span>
                            @endif
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
