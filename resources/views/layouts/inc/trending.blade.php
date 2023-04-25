<div class="row mt-4">
    <div class="col-md-12 text-center">
        <h2>PRODUCTOS DESTACADOS</h2>
    </div>
</div>
<div class="container section">
    <div class="row">
        <div class="col-md-12">
            <div id="prod" class="owl-carousel owl-theme mt-2 ">
                @foreach ($productos as $producto)
                <div class="card text-left card-slider" style="position: relative;">
                    @if ( $producto->trending == '1' )
                            <label style="font-size: 16px; position:absolute; top:5%; background:{{ $color_secundario }};" class="text-white float-end badge trending_tag">Popular</label>
                        @endif
                    <img src="{{ asset('assets/uploads/productos/'.$producto->image) }}" alt="">
                <div class="card-body bg-white text-center">
                    <a href="{{ url('ver-producto/'.$producto->slug) }}">
                        <h4 class="card-title">{{ $producto->name }}</h4>
                    </a>
                    <p class="card-text"><b>${{ $producto->selling_price }}</b></p>
                </div>
                </div>
                @endforeach
            </div>  
        </div>
    </div>
</div>

@section('trending_script')
<script>
    $('#prod').owlCarousel({
    autoplay: true,
    autoplayTimeout: 3000,
    autoplaySpeed: 2000,
    stopOnHover : false,
    loop:true,
    rewind: true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            loop:false
        }
    }
})
</script>
@endsection