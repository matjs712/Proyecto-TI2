@extends('layouts.front')
@section('title')
    {{ $producto->name }} | {{ $sitio }}
@endsection
@section('content')
    <div class="py-3 shadow-sm border-top" style="background-color: {{ $color_secundario }}; opacity:.6">
        <div class="container" style="color:white">
            <h6 class="mb-0">
                <a class="text-white" href="{{ url('/') }}" class="text-white">Inicio</a> /
                <a class="text-white"
                    href="{{ url('categorias/' . $producto->category->slug . '/' . $producto->slug) }}">{{ $producto->name }}</a>
            </h6>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="card shadow prod_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 border-right" style="position: relative">
                        @if ($producto->trending == '1')
                            <label style="font-size: 16px;position:absolute; top:5%;left:0"
                                class="float-end badge text-white bg-danger trending_tag">Tendencia</label>
                        @endif
                        <img style="width: 100%;" src="{{ Storage::url('uploads/productos/' . $producto->image) }}"
                            alt="{{ $producto->name }}">
                    </div>
                    <div class="col-md-6">
                        <h1 class="pt-3 mb-0 d-flex justify-content-between align-items-center">
                            <span style="font-weight:900">{{ $producto->name }}</span>
                        </h1>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <a href="{{ url('ver-categoria/' . $producto->category->slug) }}">
                                <label style="font-weight:400;font-size: 16px;color:{{ $boton_nuevo }}"
                                    class="float-end trending_tag"> <span style="opacity: .6">Categoría:
                                    </span>{{ $producto->category->name }}</label>
                            </a>
                            @php $rate_number = number_format($rating_value) @endphp
                            <div class="rating d-flex justify-content-end align-items-center">
                                @for ($i = 1; $i <= $rate_number; $i++)
                                    <i class="fa fa-star gold" style="font-size:12px" aria-hidden="true"></i>
                                @endfor
                                @for ($j = $rate_number + 1; $j <= 5; $j++)
                                    <i class="fa fa-star" style="font-size:12px" aria-hidden="true"></i>
                                @endfor
                                <span style="font-size:14px">({{ $rating->count() }}
                                    {{ $rating->count() == 1 ? 'Calificación' : 'Calificaciones' }})</span>
                            </div>
                        </div>
                        <hr class="m-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-end">
                                <h2 class="py-2 m-0" style="margin-right:15px!important;">
                                    <strong style="color:{{ $boton_nuevo }}">${{ $producto->selling_price }}</strong>
                                </h2>
                                <h5 class="py-2 m-0" style="opacity:.8"><s>${{ $producto->original_price }}</s></h5>
                            </div>
                            <div>
                                @if ($producto->qty > 0)
                                    <label class="badge bg-success text-white">En stock</label>
                                @else
                                    <label class="badge bg-danger  text-white">Sin stock</label>
                                @endif
                            </div>
                        </div>
                        <hr class="m-2">
                        <div class="text-center">
                            <p class="py-3 m-0">
                                {!! $producto->description !!}
                            </p>
                        </div>
                        <hr class="m-0">
                        <div class="row mt-2 d-flex align-items-center px-3">
                            <input type="hidden" value="{{ $producto->id }}" class="prod_id">
                            <div class="input-group text-center mr-2"
                                style="border: 1px solid rgba(128, 128, 128, 0.363);border-radius:8px; width:100px">
                                <button class="input-group-text decrement-btn bg-white"
                                    style="border:none;border-radius:15px">-</button>
                                <input type="text" name="qty" value="1" class="form-control qty-input"
                                    style="border:none;">
                                <button class="input-group-text
                                    increment-btn bg-white"
                                    style="border:none; border-radius:15px">+</button>
                            </div>
                            @if ($producto->qty > 0)
                                <button onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                    style="background-color: {{ $boton_carrito }}; color:white;"
                                    class="btn my-1 mr-2 float-start addCartBtn  mr-2"><i class="fa fa-cart-plus"
                                        aria-hidden="true"></i>Añadir al Carrito</button>
                            @endif
                            <button onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                style="border-color: {{ $boton_lista }}; color:{{ $boton_lista }};"
                                class="btn my-1 mr-2 float-start addToWishlist"><i class="fa-regular fa-heart"></i></button>
                            <button onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                style="border-color: {{ $boton_calificacion }}; color:{{ $boton_calificacion }};"
                                type="button" class="btn my-1 mr-2" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </button>
                            <a onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'"
                                style="border-color: {{ $boton_review }}; color:{{ $boton_review }};"
                                href="{{ url('add-review/' . $producto->slug . '/userreview') }}" class="btn my-1"><i
                                    class="fas fa-book    "></i> Añadir Review</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Reseñas</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Reseñas</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                        aria-controls="contact" aria-selected="false">Especificaciones</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <br>
                    @foreach ($reviews as $item)
                        <label for="">{{ $item->user->name . ' ' . $item->user->lname }}</label>
                        @if ($item->user->id == Auth::id())
                            <a href="{{ url('edit-review/' . $producto->slug . '/userreview') }}"><i
                                    class="fas fa-edit text-danger"></i></a>
                        @endif
                        <br>
                        @php
                            $rating = App\Models\Rating::where('product_id', $producto->id)
                                ->where('user_id', $item->user->id)
                                ->first();
                        @endphp
                        @if ($rating)
                            @php $user_rated = $rating->stars_rated @endphp
                            @for ($i = 1; $i <= $user_rated; $i++)
                                <i class="fa fa-star gold"></i>
                            @endfor
                            @for ($j = $user_rated + 1; $j <= 5; $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                        @endif
                        <small>Comentado el {{ $item->created_at->format('d/m/Y') }}</small>
                        <p>{{ $item->user_review }}</p>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ url('add-rating') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $producto->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>¿Que te parecio este producto?</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                @if ($user_rating)
                                    @for ($i = 1; $i <= $user_rating->stars_rated; $i++)
                                        <input type="radio" value="{{ $i }}" checked name="product_rating"
                                            id="rating{{ $i }}">
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                    @for ($j = $user_rating->stars_rated + 1; $j <= 5; $j++)
                                        <input type="radio" value="{{ $j }}" name="product_rating"
                                            id="rating{{ $j }}">
                                        <label for="rating{{ $j }}" class="fa fa-star"></label>
                                    @endfor
                                @else
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-red">Puntuar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
