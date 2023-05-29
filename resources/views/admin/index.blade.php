@extends('layouts.admin')
@section('title')
Home | {{ $sitio }}
@endsection
@section('content')
<div class="row pt-4 mx-4">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Nuevos usuarios
                    </div>
                    <div class="card-body new-users d-flex justify-content-between align-items-center">
                        <i class="fa-solid fa-chart-line fa-2xl" style="color: #3bc43d;"></i>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Productos comprados
                    </div>
                    <div class="card-body sell-products d-flex justify-content-between align-items-center">
                        <i class="fa-solid fa-chart-line fa-2xl" style="color: #3bc43d;"></i>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Ordenes nuevas
                    </div>
                    <div class="card-body new-orders d-flex justify-content-between align-items-center">
                        <i class="fa-solid fa-chart-line fa-2xl" style="color: #3bc43d;"></i>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Total de visitas
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <i class="fa-solid fa-chart-line fa-2xl" style="color: #3bc43d;"></i>
                        <div class="bg-green rounded-pill w-50 text-center ml-auto">{{ Cache::get('contador-visitas', 0) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Ingresos por mes
                    </div>
                    <div class="card-body p-0">
                        <canvas id="line-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total de ventas
                    </div>
                    <div class="card-body p-0">
                        <canvas id="line-sell-month"></canvas>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Ingresos diarios
                    </div>
                    <div class="card-body p-0">
                        <canvas id="line-sell-daily"></canvas>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row h-100">
            <div class="card w-100">
                <div class="card-header">
                    Productos top
                </div>
                <div class="card-body top-products py-0 px-3 ">
              
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.inc.charts')
@endsection

@section('after_scripts')
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }),
    //GRAFICO USUARIOS NUEVOS
    $.ajax({
        method: 'GET',
        url:'/usuarios-nuevos',
        success: function(response){
            let usuariosNuevos = 0;
            JSON.parse(response).forEach(function(usuario){
                usuariosNuevos += usuario.usuarios;
            });
            $('.new-users').append($('<div>').addClass('bg-green rounded-pill w-50 text-center ml-auto').text(usuariosNuevos));
            
            console.log('usuarios nuevos: ');
            console.log(JSON.parse(response));
        },
        error: function(response){
            console.log(response);
        }
    })
    //GRAFICO PRODUCTOS COMPRADOS
    $.ajax({
        method: 'GET',
        url:'/productos-comprados',
        success: function(response){
            let productosComprados = 0;
            JSON.parse(response).forEach(function(productos){
                productos.productos.forEach(function(cantidad){
                    productosComprados += parseInt(cantidad.count);
                });
            });
            $('.sell-products').append($('<div>').addClass('bg-green rounded-pill w-50 text-center ml-auto').text(productosComprados));
            
            console.log('productos comprados: ')
            console.log(JSON.parse(response));
        },
        error: function(response){
            console.log(response);
        }
    })
    //GRAFICO ORDENES NUEVAS
    $.ajax({
        method: 'GET',
        url:'/ordenes-nuevas',
        success: function(response){
            let ordenesNuevas = 0;
            JSON.parse(response).forEach(function(orden){
                ordenesNuevas += orden.ordenes;
            });
            $('.new-orders').append($('<div>').addClass('bg-green rounded-pill w-50 text-center ml-auto').text(ordenesNuevas));
            
            console.log('ordenes nuevas: ')
            console.log(JSON.parse(response));
        },
        error: function(response){
            console.log(response);
        }
    })
    //GRAFICO INGRESOS POR MES
    $.ajax({
        method: 'GET',
        url:'/ingresos-mes',
        success: function(response){
            var canvas = document.getElementById('line-chart');
            var ctx = canvas.getContext('2d');

            // Define los datos del gráfico
            var data = {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            datasets: [{
                label: 'Ventas',
                data: [50, 30, 60, 40, 70],
                 backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'rgba(0, 123, 255, 1)', // Color de la línea
            }]
            };

            // Configura las opciones del gráfico
            var options = {
                responsive: true,
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
            };

            // Crea el gráfico de líneas
            var lineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
            });
            // $('.sell-products').append($('<div>').text('Producto: ' + JSON.parse(response)[0].productos));
            console.log('ingresos mes: ')
            console.log(JSON.parse(response));
        },
        error: function(response){
            console.log(response);
        }
    })
    //GRAFICO VENTAS POR MES
    $.ajax({
        method: 'GET',
        url:'/ventas-mes',
        success: function(response){
            var canvas = document.getElementById('line-sell-month');
            var ctx = canvas.getContext('2d');

            // Define los datos del gráfico
            var data = {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            datasets: [{
                label: 'Ventas',
                data: [50, 30, 60, 40, 70],
                 backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'rgba(0, 123, 255, 1)', // Color de la línea
            }]
            };

            // Configura las opciones del gráfico
            var options = {
                responsive: true,
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
            };

            // Crea el gráfico de líneas
            var lineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
            });
            // $('.sell-products').append($('<div>').text('Producto: ' + JSON.parse(response)[0].productos));
            console.log('Ventas mes: ')
            console.log(JSON.parse(response));
        },
        error: function(response){
            console.log(response);
        }
    })
    //GRAFICO INGRESOS DIARIOS
    $.ajax({
        method: 'GET',
        url:'/ingresos-diarios',
        success: function(response){
            var canvas = document.getElementById('line-sell-daily');
            var ctx = canvas.getContext('2d');

            // Define los datos del gráfico
            var data = {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            datasets: [{
                label: 'Ventas',
                data: [50, 30, 60, 40, 70],
                 backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'rgba(0, 123, 255, 1)', // Color de la línea
            }]
            };

            // Configura las opciones del gráfico
            var options = {
                responsive: true,
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
            };

            // Crea el gráfico de líneas
            var lineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
            });
            // $('.sell-products').append($('<div>').text('Producto: ' + JSON.parse(response)[0].productos));
            console.log('ingresos diarias: ')
            console.log(JSON.parse(response));
        },
        error: function(response){
            console.log(response);
        }
    })
    //TABLA TOP PRODUCTOS
    $.ajax({
        method: 'GET',
        url:'/productos-top',
        success: function(response){
            JSON.parse(response).forEach(function(orden){
                $('.top-products').append($('<div>').addClass('w-100 text-left pb-2 pt-3 border-bottom').text(orden.name));
            });
            
            console.log('Productos top: ')
            console.log(JSON.parse(response));
        },
        error: function(response){
            console.log(response);
        }
    })
});
</script>
@endsection