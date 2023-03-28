@extends('layouts.admin')
@section('title', 'Ingrediente')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Editar Ingrediente</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('update-ing/'.$ingrediente->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" name="name" value="{{ $ingrediente->name }}" class="form-control" placeholder="Poleras">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="">Cantidad</label>
                      <input type="number" name="cantidad" value="{{ $ingrediente->cantidad }}" class="form-control">
                    </div>
                </div>
                
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection