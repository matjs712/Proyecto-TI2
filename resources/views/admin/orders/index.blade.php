@extends('layouts.admin')
@section('title')
Ordenes | {{ $sitio }}
@endsection
@section('content')

<div class="py-3 mb-1 border-bottom border-top">
    <div class="container ml-3">
        <h6 class="mb-0">
            <a href="{{ url('dashboard') }}">Inicio</a> / 
            <a href="{{ url('ordenes') }}">Ordenes</a>
        </h6>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">      
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Ordenes</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Nuevas</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Historial</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="table table-bordered" id="tablaOrdenes">
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
                                                <a class="btn btn-success" href="{{ url('admin/ver-orden/'.$item->id) }}"><i class="fa fa-search" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="table table-bordered" id="tablaOrdenesOld">
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
                                    @foreach ($ordersOld as $item)
                                        <tr>
                                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                            <td>{{ $item->tracking_number }}</td>
                                            <td>{{ $item->total_price }}</td>
                                            <td>{{ $item->status == '0' ? 'Pendiente': 'Completado'}}</td>
                                            <td>
                                                <a class="btn btn-success" href="{{ url('admin/ver-orden/'.$item->id) }}"><i class="fa fa-search" aria-hidden="true"></i></a>
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
    </div>
</div>

@endsection
@section('after_scripts')
	
<script>
    $(document).ready(function(){
        $('#tablaOrdenesOld').DataTable({
            responsive: true,
            "language": spanishLanguage,
        });
    })
</script>
<script>	
    $(document).ready(function(){
        $('#tablaOrdenes').DataTable({
            responsive: true,
            "language": spanishLanguage,
        });
    })
</script>

@endsection