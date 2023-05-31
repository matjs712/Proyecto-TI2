@extends('layouts.front')
@section('title')
    Categorias | {{ $sitio }}
@endsection
@section('content')
    <div class="py-3 mb-4 shadow-sm border-top" style="background-color: {{ $color_secundario }}; opacity:.6">
        <div class="container" style="color:white">
            <h6 class="mb-0">
                <a style="color:white" href="{{ url('/') }}">Inicio</a> /
                <a style="color:white" href="{{ url('todo-categorias') }}">Categorías</a>
            </h6>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-result">
                    @if ($categorias->count() >= 1)
                        <div class="row">
                            @foreach ($categorias as $item)
                                <div class="col-md-6 mb-4 p-0 category-container hide"
                                    style="position:relative;background-image: url('{{ Storage::url('uploads/categorias/' . $item->image) }}'); height:300px; background-size:cover; background-repeat:no-repeat">
                                    <a href="{{ url('ver-categoria/' . $item->slug) }}" style="text-decoration: none">
                                        <div
                                            style="height: 100%;width:100%;position:absolute;background-color:rgba(0, 0, 0, 0.2);">
                                            <div style="width: 100%; height:100%"
                                                class="text-center d-flex justify-content-center align-items-center">
                                                <h2 class="text-white p-1 m-0"
                                                    style="border-radius:10px;font-style: bold; font-weight:900;background-color:{{ $boton_principal_busqueda }}; width:30%">
                                                    {{ $item->name }}
                                                </h2>
                                            </div>
                                        </div>
                                    </a>
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
