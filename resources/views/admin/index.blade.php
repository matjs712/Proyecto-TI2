@extends('layouts.admin')
@section('title', 'Home')

@section('content')

    <div class="card">
        <div class="card-body">
            <div style="width:100; margin:auto" >
                <canvas id="myChart" ></canvas>
            </div>
        </div>
    </div>


@endsection

@section('after_scripts')
<script src="{{asset('admin/js/myChart.js')}}"></script>
@endsection