@if ($productos->count() >= 1)
    <div class="row">
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
                $configuracion = \Illuminate\Support\Facades\DB::table('configurations')
                    ->select('boton_principal_busqueda')
                    ->first();
                $boton_principal_busqueda = $configuracion->boton_principal_busqueda;
                $configuracion2 = \Illuminate\Support\Facades\DB::table('configurations')
                    ->select('boton_nuevo')
                    ->first();
                $boton_nuevo = $configuracion2->boton_nuevo;
            @endphp
            <div class="col-md-4 mb-4">
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
@else
    <div class="col-md-12 my-5 text-center">
        <h2>No se encontraron productos.</h2>
    </div>
@endif
