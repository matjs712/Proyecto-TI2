<div class="row mt-4">
    <div class="col-md-12 text-center">
        <h2>CATEGORIAS DESTACADAS</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-12 ">
        <div id="categoria" class="owl-carousel owl-theme mt-2 ">
            @foreach ($categorias as $categoria)
            <div class="item text-center" style="background-image: url('{{ asset('assets/uploads/categorias/'.$categoria->image) }}'); height: 500px; position:relative;">
                {{-- <img src="" alt=""> --}}
                <a href="{{ url('ver-categoria/'.$categoria->slug) }}" class="bg-white text-dark" style="position: absolute; bottom:10px;">Ver más</a>
            </div>
            @endforeach
        </div>  
    </div>
</div>

@section('trending_cat_script')
<script>
    $('#categoria').owlCarousel({
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