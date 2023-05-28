@extends('layouts.front')
@section('title')
    {{ $producto->name }} | {{ $sitio }}
@endsection
@section('content')

    <div class="py-1 mb-4 shadow-sm migaja border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">Inicio</a> /
                {{-- <a href="{{ url('ver-categoria/'.$producto->category->slug) }}">{{ $producto->category->name }}</a> /  --}}
                <a
                    href="{{ url('categorias/' . $producto->category->slug . '/' . $producto->slug) }}">{{ $producto->name }}</a>
            </h6>
        </div>
    </div>

    <div class="container">
        <div class="card shadow prod_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img style="width: 100%;" src="{{ Storage::url('uploads/productos/' . $producto->image) }}"
                            alt="{{ $producto->name }}">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center">
                            <span>{{ $producto->name }}</span>
                            @if ($producto->trending == '1')
                                <label style="font-size: 16px;"
                                    class="text-white float-end badge bg-danger trending_tag">Tendencia</label>
                            @endif
                        </h2>
                        <hr>
                        <label style="mb-3">Precio original: <s>${{ $producto->original_price }}</s></label>
                        <label style="fw-bold"><strong>Oferta: ${{ $producto->selling_price }}</strong></label>
                        @php $rate_number = number_format($rating_value) @endphp
                        <div class="rating">
                            @for ($i = 1; $i <= $rate_number; $i++)
                                <i class="fa fa-star gold" aria-hidden="true"></i>
                            @endfor
                            @for ($j = $rate_number + 1; $j <= 5; $j++)
                                <i class="fa fa-star" aria-hidden="true"></i>
                            @endfor
                            <span>{{ $rating->count() }} Calificaciones</span>
                        </div>
                        <p class="mt-3">
                            {!! $producto->small_description !!}
                        </p>
                        <hr>
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            @if ($producto->qty > 0)
                                <label class="badge bg-success text-white">En stock</label>
                            @else
                                <label class="badge bg-danger  text-white">Sin stock</label>
                            @endif
                            <div class="d-flex align-items-center flex-wrap">
                                <button type="button" class="btn btn-naranjo mr-2" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    Califica este producto
                                </button>
                                <a href="{{ url('add-review/' . $producto->slug . '/userreview') }}"
                                    class="btn btn-azul"><i class="fa fa-star" aria-hidden="true"></i>Añadir Review</a>
                            </div>
                        </div>
                        <div class="row mt-2 align-items-center">
                            <div class="col-md-3">
                                <input type="hidden" value="{{ $producto->id }}" class="prod_id">
                                <label for="qty">Cantidad</label>
                                <div class="input-group text-center">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="qty" value="1" class="form-control qty-input">
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <br>
                                <button class="btn btn-azul me-3 float-start addToWishlist"><i
                                        class="fa-regular fa-heart"></i> Añadir a la lista</button>
                                @if ($producto->qty > 0)
                                    <button class="btn btn-red me-3 float-start addCartBtn"><i class="fa fa-cart-plus"
                                            aria-hidden="true"></i> Añadir al carrito</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Descripción</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Reseñas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Especificaciones</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p class="pt-4 pb-2">{{ $producto->description }}</p>
                    </div>
                    <div class="tab-pane fade pt-4 pb-2" id="profile" role="tabpanel" aria-labelledby="profile-tab">

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
