@extends('layouts.admin')
@section('title')
Home | {{ $sitio }}
@endsection
@section('content')
 
@include('layouts.inc.charts')
@endsection

@section('after_scripts')
@endsection