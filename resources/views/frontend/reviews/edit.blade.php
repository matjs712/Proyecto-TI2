@extends('layouts.front')
@section('title')
    Reseñas | {{ $sitio }}
@endsection
@section('content')
    <div class="py-1 mb-4 shadow-sm border-top" style="background-color: {{ $color_secundario }}">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">Inicio</a> /
                <a
                    href="{{ url('ver-categoria/' . $review->products->category->slug) }}">{{ $review->products->category->name }}</a>
                /
                <a
                    href="{{ url('categorias/' . $review->products->category->slug . '/' . $review->products->slug) }}">{{ $review->products->name }}</a>
            </h6>
        </div>
    </div>

    <div class="container"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Estas editando tu Reseña del producto {{ $review->products->name }}</h5>
                    <form action="{{ url('update-review') }}" class=" d-flex align-items-center flex-column" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="d-flex flex-column col-md-6">
                            <input type="hidden" name="review_id" value="{{ $review->products->id }}">
                            <textarea name="user_review" rows="5" style="resize: none;" placeholder="Me encantó este producto!!">{{ $review->user_review }}</textarea>
                            <button type="submit" class="mt-4 btn btn-success">Edit reseña</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
