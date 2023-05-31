@extends('layouts.admin')
@section('title')
    Recetas | {{ $sitio }}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%">
                <h2>Recetas</h2>
                <div class="container">
                    <h6 class="mb-0 d-flex align-items-center justify-content-end">
                        <a href="{{ url('dashboard') }}" class="mr-2">Inicio</a> /
                        <a href="{{ url('productos') }}" class="mx-2">Recetas</a> /
                        <a href="#" class="ml-2">Editar receta</a>
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
        @endsection
