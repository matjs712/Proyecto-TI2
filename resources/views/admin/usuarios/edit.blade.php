@extends('layouts.admin')
@section('title')
Usuarios | {{ $sitio }}
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="h5">Nombre</p>
                        <input type="text" value="{{ $user->name }}" class="form-control">
                    </div>  
                    <div class="form-group">
                        <h5>Rol</h5>
                        {!!  Form::model($user, ['route' => ['usuarios.update', $user], 'method'=> 'put' ]) !!}
                        @foreach ($roles as $rol)
                            <div>
                                <label>
                                    {!! Form::checkbox('roles[]', $rol->id, null, ['class'=>'mr-1']) !!}
                                    {{ $rol->name }}
                                    {{-- {{ $rol->name }} --}}
                                </label>
                            </div>
                        @endforeach
                        {!! Form::submit('Asignar rol',['class'=>'btn btn-primary mt-2']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection