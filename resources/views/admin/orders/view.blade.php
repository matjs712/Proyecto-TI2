@extends('layouts.admin')
@section('title')
Ordenes | {{ $sitio }}
@endsection
@section('content')
    
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <a class="btn" href="{{ url('ordenes') }}"><i class="fa fa-backward" aria-hidden="true"></i> Volver</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 order-details">
                            <h3>Datos de entrega</h3>
                            <label>Nombre</label>
                            <div class="border p-2">{{ $orders->fname }}</div>
                            <label>Apellido</label>
                            <div class="border p-2">{{ $orders->lname }}</div>
                            <label>Email</label>
                            <div class="border p-2">{{ $orders->email }}</div>
                            <label>Teléfono</label>
                            <div class="border p-2">{{ $orders->telefono }}</div>
                            <label>Información de entrega</label>
                            <div class="border p-2">
                                {{ $orders->direccion1 }}
                                {{ $orders->direccion2 }}
                                {{ $orders->region }}
                                {{ $orders->ciudad }}
                                {{ $orders->comuna }}
                            </div>
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
                                    @foreach ($orders->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->products->name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>
                                                <img width="100" src="{{ Storage::url('uploads/productos/'.$item->products->image) }}" alt="">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4>Total: ${{ $orders->total_price }}</h4>
                            <div class="mt-3">
                                <form action="{{ url('update-order/'.$orders->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label>Estado de la orden</label>
                                    <select name="orden_status" class="form-control">
                                        <option {{ $orders->status == '2'? 'selected': '' }} value="2">Aprobada</option>
                                        <option {{ $orders->status == '0'? 'selected': '' }} value="0">Pendiente</option>
                                        <option {{ $orders->status == '1'? 'selected': '' }} value="1">Completada</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary mt-3">Editar</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection