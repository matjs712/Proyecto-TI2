@extends('layouts.front')
@section('title')
    Mi Carrito | {{ $sitio }}
@endsection
@section('content')
    <div class="py-3 shadow-sm border-top" style="background-color: {{ $color_secundario }}; opacity:.6">
        <div class="container" style="color:white">
            <h6 class="mb-0">
                <a class="text-white" href="{{ url('/') }}">Inicio</a> /
                <a class="text-white" href="{{ url('/carrito') }}">Mi Carrito</a>
            </h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow">
            @if ($cartItems->count() > 0)
                <div class="card-body">
                    @php $total = 0; @endphp
                    @foreach ($cartItems as $item)
                        <div class="row prod_data my-4">
                            <div class="col-md-2">
                                <img width="100" src="{{ Storage::url('uploads/productos/' . $item->products->image) }}"
                                    alt="{{ $item->products->name }}">
                            </div>
                            <div class="col-md-3">
                                <h6><b>{{ $item->products->name }}</b></h6>
                            </div>
                            <div class="col-md-2">
                                <h6><b>${{ $item->products->selling_price }}</b></h6>
                            </div>
                            <div class="col-md-3">
                                <input hidden class="prod_id" type="text" value="{{ $item->prod_id }}">
                                @if ($item->products->qty >= $item->prod_qty)
                                    <label for="qty">Cantidad</label>
                                    <div class="input-group text-center mb-3" style="width:130px;">
                                        <button class="input-group-text changeQuantity decrement-btn">-</button>
                                        <input type="text" name="qty" class="form-control qty-input text-center"
                                            value="{{ $item->prod_qty }}">
                                        <button class="input-group-text changeQuantity increment-btn">+</button>
                                    </div>
                                    @php $total += $item->products->selling_price * $item->prod_qty; @endphp
                                @else
                                    <h6>Fuera de stock</h6>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <button onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                    style="background-color: {{ $boton_eliminar }}; color:white;"
                                    class="btn delete-cart-item"><i class="fa fa-trash"></i> Remover</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <h6>Total: {{ $total }}</h6>
                    <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                        style="background-color: {{ $boton_principal_busqueda }}; color:white;"
                        href="{{ url('checkout') }}" class="btn">Seguir al Checkout</a>
                </div>
            @else
                <div class="card-body text-center">
                    <h2>Tu <i class="fa fa-shopping-cart" aria-hidden="true"></i> carrito esta vacio</h2>
                    <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                        href="{{ url('/') }}" class="btn btn-outline-primary">Continua comprando</a>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('after_scripts')
@endsection
