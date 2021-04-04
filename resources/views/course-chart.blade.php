@extends('layouts.main')
@section('title', 'Course Chart')
@section('content')

<div class="card">
    <div class="card-header">
        <span><h1>Course Chart</h1></span>
    </div>
    <div class="card-body">
        {!! $chart->container() !!}
        {!! $chart->script() !!}
    </div>
</div>

@endsection