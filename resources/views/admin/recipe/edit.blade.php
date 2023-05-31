@extends('layouts.admin')
@section('title')
    Recetas | {{ $sitio }}
@endsection

@section('content')
    <div class="py-3 mb-1 border-bottom border-top">
        <div class="container ml-3">
            <h6 class="mb-0">
                <a href="{{ url('dashboard') }}">Inicio</a> /
                <a href="{{ url('recetas') }}">Recetas</a> /
                <a href="{{ url('edit-receta/' . $receta->id) }}">Editar receta</a>
            </h6>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Editar Receta</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('update-receta/' . $receta->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre Receta</label>
                            <input type="text" name="name" value="{{ $receta->name }}" class="form-control"
                                placeholder="Sal">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ $receta->slug }}" class="form-control"
                                placeholder="Sal">
                            @error('slug')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea type="text" rows="5" style="resize:none;" name="description" class="form-control"
                                placeholder="Descripcion ded la receta ...">{{ $receta->description }}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
