@extends('layouts.front')
@section('title')
Lista
@endsection
@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">Inicio</a> / 
            <a href="{{ url('/wishlist') }}">Lista</a>
        </h6>
    </div>
</div>


    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body">
                @if ($wishlist->count() > 0)
                <div class="row prod_data my-4">
                    @foreach ($wishlist as $item)
                            <div class="col-md-2">
                                <img width="100" src="{{ asset('assets/uploads/productos/'.$item->products->image) }}" alt="{{ $item->products->name }}">
                            </div>
                            <div class="col-md-2">
                                <h6><b>{{ $item->products->name }}</b></h6>
                            </div>
                            <div class="col-md-2">
                                <h6><b>${{ $item->products->selling_price }}</b></h6>
                            </div>
                            <div class="col-md-2">
                                <input hidden class="prod_id" type="text" value="{{ $item->prod_id }}">
                                @if ($item->products->qty >= $item->prod_qty)
                                    <h6>Disponible</h6>
                                    <input type="text" name="qty" class="form-control qty-input text-center" hidden value="1">
                                @else
                                <h6>Fuera de stock</h6>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success addCartBtn"><i class="fa fa-shopping-cart"></i>Añadir al carrito</button>
                            </div>   
                            <div class="col-md-2">
                                <button class="btn btn-danger remove-wishlist-item"><i class="fa fa-trash"></i> Remover</button>
                            </div>   
                    @endforeach
                </div>
                @else
                    <h2>La lista esta vacia  <i class="fa fa-shopping-cart" aria-hidden="true"></i> </h2>
                    <a href="{{ url('/') }}" class="btn btn-outline-primary">Continua comprando</a>
                @endif
            </div>
        </div>
    </div>
@endsection
