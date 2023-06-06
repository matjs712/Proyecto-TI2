@extends('layouts.admin')
@section('title')
    Informacion Nutricional | {{ $sitio }}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-4 d-flex align-items-center justify-content-between" style="width: 100%; flex-wrap:wrap">
                <h2>Informacion Nutricional</h2>
                <h6 class="mb-0 d-flex align-items-center justify-content-end">
                    <a href="{{ url('dashboard') }}" class="mr-1">Inicio</a> /
                    <a href="{{ url('nutricionales') }}" class="mx-1">Informacion Nutricional</a> /
                    <a href="#" class="ml-2">Editar Informacion Nutricional</a>
                </h6>
            </div>
            <form action="{{ url('update-nutricional/' . $nutricional->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Producto</label>
                            <select name="id_producto" class="form-control"id="">
                                <option value="">Selecciona el producto.</option>
                                @foreach ($producto as $product)
                                    <option value="{{ $nutricional->id }}"
                                        {{ $product->id === $nutricional->id_producto ? 'selected' : '' }}>
                                        {{ $product->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_producto'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('id_producto') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Valor energetico</label>
                            <input type="number" name="valor_energetico" value="{{ $nutricional->valor_energetico }}"
                                class="form-control">
                            @if ($errors->has('valor_energetico'))
                                <span class="error text-danger"
                                    for="input-name">{{ $errors->first('valor_energetico') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Grasa Saturada </label>
                            <input type="number" name="grasa_saturada" value="{{ $nutricional->grasa_saturada }}"
                                class="form-control">
                            @if ($errors->has('grasa_saturada'))
                                <span class="error text-danger"
                                    for="input-name">{{ $errors->first('grasa_saturada') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Grasa Total </label>
                            <input type="number" name="grasa_total" value="{{ $nutricional->grasa_total }}"
                                class="form-control">
                            @if ($errors->has('grasa_total'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('grasa_total') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Sal </label>
                            <input type="number" name="sal" value="{{ $nutricional->sal }}" class="form-control">
                            @if ($errors->has('sal'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('sal') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Yodo </label>
                            <input type="number" name="yodo" value="{{ $nutricional->yodo }}" class="form-control">
                            @if ($errors->has('yodo'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('yodo') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Azucar </label>
                            <input type="number" name="azucar" value="{{ $nutricional->azucar }}" class="form-control">
                            @if ($errors->has('azucar'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('azucar') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Proteina </label>
                            <input type="number" name="proteina" value="{{ $nutricional->proteina }}"
                                class="form-control">
                            @if ($errors->has('proteina'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('proteina') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
