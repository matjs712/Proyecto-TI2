@if ($productos->count() >= 1)
    <div class="row">
        @foreach ($productos as $producto)
        <div class="col-md-4 mb-4">
        <div class="card card-filter text-left" style="position: relative;">
            @if ( $producto->trending == '1' )
                    <label style="font-size: 16px; position:absolute; top:5%; background:#cf4647;" class="text-white float-end badge trending_tag">Popular</label>
                @endif
            <img src="{{ Storage::url('uploads/productos/'.$producto->image) }}" alt="">
        <div class="card-body bg-white text-center">
            <a href="{{ url('ver-producto/'.$producto->slug) }}">
                <h4 class="card-title">{{ $producto->name }}</h4>
            </a>
            <p class="card-text"><b>${{ $producto->selling_price }}</b></p>
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