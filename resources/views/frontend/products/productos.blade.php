@extends('layouts.front')
@section('title')
    Productos | {{ $sitio }}
@endsection
@section('content')
    <div class="py-3 mb-4 shadow-sm border-top" style="background-color: {{ $color_secundario }}; opacity:.6">
        <div class="container" style="color:white">
            <h6 class="mb-0">
                <a style="color:white" href="{{ url('/') }}">Inicio</a> /
                <a style="color:white" href="{{ url('todo-productos') }}">Productos</a>
            </h6>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex align-items-center flex-wrap justify-content-between">
                    <h2 class="hide">Nuestros Productos</h2>
                    <div class="d-flex align-items-center">
                        <div class="form-group m-0 mr-4">
                            <select name="sort_by" id="sort_by" class="form-control">
                                <option value="">Ordenar por precio</option>
                                <option value="precio_alto">Precio más alto</option>
                                <option value="precio_bajo">Precio más bajo</option>
                            </select>
                        </div>
                        <div class="form-group m-0  mr-4">
                            <select name="filter_by_category" id="filter_by_category" class="form-control">
                                <option value="">Filtrar por categoría</option>
                                @foreach ($categorias as $item)
                                    <option value="{{ $item->slug }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group m-0 ">
                            <select name="filter_by_ingredient" id="filter_by_ingredient" class="form-control">
                                <option value="">Filtrar por Ingrediente</option>
                                @foreach ($ingredientes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="search-result">
                    @if ($productos->count() >= 1)
                        <div class="row">
                            @foreach ($productos as $producto)
                                @php
                                    $rating = \App\Models\Rating::where('product_id', $producto->id)->get();
                                    $rating_sum = \App\Models\Rating::where('product_id', $producto->id)->sum('stars_rated');
                                    if ($rating->count() > 0) {
                                        $rating_value = $rating_sum / $rating->count();
                                    } else {
                                        $rating_value = 0;
                                    }
                                    $rate_number = number_format($rating_value);
                                @endphp
                                <div class="col-md-4 mb-4 hide2">
                                    <div class="team-item bg-white">
                                        <a href="{{ url('ver-producto/' . $producto->slug) }}">
                                            <div class="position-relative overflow-hidden text-center img-container-home">
                                                @if ($producto->trending == 1)
                                                    <span
                                                        style="color:white;position: absolute; border-radius:10px; padding: 2px 4px; top:10px;left:5px; background-color:{{ $boton_principal_busqueda }}; font-size:12px; opacity:0.8">Trending</span>
                                                @endif
                                                <img src="{{ Storage::url('uploads/productos/' . $producto->image) }}"
                                                    alt="" class="img-fluid" style="height:200px; width:auto">
                                            </div>
                                        </a>
                                        <div class="border-inner text-left px-4 py-2 d-flex flex-column">
                                            <div>
                                                <span class="float-left"
                                                    style="opacity: .6; font-size:12px">{{ $producto->category->name }}</span>
                                            </div>
                                            <a href="{{ url('ver-producto/' . $producto->slug) }}"
                                                style="text-decoration: none">
                                                <h4 class="text-dark m-1" style="font-style: bold; font-weight:900">
                                                    {{ $producto->name }}
                                                </h4>
                                            </a>
                                            <div class="rating">
                                                @for ($i = 1; $i <= $rate_number; $i++)
                                                    <i class="fa fa-star gold" aria-hidden="true"
                                                        style="font-size:12px"></i>
                                                @endfor
                                                @for ($j = $rate_number + 1; $j <= 5; $j++)
                                                    <i class="fa fa-star" style="color:grey;font-size:12px"
                                                        aria-hidden="true"></i>
                                                @endfor
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                <span class=""
                                                    style="font-size: 20px;font-style: bold; font-weight:900; color:{{ $boton_nuevo }}">${{ $producto->selling_price }}</span>
                                                <span
                                                    style="text-decoration: line-through">${{ $producto->original_price }}</span>
                                                <a href="{{ url('ver-producto/' . $producto->slug) }}"><span class="p-2"
                                                        style="border-radius: 50%; background-color:{{ $boton_principal_busqueda }}; opacity:.8; color:white"><i
                                                            class="fas fa-shopping-bag    "></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-md-12 my-5 text-center">
                            <h2>No se encontraron productos.</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="pagination-container">
                    {{ $productos->links('layouts.inc.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script>
        $(document).ready(function() {

            $('#sort_by, #filter_by_category, #filter_by_ingredient').on('change', function() {
                let sort_by = $('#sort_by').val();
                let filter_by_category = $('#filter_by_category').val();
                let filter_by_ingredient = $('#filter_by_ingredient').val();
                $.ajax({
                    url: "{{ route('products.filter') }}",
                    method: "GET",
                    data: {
                        sort_by: sort_by,
                        filter_by_category: filter_by_category,
                        filter_by_ingredient: filter_by_ingredient
                    },
                    success: function(res) {
                        $('.search-result').html(res);
                    }
                });
            });
        });
    </script>
@endsection
