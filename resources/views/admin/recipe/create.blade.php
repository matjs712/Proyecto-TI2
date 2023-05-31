@extends('layouts.admin')
@section('title')
    Recetas | {{ $sitio }}
@endsection

@section('content')
    <div class="py-3 mb-1 border-bottom border-top">
        <div class="container ml-3">
            <h6 class="mb-0">
                <a href="{{ url('dashboard') }}">Inicio</a> /
                <a href="{{ url('categorias') }}">Categorias</a> /
                <a href="{{ url('crear-receta') }}">Añadir receta</a>
            </h6>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Añadir Receta</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('insert-category') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre Receta</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="receta sal" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                                placeholder="poleras" value="{{ old('slug') }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea type="text" rows="5" style="resize:none;" name="description"
                                class="form-control @error('description') is-invalid @enderror" placeholder="descripcion de la receta...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
