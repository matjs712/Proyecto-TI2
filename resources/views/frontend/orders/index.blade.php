@extends('layouts.front')
@section('title')
    Mis pedidos | {{ $sitio }}
@endsection
@section('content')
    <div class="py-3 shadow-sm border-top" style="background-color: {{ $color_secundario }}; opacity:.6">
        <div class="container" style="color:white">
            <h6 class="mb-0">
                <a style="color:white" href="{{ url('/') }}">Inicio</a> /
                <a style="color:white" href="{{ url('mis-ordenes') }}">Mis Pedidos</a>
            </h6>
        </div>
    </div>
    <br>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">Mis Ordenes</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha de orden</th>
                                    <th>Numero de seguimiento</th>
                                    <th>Precio Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->tracking_number }}</td>
                                        <td>{{ $item->total_price }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                Pendiente
                                            @elseif ($item->status == 1)
                                                Completado
                                            @elseif ($item->status == 2)
                                                Aprobada
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="{{ url('ver-orden/' . $item->id) }}"><i
                                                    class="fa fa-search" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
@endsection
