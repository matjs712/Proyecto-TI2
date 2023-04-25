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
                    </div>  
                    <div class="form-group">
                        {!!  Form::model($user, ['route' => ['usuarios.update', $user], 'method'=> 'put' ]) !!}
                        
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Nombre del usuario']) !!}
           
                            {!! Form::label('name', 'Email') !!}
                            {!! Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'correo@gmail.com']) !!}
           
                            {!! Form::label('name', 'Telefono') !!}
                            {!! Form::text('telefono', $user->telefono, ['class' => 'form-control', 'placeholder' => '9 53455123']) !!}
           
                            {!! Form::label('name', 'Rol') !!}
                                 {{-- @foreach ($roles as $rol) --}}
                                    <div>
                                        <label>
                                            {!! Form::select('role_id', $roles->pluck('name', 'id'), $user->roles->first()->id, ['class' => 'form-control', 'placeholder' => 'Seleccione un rol']) !!}
                                            {{-- {{ $rol->name }} --}}
                                            {{-- {{ $rol->name }} --}}
                                        </label>
                                    </div>
                                {{-- @endforeach --}}
                                
                            
                        {!! Form::submit('Modificar',['class'=>'btn btn-primary mt-2']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection