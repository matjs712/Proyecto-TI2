@extends('layouts.admin')
@section('title')
Usuarios | {{ $sitio }}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalles del usuario</h4>
                        <a class="btn btn-primary" href="{{ url('usuarios') }}"><i class="fa fa-backward" aria-hidden="true"></i> Volver</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label>Rol</label>
                                <div class="p-2 border">
                                    @if ($usuario->role_as == '0')
                                        <span>Usuario</span>
                                        @elseif ($usuario->role_as == '1')
                                            <span>Administrador</span>
                                        @elseif ($usuario->role_as == '2')
                                            <span>Nutricionista</span>
                                        @elseif ($usuario->role_as == '3')
                                            <span>Chef</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>Nombre</label>
                                <div class="p-2 border">{{ $usuario->name }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>Apellido</label>
                                <div class="p-2 border">{{ $usuario->lname }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>Email</label>
                                <div class="p-2 border">{{ $usuario->email }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>Teléfono</label>
                                <div class="p-2 border">{{ $usuario->telefono }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>Dirección 1</label>
                                <div class="p-2 border">{{ $usuario->direccion1 }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>Dirección 2</label>
                                <div class="p-2 border">{{ $usuario->direccion2 }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>Región</label>
                                <div class="p-2 border">{{ $usuario->region }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>Ciudad</label>
                                <div class="p-2 border">{{ $usuario->ciudad }}</div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>Comuna</label>
                                <div class="p-2 border">{{ $usuario->comuna }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection