<div class="form-group">
    {!! Form::label('name','Nombre') !!}
    {!! Form::text('name',null, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre']) !!}
</div>
</div>
<div class="col-md-12">
{!! Form::label('name','Lista de permisos') !!}
<div class="d-flex flex-wrap">
    @foreach ($permissions as $permission )
        <div class="col-md-2 mb-1">
            {!! Form::checkbox('permissions[]', $permission->id, null,['class'=>'mr-1']) !!}
        {{ $permission->description }}
        </div>
    @endforeach
</div>
</div>