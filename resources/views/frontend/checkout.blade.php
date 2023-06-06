@extends('layouts.front')
@section('title')
    Checkout | {{ $sitio }}
@endsection
@section('content')

    <div class="py-1 mb-4 shadow-sm border-top" style="background-color: {{ $color_secundario }}">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">Inicio</a> /
                <a href="{{ url('/carrito') }}">Mi Carrito</a>/
                <a href="{{ url('/checkout') }}">Checkout</a>
            </h6>
        </div>
    </div>

    <div class="container">
        <form action="{{ url('iniciar_compra') }}" method="POST">
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
                                    <input type="text" name="fname"
                                        value="{{ Auth::check() ? Auth::user()->fname : '' }}" class="fname form-control"
                                        placeholder="Juan" value="{{ old('fname') }}">
                                    @if ($errors->has('fname'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('fname') }}</span>
                                    @endif
                                    <span style="color:red" id="fname_error"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName">Apellido</label>
                                    <input type="text" name="lname"
                                        value="{{ Auth::check() ? Auth::user()->lname : '' }}" class="lname form-control"
                                        placeholder="Aguirre" value="{{ old('lname') }}">
                                    @if ($errors->has('lname'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('lname') }}</span>
                                    @endif
                                    <span style="color:red" id="lname_error"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email"
                                        value="{{ Auth::check() ? Auth::user()->email : '' }}" class="email form-control"
                                        placeholder="email@gmail.com" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('email') }}</span>
                                    @endif
                                    <span style="color:red" id="email_error"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Numero de teléfono</label>
                                    <input type="text" name="telefono"
                                        value="{{ Auth::check() ? Auth::user()->telefono : '' }}"
                                        class="phone form-control" placeholder="9 12345678" value="{{ old('telefono') }}">
                                    @if ($errors->has('telefono'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('telefono') }}</span>
                                    @endif
                                    <span style="color:red" id="phone_error"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Dirección 1</label>
                                    <input type="text" name="direccion1"
                                        value="{{ Auth::check() ? Auth::user()->direccion1 : '' }}"
                                        class="direccion1 form-control" placeholder="Calle fantasia 123"
                                        value="{{ old('direccion1') }}">
                                    @if ($errors->has('direccion1'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('dirrecion1') }}</span>
                                    @endif
                                    <span style="color:red" id="direccion1_error"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Direccion 2</label>
                                    <input type="text" name="direccion2"
                                        value="{{ Auth::check() ? Auth::user()->direccion2 : '' }}"
                                        class="direccion2 form-control" placeholder="Calle fantasia 123"
                                        value="{{ old('direccion2') }}">
                                    @if ($errors->has('direccion2'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('dirrecion2') }}</span>
                                    @endif
                                    <span style="color:red" id="direccion2_error"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Región</label>
                                    <input type="text" name="region"
                                        value="{{ Auth::check() ? Auth::user()->region : '' }}" class="region form-control"
                                        placeholder="Metropolitana" value="{{ old('region') }}">
                                    @if ($errors->has('region'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('region') }}</span>
                                    @endif
                                    <span style="color:red" id="region_error"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Ciudad</label>
                                    <input type="text" name="ciudad"
                                        value="{{ Auth::check() ? Auth::user()->ciudad : '' }}"
                                        class="ciudad form-control" placeholder="Metropolitana"
                                        value="{{ old('ciudad') }}">
                                    @if ($errors->has('ciudad'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('ciudad') }}</span>
                                    @endif
                                    <span style="color:red" id="ciudad_error"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Comuna</label>
                                    <input type="text" name="comuna"
                                        value="{{ Auth::check() ? Auth::user()->comuna : '' }}"
                                        class="comuna form-control" placeholder="Providencia"
                                        value="{{ old('comuna') }}">
                                    @if ($errors->has('comuna'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('comuna') }}</span>
                                    @endif
                                    <span style="color:red" id="comuna_error"></span>
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
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->prod_qty }}</td>
                                                <td>{{ $item->products->selling_price * $item->prod_qty }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                <button style="width: 100%;" class="btn btn-primary pagoBtn">Ir al pago</button>
                                {{-- <button id="payButton" onclick="pay()">Pagar</button> --}}

                            </div>
                        @else
                            <div class="card-body text-center">
                                <h2>No hay productos añadidos al carrito <i class="fa fa-shopping-cart"
                                        aria-hidden="true"></i></h2>
                                <a href="{{ url('/') }}" class="btn btn-outline-primary">Continua comprando</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
