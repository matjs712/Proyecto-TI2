<div class="div" style="width: 100%; position:relative; padding-top:3.5rem">
    <div
        style="padding-top:10px;position: absolute; top:20%;right:0;width:200px;height:300px;background: rgba(151, 229, 233, 0.104)">
        <svg class="svg-background" width="294" height="424" fill="none" viewBox="0 0 404 784" aria-hidden="true"
            class="hidden lg:block absolute left-full transform -translate-x-1/2 -translate-y-1/4">
            <defs>
                <pattern id="b1e6e422-73f8-40a6-b5d9-c8586e37e0e7" x="0" y="0" width="20"
                    height="20" patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" fill="currentColor"
                        class="text-primario_azul-200"></rect>
                </pattern>
            </defs>
            <rect width="404" height="784" fill="url(#b1e6e422-73f8-40a6-b5d9-c8586e37e0e7)"></rect>
        </svg>
    </div>

    <div class="container section" style="position: relative">
        <div
            class="section-title position-relative text-center mx-auto mb-2 pb-3 d-flex align-items-center justify-content-between">
            <h2 class="text-uppercase hide">Nuevos Productos</h2>
            <a class="hide2" href="{{ url('/todo-productos') }}"
                style="text-decoration: none; color:{{ $boton_nuevo }}">
                <h4>Ver todos <i class="fas fa-arrow-right    "></i></h4>
            </a>
        </div>
        <div class="row g-5">
            @foreach ($productos as $producto)
                @php
                    $rating = \App\Models\Rating::where('product_id', $producto->id)->get();
                    $rating_sum = \App\Models\Rating::where('product_id', $producto->id)->sum('stars_rated');
                    if ($rating->count() > 0) {
                        $rating_value = $rating_sum / $rating->count();
                    } else {
                        $rating_value = 0;
                    }
                    $rate_number = number_format($rating_value);
                @endphp
                <div class="col-lg-3 col-md-6 hide2">
                    <div class="team-item bg-white">
                        <a href="{{ url('ver-producto/' . $producto->slug) }}">
                            <div class="position-relative overflow-hidden text-center img-container-home">
                                @if ($producto->trending == 1)
                                    <span
                                        style="color:white;position: absolute; border-radius:10px; padding: 2px 4px; top:10px;left:5px; background-color:{{ $boton_principal_busqueda }}; font-size:12px; opacity:0.8">Trending</span>
                                @endif
                                <img src="{{ Storage::url('uploads/productos/' . $producto->image) }}" alt=""
                                    class="img-fluid" style="height:200px; width:auto">
                            </div>
                        </a>
                        <div class="border-inner text-left px-4 py-2 d-flex flex-column">
                            <div>
                                <span class="float-left"
                                    style="opacity: .6; font-size:12px">{{ $producto->category->name }}</span>
                            </div>
                            <a href="{{ url('ver-producto/' . $producto->slug) }}" style="text-decoration: none">
                                <h4 class="text-dark m-1" style="font-style: bold; font-weight:900">
                                    {{ $producto->name }}
                                </h4>
                            </a>
                            <div class="rating">
                                @for ($i = 1; $i <= $rate_number; $i++)
                                    <i class="fa fa-star gold" aria-hidden="true" style="font-size:12px"></i>
                                @endfor
                                @for ($j = $rate_number + 1; $j <= 5; $j++)
                                    <i class="fa fa-star" style="color:grey;font-size:12px" aria-hidden="true"></i>
                                @endfor
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-2">
                                <span class=""
                                    style="font-size: 20px;font-style: bold; font-weight:900; color:{{ $boton_nuevo }}">${{ $producto->selling_price }}</span>
                                <span style="text-decoration: line-through">${{ $producto->original_price }}</span>
                                <a href="{{ url('ver-producto/' . $producto->slug) }}"><span class="p-2"
                                        style="border-radius: 50%; background-color:{{ $boton_principal_busqueda }}; opacity:.8; color:white"><i
                                            class="fas fa-shopping-bag    "></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- <div class="custom-shape-divider-top-1685474875">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                class="shape-fill"></path>
        </svg>
    </div> --}}
</div>
<br><br><br><br>

{{-- <div class="wide-banners outer-bottom-xs">
    <div class="row">
        <div class="col-md-8 p-0" style="height: 230px">
            <div class="wide-banner1 cnt-strip" style="height:100%; width:100%">
                <div class="image"
                    style="background-image: url('{{ Storage::url('home-cut-section/sal-cut.jpg') }}'); height:100%; width:100%; background-position:bottom;background-repeat:no-repeat; background-size:cover">
                </div>
                <div class="strip strip-text">
                    <div class="strip-inner hide2">
                        <a href="{{ url('/todo-productos') }}" style="text-decoration: none">
                            <h2 class="text-right">Sal para tu mesa<br>
                                <span class="shopping-needs">Descuentos en todos los productos</span>
                            </h2>
                        </a>
                    </div>
                </div>
                <div class="new-label">
                    <div class="text" style="background-color: {{ $boton_principal_busqueda }}">NEW</div>
                </div>
                <!-- /.new-label -->
            </div>
            <!-- /.wide-banner -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 p-0" style="height: 230px">
            <div class="wide-banner cnt-strip">
                <div class="image"> <img style="border-radius:0;" class="img-responsive"
                        src="{{ Storage::url('home-cut-section/sal-cut-2.jpg') }}" alt=""> </div>


                <!-- /.new-label -->
            </div>
            <!-- /.wide-banner -->
        </div>

    </div>
    <!-- /.row -->
</div> --}}
{{-- <br><br><br> --}}
