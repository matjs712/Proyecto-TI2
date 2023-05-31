@extends('layouts.admin')
@section('title')
    Proveedores | {{ $sitio }}
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%; flex-wrap:wrap">
                <h2>Editar proveedor</h2>
                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a class="mr-1" href="{{ url('dashboard') }}">Inicio</a> /
                    <a class="mr-1 ml-1" href="{{ url('proveedores') }}">Proveedores</a> /
                    <a class="mr-1 ml-1" href="{{ url('edit-prov/' . $proveedor->id) }}">Editar proveedor</a>
                </h6>
            </div>
            <form action="{{ url('update-prov/' . $proveedor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" value="{{ $proveedor->name }}" class="form-control"
                                placeholder="Poleras">
                            @if ($errors->has('name'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Teléfono</label>
                            <input type="text" name="telefono" value="{{ $proveedor->telefono }}" class="form-control"
                                placeholder="9 12345678">
                            @if ($errors->has('telefono'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('telefono') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" name="email" value="{{ $proveedor->email }}" class="form-control"
                                placeholder="proveedor@gmail.com">
                            @if ($errors->has('email'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('email') }}</span>
                            @endif
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
