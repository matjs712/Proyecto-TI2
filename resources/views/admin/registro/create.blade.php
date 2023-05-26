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
                <a href="{{ url('crear-registro') }}">Crear registro</a>
            </h6>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Añadir Registro</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('insert-registro') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}">
                            @if ($errors->has('fecha'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('fecha') }}</span>
                            @endif
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
                            @if ($errors->has('id_proveedor'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('id_proveedor') }}</span>
                            @endif
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
                            @if ($errors->has('id_ingrediente'))
                                <span class="error text-danger"
                                    for="input-name">{{ $errors->first('id_ingrediente') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Cantidad</label>
                            <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad') }}">
                            @if ($errors->has('cantidad'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('cantidad') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label for="">Facturas</label>
                        {{-- <input type="file" name="image" class="form-control"> --}}
                        <input type="file" id="factura" name="factura" class="form-control">
                        @if ($errors->has('factura'))
                            <span class="error text-danger" for="input-name">{{ $errors->first('factura') }}</span>
                        @endif
                        <img id="preview" width="200" height="200" src="" alt=" ">
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection