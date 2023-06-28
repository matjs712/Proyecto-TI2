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
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">Seguimiento de Compra</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('seguimiento_compra') }}" method="POST">
                            @csrf
                            <div class="row checkout-form">
                                <div class="col-md-12">
                                    <label for="tracking_number">Numero de seguimiento</label>
                                    <input type="text" name="tracking_number" value=""
                                        class="tracking_number form-control" placeholder="SALES4568"
                                        value="{{ old('tracking_number') }}">
                                    @if ($errors->has('tracking_number'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('tracking_number') }}</span>
                                    @endif
                                    <span style="color:red" id="fname_error"></span>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button style="width: 100%;" class="btn btn-primary pagoBtn">Buscar</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
