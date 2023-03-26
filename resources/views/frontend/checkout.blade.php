@extends('layouts.front')
@section('title')
Checkout
@endsection
@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">Inicio</a> / 
            <a href="{{ url('/carrito') }}">Mi Carrito</a>/
            <a href="{{ url('/checkout') }}">Checkout</a>
        </h6>
    </div>
</div>



    <div class="container">
        <form action="{{ url('place-order') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Detalles</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="firstName">Primer nombre</label>
                                    <input type="text" name="fname" value="{{ Auth::user()->name }}" class="form-control" placeholder="Juan">
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName">Apellido</label>
                                    <input type="text" name="lname" value="{{ Auth::user()->lname }}" class="form-control" placeholder="Aguirre">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="email@gmail.com">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Numero de teléfono</label>
                                    <input type="text" name="telefono" value="{{ Auth::user()->telefono }}" class="form-control" placeholder="9 12345678">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Dirección 1</label>
                                    <input type="text" name="direccion1" value="{{ Auth::user()->direccion1 }}" class="form-control" placeholder="Calle fantasia 123">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Direccion 2</label>
                                    <input type="text" name="direccion2" value="{{ Auth::user()->direccion2 }}" class="form-control" placeholder="Calle fantasia 123">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Región</label>
                                    <input type="text" name="region" value="{{ Auth::user()->region }}" class="form-control" placeholder="Metropolitana">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Ciudad</label>
                                    <input type="text" name="ciudad" value="{{ Auth::user()->ciudad }}" class="form-control" placeholder="Metropolitana">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Comuna</label>
                                    <input type="text" name="comuna" value="{{ Auth::user()->comuna }}" class="form-control" placeholder="Providencia">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        @if ($cartItems->count() > 0)
                            <div class="card-body">
                                <h6>Detalles de la orden</h6>
                                <hr>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Porducto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->prod_qty }}</td>
                                                <td>{{ ($item->products->selling_price)*($item->prod_qty) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                <button style="width: 100%;" class="btn btn-primary">Realizar orden</button>
                            </div>
                            @else
                            <div class="card-body text-center">
                                <h2>No hay productos añadidos al carrito <i class="fa fa-shopping-cart" aria-hidden="true"></i></h2>
                                <a href="{{ url('/') }}" class="btn btn-outline-primary">Continua comprando</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection