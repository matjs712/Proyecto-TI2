@extends('layouts.frontend')
@section('title')
    {{ $sitio }}
@endsection

@section('slider')
    @include('layouts.inc.slider')
@endsection

@section('trending')
    @include('layouts.inc.trending')
    @include('layouts.inc.about-us')
    @include('layouts.inc.contact')
    @include('layouts.inc.tracking')
@endsection

{{-- @section('trending_cat')
    @include('layouts.inc.trending_cat')
@endsection --}}
