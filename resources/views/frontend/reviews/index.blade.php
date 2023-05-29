@extends('layouts.front')
@section('title')
    Reseñas | {{ $sitio }}
@endsection
@section('content')
    <div class="py-1 mb-4 shadow-sm border-top" style="background-color: {{ $color_secundario }}">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">Inicio</a> /
                <a href="{{ url('ver-categoria/' . $producto->category->slug) }}">{{ $producto->category->name }}</a> /
                <a href="{{ url('categorias/' . $producto->category->slug . '/' . $producto->slug) }}">{{ $producto->name }}</a>
            </h6>
        </div>
    </div>

    <div class="container"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    @if ($verified_purchase->count() > 0)
                        <h5>Estas escribiendo una Reseña del producto {{ $producto->name }}</h5>
                        <form action="{{ url('add-review') }}" class=" d-flex align-items-center flex-column"
                            method="POST">
                            @csrf
                            <div class="d-flex flex-column col-md-6">
                                <input type="hidden" name="product_id" value="{{ $producto->id }}">
                                <textarea name="user_review" rows="5" style="resize: none;" placeholder="Me encantó este producto!!"></textarea>
                                <button type="submit" class="mt-4 btn btn-success">Agregar reseña</button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger">
                            <h5>No estas autorizado para escribir una reseña de este producto</h5>
                            <p>Tienes que haber comprado este producto anteriormente.</p>
                            <a href="{{ url('/') }}" class="btn btn-success">Ir al inicio</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
