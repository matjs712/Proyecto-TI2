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
                <a href="{{ url('edit-ing/' . $ingrediente->id) }}">Editar ingredientes</a>
            </h6>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Editar Ingrediente</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('update-ing/' . $ingrediente->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" value="{{ $ingrediente->name }}" class="form-control"
                                placeholder="Poleras">
                            @if ($errors->has('name'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Cantidad</label>
                            <input type="number" name="cantidad" value="{{ $ingrediente->cantidad }}" class="form-control">
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
                                <option value="kg" {{ old('medida') == 'kilogramos' ? 'selected' : '' }}>Kilogramos</option>
                            </select>
                            @if ($errors->has('medida'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('medida') }}</span>
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
