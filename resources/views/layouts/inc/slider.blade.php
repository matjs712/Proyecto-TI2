<div id="cat" class="owl-carousel owl-theme">
  @foreach ( $banners as $banner )
    <div class="item">
      <img src="{{ asset('assets/uploads/categorias/'.$banner->image) }}" alt="">
    </div>
  @endforeach
</div>
@section('slider_script')
<script>
  $('#cat').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
    autoplay:true,
    autoplayTimeout:3000,
    responsive:{
        0:{
            items:1
        }
    }
})
</script>

@endsection