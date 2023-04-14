@extends('layouts.admin')
@section('title')
Roles | {{ $sitio }}
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                {!! Form::open(['route'=>'roles.store']) !!}
                   @include('admin.roles.partials.form')
                    {!! Form::submit('Crear Rol',['class'=>'btn btn-primary mt-4']) !!}
                {!! Form::close() !!}
        </div>
    </div>
</div>


@endsection