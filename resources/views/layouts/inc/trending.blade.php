<div class="row mt-4">
    <div class="col-md-12 text-center">
        <h2>PRODUCTOS DESTACADOS</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12 ">
        <div id="prod" class="owl-carousel owl-theme mt-2 ">
            @foreach ($productos as $producto)
            <div class="item">
                <img src="{{ asset('assets/uploads/productos/'.$producto->image) }}" alt="">
            </div>
            @endforeach
        </div>  
    </div>
</div>

@section('trending_script')
<script>
    $('#prod').owlCarousel({
    loop:true,
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