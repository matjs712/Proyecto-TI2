@extends('layouts.front')
@section('title')
{{ $producto->name }}
@endsection
@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">Inicio</a> / 
            <a href="{{ url('ver-categoria/'.$producto->category->slug) }}">{{ $producto->category->name }}</a> / 
            <a href="{{ url('categorias/'.$producto->category->slug.'/'.$producto->slug) }}">{{ $producto->name }}</a>
        </h6>
    </div>
</div>

<div class="container">
    <div class="card shadow prod_data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img style="width: 100%;" src="{{ asset('assets/uploads/productos/'.$producto->image) }}" alt="{{ $producto->name }}">
                </div>
                <div class="col-md-8">
                    <h2 class="mb-0 d-flex justify-content-between align-items-center">
                        <span>{{ $producto->name }}</span>
                        @if ( $producto->trending == '1' )
                            <label style="font-size: 16px;" class="text-white float-end badge bg-danger trending_tag">Tendencia</label>
                        @endif
                    </h2>
                    <hr>
                    <label style="mb-3">Precio original: <s>${{ $producto->original_price }}</s></label>
                    <label style="fw-bold"><strong>Oferta: ${{ $producto->selling_price }}</strong></label>
                    <p class="mt-3">
                        {!! $producto->small_description !!}
                    </p>
                    <hr>
                    @if ($producto->qty > 0)
                        <label class="badge bg-success text-white">En stock</label>
                        @else
                        <label class="badge bg-danger  text-white">Sin stock</label>
                    @endif
                    <div class="row mt-2 align-items-center">
                        <div class="col-md-3">
                            <input type="hidden" value="{{ $producto->id }}" class="prod_id">
                            <label for="qty">Cantidad</label>
                            <div class="input-group text-center">
                                <button class="input-group-text decrement-btn">-</button>
                                <input type="text" name="qty" value="1" class="form-control qty-input">
                                <button class="input-group-text increment-btn">+</button>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <br>
                            <button class="btn btn-success me-3 float-start"><i class="fa-regular fa-heart"></i> Añadir a la lista</button>
                            @if ($producto->qty > 0)
                            <button class="btn btn-primary me-3 float-start addCartBtn"><i class="fa fa-cart-plus" aria-hidden="true"></i> Añadir al carrito</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection