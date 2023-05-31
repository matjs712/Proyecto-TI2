<div class="mb-0 p-0 d-flex align-items-start"
    style="flex-wrap:wrap;padding: 1.5rem; padding-bottom:0;position: relative;">
    <div class="col-md-8 p-0">
        <section class="home" style="background-image: url('{{ asset($banner) }}')">
            <div class="home-text">
                <h1 class="hide">{{ $texto_1 }} <br>{{ $texto_2 }}</h1>
                <p class="hide">{{ $texto_3 }}<br>{{ $texto_4 }}</p>
                <a class="btn btn-home hide" href="{{ url('todo-productos') }}"
                    style="background-color: {{ $boton_nuevo }};"
                    onmouseover="this.style.backgroundColor='transparent';
                       this.style.border='1px solid {{ $boton_nuevo }}';"
                    onmouseout="this.style.backgroundColor='{{ $boton_nuevo }}';
                    this.style.border='1px solid {{ $boton_nuevo }}';">
                    Elige tu producto <i class="ml-2 fas fa-arrow-alt-circle-right"></i>
                </a>


            </div>
        </section>
    </div>
    <div class="col-md-4 pt-4 pl-2" class="hot-product-container">
        <div class="d-flex justify-content-center text-center">
            <h2>HOT SALES</h2>
        </div>
        <hr>
        <div id="prod-hot" class="owl-carousel owl-theme">
            @foreach ($productos as $producto)
                <div class="card text-left card-slider" style="position: relative;">
                    @if ($producto->trending == '1')
                        <label style="font-size: 16px; position:absolute; top:5%;"
                            class="text-white float-end badge trending_tag">Popular</label>
                    @endif
                    <a href="{{ url('ver-producto/' . $producto->slug) }}">
                        <img style="background: {{ $color_principal }}"
                            src="{{ Storage::url('uploads/productos/' . $producto->image) }}" alt="">
                    </a>
                    <div class="card-body bg-white text-center">
                        <a href="{{ url('ver-producto/' . $producto->slug) }}">
                            <h5 class="card-title">{{ $producto->name }}</h5>
                        </a>
                        <div class="d-flex flex-wrap justify-content-center align-items-baseline">
                            <span class="card-text mr-2"><b
                                    style="color: {{ $boton_nuevo }}; font-size:24px;">${{ $producto->selling_price }}</b>
                            </span>
                            <span class="card-text" style="font-size:15px;text-decoration:line-through">
                                ${{ $producto->original_price }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@section('trending_script')
    <script>
        $('#prod-hot').owlCarousel({
            autoplay: true,
            autoplayTimeout: 4000,
            autoplaySpeed: 4000,
            stopOnHover: true,
            loop: true,
            rewind: true,
            margin: 15,
            nav: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                // 600: {
                //     items: 3,
                //     nav: false
                // },
                // 1000: {
                //     items: 3,
                //     nav: true,
                //     loop: false
                // }
            }
        })
    </script>
@endsection
