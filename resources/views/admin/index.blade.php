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
                    <div class="card-body new-users">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Productos comprados
                    </div>
                    <div class="card-body sell-products">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Ordenes nuevas
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Total de visitas
                    </div>
                    <div class="card-body">
                        
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
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total de ventas
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Ingresos diarios
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row h-100">
            <div class="card">
                <div class="card-header">
                    Productos top
                </div>
                <div class="card-body">
              
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
            $('.new-users').append($('<div>').text('Nuevos usuarios: ' + JSON.parse(response)[0].usuarios));
            
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
            // $('.sell-products').append($('<div>').text('Producto: ' + JSON.parse(response)[0].productos));
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
            // $('.sell-products').append($('<div>').text('Producto: ' + JSON.parse(response)[0].productos));
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
            // $('.sell-products').append($('<div>').text('Producto: ' + JSON.parse(response)[0].productos));
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