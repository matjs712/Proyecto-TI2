@extends('layouts.admin')
@section('title')
Notificaciones | {{ $sitio }}
@endsection
@section('content')

<div class="py-3 mb-1 border-bottom border-top">
    <div class="container ml-3">
        <h6 class="mb-0">
            <a href="{{ url('dashboard') }}">Inicio</a> / 
            <a href="{{ url('notificaciones') }}">Notificaciones</a>
        </h6>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">      
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Notificaciones</h4>
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
                            <table class="table table-bordered" id="tablaNotificaciones">
                                <thead>
                                    <tr>
                                        <th>Detalle</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $item)
                                        <tr>
                                            <td>{{ $item->detalle }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                            <td>{{ date('H:i', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a class="btn btn-success" href=""><i class="fa fa-search" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="table table-bordered" id="tablaNotificacionesOld">
                                <thead>
                                    <tr>
                                        <th>Detalle</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notificationsOld as $item)
                                        <tr>
                                        <td>{{ $item->detalle }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                            <td>{{ date('H:i', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a class="btn btn-success" href=""><i class="fa fa-search" aria-hidden="true"></i></a>
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
        $('#tablaNotificacionesOld').DataTable({
            responsive: true,
            "language": spanishLanguage,
        });
    })
</script>
<script>	
    $(document).ready(function(){
        $('#tablaNotificaciones').DataTable({
            responsive: true,
            "language": spanishLanguage,
        });
    })
</script>

@endsection