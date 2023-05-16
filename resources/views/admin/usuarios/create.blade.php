@extends('layouts.admin')
@section('title')
Usuarios | {{ $sitio }}
@endsection
@section('content')

<div class="py-3 mb-1 border-bottom border-top">
    <div class="container ml-3">
        <h6 class="mb-0">
            <a href="{{ url('dashboard') }}">Inicio</a> / 
            <a href="{{ url('usuarios') }}">Usuarios</a> /
            <a href="{{ url('add-usuario') }}">Crear Usuario</a>
        </h6>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4>Registrar Usuario</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-usuario') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" name="name" class="form-control" placeholder="John doe">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="correo">Correo</label>
                      <input type="text" name="email" class="form-control" placeholder="Johndoe@gmail.com">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="role">Rol</label>
                      <select name="role" class="form-control">
                        <option value="">Seleccionar rol</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                      </select>
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