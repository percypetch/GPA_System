@extends('layouts.main')
@section('title', 'Teacher Chart')
@section('content')

<div class="card">
    <div class="card-header">
        <span><h1>Teacher Chart</h1></span>
    </div>
    <div class="card-body">
        {!! $chart->container() !!}
        {!! $chart->script() !!}
    </div>
</div>
<div class="rounded float-end">
    <div class="card">
        <div class="card-header">
            <span><h1>Teacher Data</h1></span>
        </div>
        <div class="card-body">
            <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Teacher Code</th>
                            <th scope="col">Teacher Name</th>
                            <th scope="col">Course Teached</th>
                            </tr>
                        </thead>
                        @foreach($tbl as $row)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('teacher-view', ['teacher' => $row->teacher_code,]) }}">
                                {{ $row->teacher_code }}</a></td>
                            <td>{{ $row->teacher_name }}</td>
                            <td>{{ $row->courses_count }}</td>
                            </tr>
                        @endforeach  
                        </tbody>
             </table>
          </div>
    </div>
</div>
@endsection