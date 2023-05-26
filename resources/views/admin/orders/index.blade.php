@extends('layouts.admin')
@section('title')
    Ordenes | {{ $sitio }}
@endsection
@section('css_before')
    <style>
        @media (max-width: 768px) {
            .order-title {
                width: 100% !important;
                text-align: center !important;
                margin-bottom: 1.5rem;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="card hide2">
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-4 d-flex flex-wrap" id="myTab" role="tablist">
                            <h4 class="mr-4 order-title">Ordenes</h4>
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Nuevas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false">Historial</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <table class="table table-bordered table-hover" id="tablaOrdenes" style="width: 100%">
                                    <thead style="background-color:#343a40; color:white;">
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
                                                        Pendiente de pago
                                                    @elseif ($item->status == 1)
                                                        Completado
                                                    @elseif ($item->status == 2)
                                                        Pago aprobado
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-success"
                                                        href="{{ url('admin/ver-orden/' . $item->id) }}"><i
                                                            class="fa fa-search" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table table-bordered table-hover" id="tablaOrdenesOld" style="width: 100%">
                                    <thead style="background-color:#343a40; color:white;">
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
                                                <td>{{ $item->status == '0' ? 'Pendiente' : 'Completado' }}</td>
                                                <td>
                                                    <a class="btn btn-success"
                                                        href="{{ url('admin/ver-orden/' . $item->id) }}"><i
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
        </div>
    </div>
@endsection
@section('after_scripts')
    <script>
        $(document).ready(function() {
            $('#tablaOrdenesOld').DataTable({
                responsive: true,
                "language": spanishLanguage,
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#tablaOrdenes').DataTable({
                responsive: true,
                "language": spanishLanguage,
            });
        })
    </script>
@endsection
