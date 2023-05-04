@extends('layouts.admin')
@section('title')
Roles | {{ $sitio }}
@endsection
@section('content')

<div class="py-3 mb-1 border-bottom border-top">
    <div class="container ml-3">
        <h6 class="mb-0">
            <a href="{{ url('dashboard') }}">Inicio</a> / 
            <a href="{{ url('roles') }}">Roles & Permisos</a> /
            <a href="{{ url('roles/'.$rol->id.'/edit') }}">Editar Roles & Permisos</a>
        </h6>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5>Editar rol <b class="h3">{{$rol->name }}</b></h5>
        <div class="row">
            <div class="col-md-6">
                {!! Form::model($rol, ['route'=>['roles.update',$rol], 'method'=>'PUT']) !!}
                    @include('admin.roles.partials.form')
                    {!! Form::submit('Editar Rol',['class'=>'btn btn-primary mt-4']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection