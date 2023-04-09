@extends('layouts.front')
@section('title')
Categorias | {{ $sitio }}
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm border-top migaja">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">Inicio</a> / 
            <a href="{{ url('todo-categrorias') }}">Categorias</a>
        </h6>
    </div>
</div>
<br>
<div class="container">
    {{-- <div class="row">
        <div class="col-md-12">
            <h2>Filtrar productos</h2>
            <div class="d-flex align-items-center flex-wrap">
                <div class="form-group mr-4">
                    <select name="sort_by" id="sort_by" class="form-control">
                      <option value="">Ordenar por precio</option>
                      <option value="precio_alto">Precio más alto</option>
                      <option value="precio_bajo">Precio más bajo</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select name="sort_by" id="sort_by" class="form-control">
                      <option value="">Ordenar por categoría</option>
                      @foreach ($categorias as $item)
                      <option value="{{ $item->slug }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div> 
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="search-result">
                @if ($categorias->count() >= 1)
                    <div class="row">
                        @foreach ($categorias as $item)
                            <div class="col-md-4 mb-4">
                                <div class="card card-filter text-left" style="position: relative;">
                                    @if ( $item->trending == '1' )
                                        <label style="z-index:100;font-size: 16px; position:absolute; top:5%; background:#cf4647;" class="text-white float-end badge trending_tag">Popular</label>
                                    @endif
                                    <img src="{{ asset('assets/uploads/categorias/'.$item->image) }}" alt="">
                                    <div class="card-body bg-white text-center">
                                        <a href="{{ url('ver-categoria/'.$item->slug)  }}">
                                            <h4 class="card-title">{{ $item->name }}</h4>
                                        </a>
                                        <p class="card-text">{{ $item->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="col-md-12 my-5 text-center">
                        <h2>No se encontraron categorias.</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="pagination-container">
                {{ $categorias->links('layouts.inc.pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('after_scripts')
{{-- <script>
   $(document).ready(function (){

    $('#sort_by').on('change', function(){
        let sort_by = $('#sort_by').val();
        $.ajax({
            url:"{{ route('products.filter') }}",
            method:"GET",
            data:{sort_by:sort_by},
            success:function(res){
                $('.search-result').html(res);
            }
        });
    });
   });
</script> --}}
@endsection