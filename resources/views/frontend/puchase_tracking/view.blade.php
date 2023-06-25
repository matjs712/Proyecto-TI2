@extends('layouts.front')
@section('title')
    Seguimiento de Compra | {{ $sitio }}
@endsection
@section('content')
    <div class="py-3 shadow-sm border-top" style="background-color: {{ $color_secundario }}; opacity:.6">
        <div class="container" style="color:white">
            <h6 class="mb-0">
                <a style="color:white" href="{{ url('/') }}">Inicio</a> /
                <a style="color:white" href="{{ url('mis-ordenes') }}">Seguimiento de Compra</a>
            </h6>
        </div>
    </div>
    <br>


    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">Seguimiento de Compra</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h3>Datos de entrega</h3>
                                <label>Nombre</label>
                                <div class="border p-2">{{ $order->fname }}</div>
                                <label>Apellido</label>
                                <div class="border p-2">{{ $order->lname }}</div>
                                <label>Email</label>
                                <div class="border p-2">{{ $order->email }}</div>
                                <label>Teléfono</label>
                                <div class="border p-2">{{ $order->telefono }}</div>
                                <label>Información de entrega</label>
                                @if ($order->fname != 'No aplica')
                                    <div class="border p-2">
                                        <strong>{{ $order->direccion1 }}</strong>,
                                        {{ $order->direccion2 }}
                                        {{ $order->ciudad }},
                                        {{ $order->comuna }},
                                        {{ $order->region }}.
                                    </div>
                                @else
                                    <div class="border p-2">
                                        {{ $order->direccion1 }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <h3>Detalles de la orden</h3>
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>
                                                    <img width="100"
                                                        src="{{ Storage::url('uploads/productos/' . $item->products->image) }}"
                                                        alt="">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4>Total: ${{ $order->total_price }}</h4>
                                <div class="mt-3">
                                    <div class="border p-2">
                                        {{ $order->status == '0' ? 'Pendiente de pago' : '' }}
                                        {{ $order->status == '1' ? 'Completado' : '' }}
                                        {{ $order->status == '2' ? 'Pago aprobado' : '' }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
