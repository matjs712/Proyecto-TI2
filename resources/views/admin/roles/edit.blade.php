@extends('layouts.admin')
@section('title')
Roles | {{ $sitio }}
@endsection
@section('content')
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