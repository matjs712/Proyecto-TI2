@extends('layouts.admin')
@section('title')
    Roles | {{ $sitio }}
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%; flex-wrap:wrap">
                <h2>Editar rol {{ $rol->name }}</h2>
                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a class="mr-1" href="{{ url('dashboard') }}">Inicio</a> /
                    <a class="mr-1 ml-1" href="{{ url('roles') }}">Roles & Permisos</a> /
                    <a class="mr-1 ml-1" href="{{ url('roles/' . $rol->id . '/edit') }}">Editar Roles & Permisos</a>
                </h6>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {!! Form::model($rol, ['route' => ['roles.update', $rol], 'method' => 'PUT']) !!}
                    @include('admin.roles.partials.form')
                    {!! Form::submit('Editar Rol', ['class' => 'btn btn-primary mt-4']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
