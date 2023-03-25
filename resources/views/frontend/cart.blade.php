@extends('layouts.front')
@section('title')
Mi Carrito
@endsection
@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">Inicio</a> / 
            <a href="{{ url('/carrito') }}">Mi Carrito</a>
        </h6>
    </div>
</div>


    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body">
                @php $total = 0; @endphp
                @foreach ($cartItems as $item)
                    <div class="row prod_data my-4">
                        <div class="col-md-2">
                            <img width="100" src="{{ asset('assets/uploads/productos/'.$item->products->image) }}" alt="{{ $item->products->name }}">
                        </div>
                        <div class="col-md-3">
                            <h6><b>{{ $item->products->name }}</b></h6>
                        </div>
                        <div class="col-md-2">
                            <h6><b>${{ $item->products->selling_price }}</b></h6>
                        </div>
                        <div class="col-md-3">
                            <input hidden class="prod_id" type="text" value="{{ $item->prod_id }}">
                            <label for="qty">Cantidad</label>
                            <div class="input-group text-center mb-3" style="width:130px;">
                                <button class="input-group-text changeQuantity decrement-btn">-</button>
                                <input type="text" name="qty" class="form-control qty-input text-center" value="{{ $item->prod_qty }}">
                                <button class="input-group-text changeQuantity increment-btn">+</button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger delete-cart-item"><i class="fa fa-trash"></i> Remover</button>
                        </div>
                    </div>    
                    @php $total += $item->products->selling_price * $item->prod_qty; @endphp
                @endforeach
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <h6>Total: {{ $total }}</h6>
                <button class="btn btn-outline-success">Seguir al Checkout</button>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
@endsection