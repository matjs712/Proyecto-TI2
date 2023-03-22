@section('css_after')
<style>
  .owl-carousel{
    max-height:500px;  
  }
  .owl-carousel img{
  height: 500px !important;
  object-fit: cover !important;
  object-position: center !important;
}
.owl-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 100%;
  display: flex;
  justify-content: space-between;
  z-index: 1;
}

.owl-nav button {
  color: white;
  font-size: 30px;
  background: transparent;
  border: none;
  cursor: pointer;
  transition: opacity 0.2s;
}

.owl-nav button:hover {
  opacity: 0.7;
}
.owl-prev, .owl-next{
 font-size: 100px !important;
 background: #e4e4e4 !important;
 z-index: 100000 !important;
 position: absolute !important;
 height: 22px !important;
 width: 22px !important;
}
.owl-next{
  right: 10px !important;
}
.owl-prev{
  left: 10px !important;
}


</style>
@endsection

<div class="owl-carousel owl-theme">
  @foreach ( $categorias as $categoria )
    <div class="item">
      <img src="{{ asset('assets/uploads/categorias/'.$categoria->image) }}" alt="">
    </div>
  @endforeach
</div>

@section('after_scripts')
<script>
  $('.owl-carousel').owlCarousel({
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