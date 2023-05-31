@extends('layouts.admin')
@section('title')
    Registros | {{ $sitio }}
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%; flex-wrap:wrap">
                <h2>Editar registros</h2>
                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a class="mr-1" href="{{ url('dashboard') }}">Inicio</a> /
                    <a class="mr-1 ml-1" href="{{ url('registros') }}">Registros</a> /
                    <a class="mr-1 ml-1" href="{{ url('edit-reg/' . $registro->id) }}">Editar registro</a>
                </h6>
            </div>
            <form action="{{ url('update-reg/' . $registro->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" name="fecha" value="{{ $registro->fecha }}" class="form-control">
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
                                @foreach ($proveedores as $prov)
                                    <option value="{{ $prov->id }}"
                                        {{ $prov->id == $registro->id_proveedor ? 'selected' : '' }}>{{ $prov->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_proveedor'))
                                <span class="error text-danger"
                                    for="input-name">{{ $errors->first('id_proveedor') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Ingredientes</label>
                            <select name="id_ingrediente" class="form-control"id="">
                                <option value="">Selecciona el ingrediente.</option>
                                @foreach ($ingredientes as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $registro->id_ingrediente ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
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
                            <input type="number" name="cantidad" value="{{ $registro->cantidad }}" class="form-control">
                            @if ($errors->has('cantidad'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('cantidad') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="medida">Medida</label>
                            <select name="medida" class="form-control">
                                <option value="gr" {{ old('medida') == 'gramos' ? 'selected' : '' }}>Gramos</option>
                                <option value="kg" {{ old('medida') == 'kilogramos' ? 'selected' : '' }}>Kilogramos
                                </option>
                            </select>
                            @if ($errors->has('medida'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('medida') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="">Factura</label>
                        <input type="file" id="factura" name="factura" class="form-control">
                        @if ($errors->has('factura'))
                            <span class="error text-danger" for="input-name">{{ $errors->first('factura') }}</span>
                        @endif
                        <img id="preview" width="200" height="200"
                            src="{{ Storage::url('uploads/facturas/' . $registro->factura) }}" alt=" ">
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
