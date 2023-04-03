@extends('layouts.front')
@section('title')
{{ $categoria->name }} | {{ $sitio }}
@endsection
@section('content')
    <div class="container pt-5">
        <h2>Todos los {{ $categoria->name }}</h2>
        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-md-3">
                    <a href="{{ url('categorias/'.$categoria->slug.'/'.$producto->slug) }}">
                        <div class="card text-left">
                            <img class="card-img-top" style="object-fit: cover" height="200" src="{{ asset('assets/uploads/productos/'.$producto->image) }}" alt="">
                            <div class="card-body">
                                <h4 class="card-title">{{ $producto->name }}</h4>
                                <span class="float-start">${{ $producto->selling_price }}</span>
                                <span class="float-end"><s>${{ $producto->original_price }}</s></span>
                            </div>
                            </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
 @endsection
