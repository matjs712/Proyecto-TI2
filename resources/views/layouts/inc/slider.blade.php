<div class="row" style="padding: 1.5rem">
    <div class="col-md-8">
        <section class="home" style="background-image: url('{{ asset($banner) }}')">
            <div class="home-text">
                <h1 class="hide">{{ $texto_1 }} <br>{{ $texto_2 }}</h1>
                <p class="hide">{{ $texto_3 }}<br>{{ $texto_4 }}</p>
                <a class="btn btn-home hide" href="{{ url('todo-productos') }}"
                    style="background-color: {{ $boton_principal_busqueda }};"
                    onmouseover="this.style.backgroundColor='transparent';
                       this.style.border='1px solid {{ $boton_principal_busqueda }}';"
                    onmouseout="this.style.backgroundColor='{{ $boton_principal_busqueda }}';
                    this.style.border='1px solid {{ $boton_principal_busqueda }}';">
                    Elige tu producto <i class="ml-2 fas fa-arrow-alt-circle-right"></i>
                </a>


            </div>
            <div class="custom-shape-divider-bottom-1680324404">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                    preserveAspectRatio="none">
                    <path
                        d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                        opacity=".25" class="shape-fill"></path>
                    <path
                        d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                        opacity=".5" class="shape-fill"></path>
                    <path
                        d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                        class="shape-fill"></path>
                </svg>
            </div>
        </section>
    </div>
    <div class="col-md-4" class="hot-product-container">
        <h2>HOT SALES</h2>
        <hr>
        <div id="prod-hot" class="owl-carousel owl-theme">
            @foreach ($productos as $producto)
                <div class="card text-left card-slider" style="position: relative;">
                    @if ($producto->trending == '1')
                        <label
                            style="font-size: 16px; position:absolute; top:5%; background:{{ $boton_principal_busqueda }};"
                            class="text-white float-end badge trending_tag">Popular</label>
                    @endif
                    <img style="background-color: {{ $color_principal }}"
                        src="{{ Storage::url('uploads/productos/' . $producto->image) }}" alt="">
                    <div class="card-body bg-white text-center">
                        <a href="{{ url('ver-producto/' . $producto->slug) }}">
                            <h5 class="card-title">{{ $producto->name }}</h5>
                        </a>
                        <div class="d-flex flex-wrap justify-content-center align-items-baseline">
                            <span class="card-text mr-2"><b
                                    style="color: {{ $boton_principal_busqueda }}; font-size:24px;">${{ $producto->selling_price }}</b>
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
